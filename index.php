<?php 
    require('./vendor/autoload.php');
    # __DIR__ location of the .env file
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();





    require("routes/route.php");



    
    route("chat","ChatController","index");
    route("create","ChatController","create");
    route("new","ChatController","new");
    







    




?>