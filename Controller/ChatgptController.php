<?php
    include 'vendor/autoload.php';
    //    use OpenAI\Client;
    class Chatgpt  {

        public $key;
        public $client;
        private static $instance = null;
        private function __construct() {
            $this->key = $_ENV['KEY'];
            $this->client = OpenAI::client($this->key);
        }

        public static function getInstance(){
            if(!self::$instance){
               self::$instance = new Chatgpt();
            }

            return self::$instance;
        }

        public function generate($prompt){

                $result = $this->client->chat()->create([
                    'model' => 'gpt-4',
                    // 'response_format' => array('type' => 'json_object'),
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ]);

            return array("question" => $prompt, "answer" => $result->choices[0]->message->content);
        }

    }