<?php 

    function route($path,$class_name,$method){
        
        try {
            require_once("Controller/$class_name.php");
        } catch (\Throwable $th) {
            echo "controller not available";
        }
        
        $url = $_SERVER["REQUEST_URI"];
        
        $prompt = $_POST["prompt"] ;

        $parent = explode("/",$url);
        $parent = $parent[1];

        switch ($parent) {
            case $path:
                $chat = new $class_name();
                $chat->$method($prompt);
                break;
                
            default:
                // include "./Views/welcome.php";
                break;
        }
    }


?>