<?php

if(!getenv("API_URL")) {
    $API_BASE = "https://data.sg.rpi.edu/";
} else {
    $API_BASE = getenv("API_URL");
}

define("API_BASE", $API_BASE);

abstract class APIModel {
    const ENDPOINT = self::ENDPOINT;

    protected static function getUniqueId($data) {
        return $data['id'];
    }

    protected static function getUrl($query=null) {
        return API_BASE . "api/" . static::ENDPOINT . (isset($query) ? $query : '');
    }

    protected static function prepQuery($parameters) {
        return isset($parameters) ? ('?' . http_build_query($parameters)) : '';
    }

    protected static function executeAPIGet($query) {
        $ch = curl_init(static::getUrl($query));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true);

        try {
            $result = curl_exec($ch);
            if(!$result) {
                return [
                    "message" => "Not Found",
                    "errors" => [],
                ];
            } else {
                return json_decode($result, true);
            }
        } catch (Exception $e) {
            error_log("API GET failed for " . static::getUrl($query) . ": $e");
            return false;
        }
    }

    protected static function executeAPICall($method, $data, $id = null) {
        if(!isset($id)) {
            $id = '';
        }

        $ch = curl_init(static::getUrl() . "/$id");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        try {
            return json_decode(curl_exec($ch), true);
        } catch (Exception $e) {
            return false;
        }
    }

    protected static function incompleteError($fields) {
        $errors = [];

        foreach($fields as $f) {
            $errors[] = ["message" => "$f is required"];
        }

        return [
            "message" => "Required field(s) missing",
            "errors" => $errors,
        ];
    }

    public static function read($parameters=null) {
        return static::executeAPIGet(static::prepQuery($parameters));
    }

    public static function getEntry($id) {
        return static::executeAPIGet("/$id");
    }

    public static function create($data) {
        $response = static::executeAPICall("POST", $data);

        return $response;
    }

    public static function update($data) {
        $response = static::executeAPICall("PUT", $data, static::getUniqueId($data));

        return $response;
    }

    public static function delete($data) {
        $response = static::executeAPICall("DELETE", $data, static::getUniqueId($data));

        return $response;
    }
}

class API extends APIModel {
    const ENDPOINT = '_models';
    public static function getModels() {
        return parent::executeAPIGet(null);
    }
}

class People extends APIModel {
    const ENDPOINT = 'people';

    protected static function getUniqueId($data) {
        return "$data[rcsId]";
    }

    public static function getCMSData($rcsId) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://cms.union.rpi.edu/api/users/view_rcs/$rcsId/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Token ' . getenv("CMS_API_TOKEN")));
        curl_setopt($ch, CURLOPT_CAINFO, 'cacert.pem');

        return json_decode(curl_exec($ch), true);
    }

    public static function create($data) {
        $person = People::getEntry($data['rcsId']);
        if(isset($person['message']) && $person['message'] == "Not Found") {
            $cmsData = static::getCMSData($data['rcsId']);

            if(!$cmsData) {
                return [
                    'message' => 'Not Found'
                ];
            }

            return parent::create([
                'rcsId' => $cmsData['username'],
                'name' => (isset($cmsData['preferred_name']) ? $cmsData['preferred_name'] : $cmsData['first_name']) . ' ' . $cmsData['last_name']
            ]);
        } else {
            return [
                'message' => 'Already exists: ' . $person['rcsId'],
            ];
        }
    }
}

class Positions extends APIModel {
    const ENDPOINT = 'positions';
}

class Meetings extends APIModel {
    const ENDPOINT = 'meetings';

    protected static function getUniqueId($data) {
        return "$data[bodyUniqueId]/$data[sessionUniqueId]/$data[meetingNum]";
    }

    public static function create($data) {
        $incompleteFields = [];

        if(!isset($data['date']) || strlen($data['date']) == 0) {
            $incompleteFields[] = 'date';
        }

        if((!isset($data['location']) || strlen($data['location']) == 0) && (!isset($data['copyPreviousLocation']) || strlen($data['copyPreviousLocation']) == 0)) {
            $incompleteFields[] = 'location';
        }

        if(count($incompleteFields) > 0) {
            return parent::incompleteError($incompleteFields);
        }

        $lastMeeting = Meetings::read([
            'bodyUniqueId' => $data['bodyUniqueId'],
            'sessionUniqueId' => $data['sessionUniqueId'],
            'sort' => '-meetingNum',
            'count' => 1,
        ])[0];

        $data['meetingNum'] = $lastMeeting['meetingNum'] + 1;

        if(isset($data['copyPreviousLocation'])) {
            if ($data['copyPreviousLocation']) {
                $data['location'] = $lastMeeting['location'];
            }

            unset($data['copyPreviousLocation']);
        }

        return parent::create($data);
    }

