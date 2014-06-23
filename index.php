<?php


include_once './class/Html.php';
include_once './class/Fehlermeldung.php';
include_once './class/VnName.php';

Html::printValues($_POST);

$vn = new VnName();
$error = new Fehlermeldung();
$vnNamen = $vn->getAll();

if(isset($_POST['senden']))
{
    if(!($_POST['vorname']) && !($_POST['nachname']))
    {
        for ($i = 0; $i < count($vnNamen); $i++)
            {
                $vorname = $_POST['vornamen'];
                $nachname = $_POST['nachnamen'];
                $id = $_POST['update_id'];

                $vn->updateUser($id[$i], $vorname[$i], $nachname[$i]);
            }
    }
    else
    {
        $newvorname = $_POST['vorname'];
        $newnachname = $_POST['nachname'];
        $vn->newUser($newvorname, $newnachname);
        echo "Neu";
    }
}
//elseif (isset ($_POST['del']))
//{
//    $id = $_POST['delete_id'];
//    if(!$id)
//    {
//        echo 'ERROR';
//        exit;
//    }
//    
//    var_dump($id);
//    
//    for ($i = 0; $i <= count($vnNamen); $i++)
//    {
//            
//        Html::printValues($id[$i]);
//              
//    }
//}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>POST - Projekt</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <?php

            $message = "Test Fehler No. 1";
            $error->addMessage($message);
            
            $message = "Test Fehler No. 2";
            $error->addMessage($message);
            
            echo '<br>';
            if($error->hasMesasage() === TRUE)
            {  
                $error->printMessage();
            }else
            {
                echo 'Kein Fehler';
            }
        ?>
        <form method="POST" action="index.php">
            
            <table>
                <thead>
                    <tr>   
                        <th>Vorname</th>
                        <th>Nachname</th>
                        <th>    </th>
                        <th><input type="submit" name="senden"   value="Save"></th>
                        <th><input type="submit" name="del"   value="Del"></th>
                    </tr>
                    <tr>
                        <th height="15px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="vorname" value="" size="30" /></td>
                        <td><input type="text" name="nachname" value="" size="30" /></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th height="15px"></th>
                    </tr>
                    
                    <?php

                    for ($i = 0; $i < count($vnNamen); $i++)
                    {
                        echo    "<tr>";
                        echo    '<td><input type="text" name="vornamen[]" size="30" value="' . $vnNamen[$i]->getVorname() . '" /></td>';
                        echo    '<td><input type="text" name="nachnamen[]" size="30" value="' . $vnNamen[$i]->getNachname() .'" /></td>';
                        echo    '<td></td>';
                        echo    '<td><input type="hidden" name="update_id[]" value="' . $vnNamen[$i]->getId() . '" /></td>';
                        echo    '<td><input type="checkbox" name="delete_id[]" value="' . $vnNamen[$i]->getId() . '" /></td>';
                        echo    '</tr>';
                    }
                    
                    ?>
                    
                </tbody>
            </table>
            
        </form>
       
    </body>
</html>
