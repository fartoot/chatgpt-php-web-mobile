<?php 

    function route($path,$class_name,$method){
        $attrs = array();
        try {
            require_once("Controller/$class_name.php");
        } catch (\Throwable $th) {
            echo "controller not available";
        }
        
        $url = $_SERVER["REQUEST_URI"];
        
        $attrs["prompt"] = $_POST["prompt"];
        
        $attrs["chatgpt"] = $_POST["chagpt"];
        
        
        $parent = explode("/",$url);
        $attrs["id"] = $parent[2];
        $parent = $parent[1];
        
        switch ($parent) {
            case $path:
                    $chat = new $class_name();
                    $chat->$method($attrs);
                break;
                
            default:
                // include "./Views/welcome.php";
                break;
        }
    }


?>