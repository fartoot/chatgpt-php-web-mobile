<?php 
    require("routes/route.php");
    require('./vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();








    
    route("chat","ChatController","index");
    route("create","ChatController","create");
    route("new","ChatController","new");
    







    




?>