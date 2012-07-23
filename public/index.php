<?php
// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Set include_path
set_include_path(implode(PATH_SEPARATOR, array(
	realpath(APPLICATION_PATH),
	realpath(APPLICATION_PATH . '/../library'),
	realpath(APPLICATION_PATH . '/../library/Jiraya'),
	realpath(APPLICATION_PATH . '/controllers/'),
	realpath(APPLICATION_PATH . '/models/'),
	get_include_path()
)));

require_once 'Application.php';

$application = new Application(
	APPLICATION_ENV,
	APPLICATION_PATH . '/configs/application.ini'
);
$application->run();