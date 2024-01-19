<?php

    require("utilities/JsonFileManager.php");
    require("utilities/QrCodeManager.php");
    require("Controller/ChatgptController.php");

    Class ChatController extends View{

        public object $JsonFileManager;
        public object $Chatgpt;
        public object $qrcode;

        public function __construct() {

            $this->JsonFileManager = JsonFileManager::getInstance('data');
            $this->Chatgpt = Chatgpt::getInstance();
            $this->qrcode = QrCodeManager::create("imgs","qrcode","svg");
            $this->qrcode->write();

        }

        public function index(){

            $this->JsonFileManager->read();
            return $this->view("index.php",
                ["data_json"=>$this->JsonFileManager->content, "selectedData"=>$this->Chatgpt->selected]    
            );

        }

        public function create($prompt,$selectedChat){

            $this->Chatgpt->selected = $selectedChat;
            $this->store($this->Chatgpt->generate($prompt));
        }

        public function store($message){

            $this->JsonFileManager->read();
            $this->JsonFileManager->datetime = date("Y-m-d H:i:s");
            $this->JsonFileManager->question = strtoupper($message["question"]);
            $this->JsonFileManager->answer = $message["answer"];
            $this->JsonFileManager->appendContent();
            $this->JsonFileManager->write();
            
            return $this->view("index.php",
                ["data_json"=>$this->JsonFileManager->content, "selectedData"=>$this->Chatgpt->selected]    
            );

        }

        public function new(){
            $this->JsonFileManager->new();
            return $this->view("index.php",
                ["data_json"=>$this->JsonFileManager->content, "selectedData"=>$this->Chatgpt->selected]    
            );

        }

    }