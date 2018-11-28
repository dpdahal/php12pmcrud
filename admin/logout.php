<?php
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../help/help.php');

session_destroy();

redirect_to('admin/login');
exit();