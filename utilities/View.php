<?php 

    Class View {

        public $path = "Views";

        public function view($page,$recieve){
            global $data , $Parsedown, $chatgpt ;
            $Parsedown = new Parsedown();
            $data = $recieve["data_json"];
            $chatgpt = $recieve["selectedData"];
            $full_path = "./".$this->path."/".$page;            
            if (file_exists($full_path)) {
                include $full_path;
            } else {
                echo "Error 404";
            }
        }

    }







