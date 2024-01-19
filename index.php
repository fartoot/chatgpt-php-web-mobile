<?php 
    require("routes/route.php");
    require('./vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();




    route("","WelcomeController","index");
    route("chat","ChatController","index");
    route("create","ChatController","create");
    route("new","ChatController","new");
    route("show","ChatController","show");
    







    




?>