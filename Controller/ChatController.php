<?php

    require("utilities/View.php");
    require("utilities/JsonFileManager.php");
    require("Controller/ChatgptController.php");
    require("Helper.php");

    Class ChatController extends View{

        public $JsonFileManager;
        public $Chatgpt;

        public function __construct() {

            $this->JsonFileManager = JsonFileManager::getInstance('data');
            $this->Chatgpt = Chatgpt::getInstance();

        }

        public function index(){

            $this->JsonFileManager->read();
            return $this->view("index.php",$this->JsonFileManager->content,$this->Chatgpt->selected);

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
            
            return $this->view("index.php",$this->JsonFileManager->content,$this->Chatgpt->selected);

        }

        public function new(){
            $this->JsonFileManager->new();
            return $this->view("index.php",$this->JsonFileManager->content,$this->Chatgpt->selected);

        }

    }