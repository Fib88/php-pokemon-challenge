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
    $types = $poke['types'];
    $pokemonEvoUrl = $poke['species']['url'];

$pokemonSpeciesData = file_get_contents($pokemonEvoUrl);
    $species = (json_decode($pokemonSpeciesData,true));
    $pokemonEvo = $species['evolution_chain']['url'];

      //var_dump($pokemonEvoUrl);
$pokemonEvoData = file_get_contents($pokemonEvo);
    $evolutions = (json_decode($pokemonEvoData, true));
    $evolutionsName = $evolutions['chain'];
//    var_dump($evolutionsName);

function getPokeEvo($evolutionsName){
    $evoList = [];
    do{
        array_push($evoList, $evolutionsName['species']['name']);
     if($evolutionsName['evolves_to']){
         $evolutionsName = $evolutionsName['evolves_to'][0];
     }
     else{
      $evolutionsName = null;
        }
    }
    while(!!$evolutionsName);//!! is similar to bolean and returns true or false depending on condition
    return $evoList;
}

function getRandomMoves($poke){
    $max = count($poke['moves']);
    for ($i = 0; $i <=4; $i++) {
        $randomNumber = rand(0 ,$max);
        $randomMove = $poke['moves'][$randomNumber]['move']['name'];
        return $randomMove;
    }
}

function getTypes($types){
    $typesList = [];
    if(count($types)>1){
        for($i = 0;$i<count($types);$i++){
            array_push($typesList,$types[$i]['type']['name']);
        }
        return ($typesList[0]."/".$typesList[1]);
    }
    else{
      return($types[0]['type']['name']);
    }
}



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

<h4>Types:</h4>
<p><?php echo getTypes($types);?></p>

<h4>Moves:</h4>
<p><?php echo getRandomMoves($poke);?></p>
<p><?php echo getRandomMoves($poke);?></p>
<p><?php echo getRandomMoves($poke);?></p>
<p><?php echo getRandomMoves($poke);?></p>

<h4>Evolution Tree:</h4>
<p><?php echo implode(getPokeEvo($evolutionsName));?></p>


</body>
</html>
