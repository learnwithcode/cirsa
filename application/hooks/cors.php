<?php
function allow_cors() {
    header("Access-Control-Allow-Origin: *"); // या specific domain
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

    // OPTIONS preflight request को handle करो
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        exit(0);
    }
}

?>