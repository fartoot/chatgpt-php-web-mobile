<?php

    require("utilities/View.php");
    require("ChatgptController.php");
    require("Helper.php");

    Class ChatController extends View{

        public function index(){
            
            $last = lastest_file_in_dir("data",".json"); 
            $last_json = file_get_contents("data/".strval($last).".json");
            $data_json = json_decode($last_json, true);
            return $this->view("index.php",$data_json);

        }

        public function create($prompt){
            try{

                $openai = Chatgpt::getInstance();
                $message = $openai->generate($prompt);
            } catch (\Throwable $th)  {
                var_dump($th);
            }
            $this->store($message);
        }

        public function store($message){
            $last = lastest_file_in_dir("data",".json");             

            $last_json = file_get_contents("data/".strval($last).".json");
            $data_json = json_decode($last_json, true);
            $new_data['datetime'] = date("Y-m-d H:i:s");
            $new_data['question'] = strtoupper($message["question"]);
            $new_data['answer'] = $message["answer"];
            array_push($data_json['answers'],$new_data);
            file_put_contents("data/".strval($last).".json", json_encode($data_json));
            
            return $this->view("index.php",$data_json);
        }

        public function new(){
            $last = lastest_file_in_dir("data",".json"); 
            $new_chat = [
                "status"=> "active",
                "date"=> "24\/03\/2024",
                "answers" => [

                ]
                ];

            file_put_contents("data/".strval($last+1).".json", json_encode($new_chat));
 

            return $this->view("index.php",$new_chat);

        }

    }