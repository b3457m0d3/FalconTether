<?php

header('Pragma: no-cache');
header('Cache-Control: private, no-cache');
header('Content-Disposition: inline; filename="files.json"');
header('X-Content-Type-Options: nosniff');
switch ($_SERVER['REQUEST_METHOD']) {
    case 'HEAD':
    case 'GET':
        $this->assets->get();
        break;
    case 'POST':
        $this->assets->post();
        break;
    case 'DELETE':
        $this->assets->delete();
        break;
    case 'OPTIONS':
        break;
    default:
        header('HTTP/1.0 405 Method Not Allowed');
}
?>