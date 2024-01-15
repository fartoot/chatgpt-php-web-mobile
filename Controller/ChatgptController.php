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
                //code...
                $result = $client->chat()->create([
                    'model' => 'gpt-4',
                    // 'response_format' => array('type' => 'json_object'),
                    'messages' => [
                        ['role' => 'user', 'content' => $this->prompt],
                    ],
                ]);

            return array("question" => $this->prompt, "answer" => $result->choices[0]->message->content);
        }

    }