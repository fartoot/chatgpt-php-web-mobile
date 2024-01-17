<?php 

    Class View {

        public $path = "Views";

        public function view($page,$data_json,$selectedChat){
            global $data , $Parsedown, $chatgpt ;
            $Parsedown = new Parsedown();
            $data = $data_json;
            $chatgpt = $selectedChat;
            $full_path = "./".$this->path."/".$page;            
            if (file_exists($full_path)) {
                include $full_path;
            } else {
                echo "Error 404";
            }
        }

    }







