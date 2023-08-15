<?php

const ROOT_PATH = __DIR__;
const CREDENTIAL_PATH = __DIR__ . '/credentials';
const ROOT_URL = 'http://localhost/meet';

require_once 'classes/Init.php';
$meet = (new Init)->start();

require_once 'views/view.php' ;
