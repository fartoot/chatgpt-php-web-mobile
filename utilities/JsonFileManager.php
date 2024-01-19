<?php
    require("utilities/FileManager.php");

    class JsonFileManager extends FileManager{


        public int $latest_file;
        public int $current;
        public array $content;
        public string $question;
        public string $answer;
        public string $datetime;

        private static $instance = null;

        private function __construct($dir) {
            parent::__construct($dir);
            $this->extension = "json";
        }

        public static function getInstance($dir){
            if(is_null(self::$instance)){
                self::$instance = new JsonFileManager($dir);
                self::$instance->lastest_file_in_dir(self::$instance->dir,self::$instance->extension);
            }
            self::$instance->read();
            return self::$instance;
        }

        public function lastest_file_in_dir($dir,$extension){
            $files = array_diff(scandir($dir), array(".", ".."));
            $last = 0;
            foreach ($files as $key => $value) {
                $curent_value = intval(trim($value,$extension));
                if ($curent_value > $last){
                    $last = $curent_value;
                }
            }
            $this->latest_file = intval($last);
            if($this->latest_file == 0){
                $this->new();
            }
            $this->current = $this->latest_file;
        }

        public function read(){
            $json_encode = file_get_contents($this->dir."/".strval($this->current).".".$this->extension);
            $this->content =  json_decode($json_encode, true);
        }

        public function appendContent(){
            $new_content['datetime'] = $this->datetime;
            $new_content['question'] = $this->question;
            $new_content['answer'] = $this->answer;
            $this->content["answers"][] = $new_content;
        }

        public function write(){
            file_put_contents("$this->dir/".strval($this->current).".$this->extension", json_encode($this->content));
        }

        public function new(){
            $this->latest_file = $this->latest_file + 1;
            $this->current = $this->latest_file;
            
            $this->content = [
                "status"=> "active",
                "date"=> date("Y-m-d H:i:s"),
                "answers" => []
                        ];
            $this->write();
        }

        public function show($id){
            $this->current = $id;
            $this->read();
        }

    }