<?php 
    $conn = mysqli_connect('localhost', 'vik', 'coolioth123', 'recipe_store');
    if(!$conn) {
        echo 'Connection error' . mysqli_connect_error();
    }
?>