<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$capaciteit = $_POST['capaciteit']; 
$melder = $_POST['melder'];
$type = $_POST['type'];
$overige_info = $_POST['overig'];

if(isset($_POST['prioriteit'])){
    $prioriteit = true;
}
else{
    $prioriteit = false;
}

if(empty($attractie)){
    $errors[] = "vul de attractie-naam in!";
}

if(empty($type)){
    $errors[] = "kies een type attractie!";
}

if(empty($melder)){
    $errors[] = "vul de naam van de melder in!";
}

if(!is_numeric($capaciteit)){
    $errors[] = "vul voor capiciteit een geldig getal in!";
}

function alert($errors){
    echo "<script>alert($errors);</script>";
}

if(isset($errors)){
    var_dump($errors);
    die();
}

//1. Verbinding
require_once 'conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, capaciteit, melder, type, prioriteit, overige_info) 
            VALUES(:attractie, :capaciteit, :melder, :type, :prioriteit, :overig)";
//3. Prepare
$statement = $conn->prepare($query);
//4. Execute
$statement->execute([
    ":attractie"=>$attractie,
    ":capaciteit"=>$capaciteit,
    ":melder"=>$melder,
    ":type"=>$type,
    ":prioriteit"=>$prioriteit,
    ":overig"=>$overige_info
]);

header("Location:../meldingen/index.php?msg=Meldingopgeslagen");
