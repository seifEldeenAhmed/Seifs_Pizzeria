<?php

$conn=mysqli_connect('localhost', 'seif','admin', 'seif_pizzeria');

if(!$conn){
    echo 'there is an error in db connection :'. mysqli_connect_error();
}

?>