<?php

declare(strict_types=1);

ini_set('display_errors', "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

$pokemon = $_POST['name'];

if($pokemon === null){
    $pokemon = 1;
}
$pokemonData = file_get_contents("https://pokeapi.co/api/v2/pokemon/" .$pokemon);
$poke = (json_decode($pokemonData,true));

$image = $poke['sprites']['front_default'];
$moves = $poke['moves']['0']['move']['name'];



?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="pokedex.php" method="post">

    <label for="name"> name or id </label><br>
    <input type="text" id="name" name="name" value=""><br>
    <input type="submit" value="Submit">

</form>

<div class="pokeName"><?php echo $poke['name'];?></div>
<div class="pokeId"><?php echo $poke['id'];?></div>
<img src="<?php echo $image;?>">
<div class="pokeMoves"><?php echo $moves;?></div>


</body>
</html>
