<?php

//iekļaujam konfigurāciju un core clasi
require_once('config/config.php');
require_once('core/core.class.php');

$core = new Core($config);

//sākam koda izpildi
$core->start();