    protected static function deleteAssociated($values, $class) {
        if (count($values) > 0) {
            foreach($values as $v) {
                $class::delete($v);
            }
        }
    }

    public static function delete($data) {
        $params = [
            'bodyUniqueId' => $data['bodyUniqueId'],
            'sessionUniqueId' => $data['sessionUniqueId'],
            'meetingNum' => $data['meetingNum'],
        ];

        self::deleteAssociated(Actions::read($params), Actions::class);
        self::deleteAssociated(AgendaItems::read($params), AgendaItems::class);

        $meetings = self::read([
            'bodyUniqueId' => $data['bodyUniqueId'],
            'sessionUniqueId' => $data['sessionUniqueId'],
            'sort' => '-meetingNum'
        ]);

        foreach($meetings as $m) {
            if($m['meetingNum'] > $data['meetingNum']) {
                $oldMeetingNum = $m['meetingNum']--;

                Actions::changeMeetingNum();

                Meetings::update($m);
            } else {
                break;
            }
        }

        return parent::delete($data);
    }
}

class Memberships extends APIModel {
    const ENDPOINT = 'memberships';

    public static function create($data) {
        $position = Positions::getEntry($data['positionId']);

        $data['bodyUniqueId'] = $position['bodyUniqueId'];

        if(!isset($data['sessionUniqueId'])) {
            $session = Sessions::read([
                'bodyUniqueId' => $data['bodyUniqueId'],
                'active' => 'true',
                'count' => 1,
            ])[0];

            $data['sessionUniqueId'] = $session['uniqueId'];
        }

        if (isset($data['positionId']) && (!isset($data['name']) || strlen($data['name']) == 0)) {
            $data['name'] = $position['name'];
        }

        if (isset($data['endDate']) && strlen($data['endDate']) == 0) {
            unset($data['endDate']);
        }

        $response = People::create([ 'rcsId' => $data['personRcsId'] ]);
        if (!isset($response['message']) || $response['message'] !== 'Not Found') {
            return parent::create($data);
        } else {
            return $response;
        }
    }
}

class Actions extends APIModel {
    const ENDPOINT = 'actions';

    protected static function getUniqueId($data) {
        return "$data[bodyUniqueId]/$data[sessionUniqueId]/$data[meetingNum]/$data[actionNum]";
    }

    public static function changeMeetingNum($bodyUniqueId, $sessionUniqueId, $oldMeetingNum, $newMeetingNum) {
        $data = [
            'bodyUniqueId' => $bodyUniqueId,
            'sessionUniqueId' => $sessionUniqueId,
            'meetingNum' => $oldMeetingNum,
        ];

        $actions = Actions::read($data);

        if(count($actions) > 0) {
            foreach($actions as $a) {
                $actionId = $data;
                $actionId['actionNum'] = $a['actionNum'];
                static::executeAPICall("UPDATE", [ "meetingNum" => $newMeetingNum ], static::getUniqueId($actionId));
            }
        }
    }
}

class AgendaItems extends APIModel {
    const ENDPOINT = 'agenda_items';
}

class Projects extends APIModel {
    const ENDPOINT = 'projects';
}

class Sessions extends APIModel {
    const ENDPOINT = 'sessions';

    protected static function getUniqueId($data) {
        return "$data[bodyUniqueId]/$data[uniqueId]";
    }
}

class Bodies extends APIModel {
    const ENDPOINT = 'bodies';

    protected static function getUniqueId($data) {
        return $data['uniqueId'];
    }
}

class Subbodies extends APIModel {
    const ENDPOINT = 'subbodies';

    protected static function getUniqueId($data) {
        return "$data[bodyUniqueId]/$data[sessionUniqueId]/$data[uniqueId]";
    }
}
