<?php

ini_set('session.use_only_cookies',1);
ini_set('session.use_strict_mode',1);
session_set_cookie_params([
    'lifetime' => (60 * 10),
    'path' => '/',
    'httponly' => true
]);

session_start();
session_regenerate_id(true);