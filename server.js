var phpServer = require('node-php-server');

// Create a PHP Server
phpServer.createServer({
    port: process.env.PORT || 9090,
    hostname: 'localhost',
    base: __dirname + '/public/',
    keepalive: false,
    open: false,
    bin: 'php',
    router: __dirname + '/server.php'
});
