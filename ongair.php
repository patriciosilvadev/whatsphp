<?php

  require_once('lib/whatsapp/whatsprot.class.php');
  require_once('lib/activerecord/ActiveRecord.php');  
  require_once('client.php');
  require_once('util.php');  
  require 'vendor/autoload.php';
  
  Requests::register_autoloader();
  Dotenv::load(__DIR__);

  date_default_timezone_set('UTC');

  $username = $argv[1];
  $db_key = empty($argv[2])? "DB" : $argv[2];
  $url_key = empty($argv[3])? "URL" : $argv[3];

  $config = array( 'access_token' => getenv('ENV'), 'access_token' => getenv('ROLLBAR'), 'root' => getenv('CWD') );
  Rollbar::init($config, false, false);

  $client = new Client($username, $db_key, $url_key);
  $client->loop();

  l('Finished normally...');

  $wait = intval(getenv('WAIT_TIMEOUT'));
  l('Going to wait for '.$wait);

  sleep($wait);

  exit(2);
