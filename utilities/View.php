<?php 

    Class View {

        public $path = "Views";

        public function view($page,$data_json){
            global $data;
            $data = $data_json;
            $full_path = "./".$this->path."/".$page;            
            if (file_exists($full_path)) {
                include $full_path;
            } else {
                echo "Error 404";
            }
        }

    }







