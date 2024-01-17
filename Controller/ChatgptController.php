<?php
    include 'vendor/autoload.php';
    //    use OpenAI\Client;
    class Chatgpt  {

        public string $key;
        public $client;
        public array $type = array("gpt-4","gpt-3.5-turbo");
        public int $selected = 0;
        private static $instance = null;

        private function __construct() {
            $this->key = $_ENV['KEY'];
            $this->client = OpenAI::client($this->key);
        }

        public static function getInstance(){
            if(is_null(self::$instance)){
               self::$instance = new Chatgpt();
            }
            return self::$instance;
        }

        public function generate($prompt){

                $result = $this->client->chat()->create([
                    'model' => $this->type[$this->selected],
                    // 'response_format' => array('type' => 'json_object'),
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ]);

            return array("question" => $prompt, "answer" => $result->choices[0]->message->content);
        }
    }