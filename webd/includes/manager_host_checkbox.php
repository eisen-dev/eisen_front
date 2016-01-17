<?php
/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2016/01/07
 * Time: 9:19
 */

if(isset($_POST['list-action'])){
    echo($_POST['list-action']);
}

$check = $_POST['check'];
if(empty($check))
{
    echo("You didn't select any checks.");
}
else
{
    $N = count($check);

    echo("You selected $N check(s): ");
    for($i=0; $i < $N; $i++)
    {
        echo($check[$i] . " ");
    }
}
