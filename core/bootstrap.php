<?php

use Core\App;
use Core\Database\Connection;
use Core\Database\QueryBuilder;

App::bind('config', require 'config/config.php');
App::bind('database', new QueryBuilder(Connection::connect(App::get('config')['database'])));