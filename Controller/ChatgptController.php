<?php
    include 'vendor/autoload.php';
    //    use OpenAI\Client;
    class Chatgpt  {

        public $prompt;
        public $key;
        public function __construct($prompt) {
            $this->prompt = $prompt;
            $this->key = $_ENV['KEY'];
        }


        public function generate(){

            $client = OpenAI::client($this->key);
            
            $result = $client->chat()->create([
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'user', 'content' => $this->prompt],
                ],
            ]);
            var_dump($result);
            return $result->choices[0]->message->content;
        }

    }