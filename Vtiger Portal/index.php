<?php


ini_set("display_errors", 1);
ini_set('error_reporting', E_ERROR);

require __DIR__."/config.php";
include __DIR__."/library/jdf.php";
include __DIR__."/library/Language.php";

require __DIR__."/library/Controller.php";
require __DIR__."/library/Model.php";
require __DIR__."/library/View.php";
require __DIR__."/library/Router.php";
$app = new Router();



