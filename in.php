<?php

include_once './class/dbKlasse.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vorname = htmlspecialchars($_POST['vorname']);
$nachname = htmlspecialchars($_POST['nachname']);

echo $nachname;

echo '<br>';

echo $vorname;

$sql = new dbKlasse("localhost", "root", "joker666", "test");

// var_dump($sql);

$sqlinj = "SELECT * FROM test ORDER BY `vorname` DESC;";

$res = $sql->query($sqlinj);

while($row = $sql->result_array($res))
{
    echo $row['vorname'] . ' , ' . $row['nachname'] . '<br>';
 
}

// $sql->closeDb();

$sqlinj = "INSERT INTO `test` (id , vorname , nachname) VALUES (null , 'Anke' , 'Danke');";

$sql->insertDb($sqlinj);


        