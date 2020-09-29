<?php

declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', "1");
ini_set("display_startup_errors", "1");



$var1 = "So its actually working but";
$var2 = "is it really?";
$var3 = "this is really interesting";
echo($var1);
echo($var2);
echo($var3);


$dataCall =file_get_contents("https://pokeapi.co/api/v2/pokemon/". $_GET['id']);

?>