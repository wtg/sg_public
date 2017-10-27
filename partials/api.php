<?php

if(!getenv("API_URL")) {
    $API_BASE = "https://data.sg.rpi.edu/";
} else {
    $API_BASE = getenv("API_URL");
}