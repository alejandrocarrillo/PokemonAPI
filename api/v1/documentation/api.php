<?php

require("vendor/autoload.php");
$openapi = \OpenApi\Generator::scan(['api/v1/controllers']);
header('Content-Type: application/json');
echo $openapi->toJSON();

?>