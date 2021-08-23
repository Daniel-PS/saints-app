<?php

use App\Session;

require_once '../src/constants.php';
require_once '../src/functions.php';
loadFileToEnvironment(BASE_FOLDER_PATH . '/.env');
require_once '../src/autoload.php';
require_once '../src/routes.php';

Session::clear('old_input');
