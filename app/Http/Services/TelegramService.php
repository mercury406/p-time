<?php 

namespace App\Http\Services;

class TelegramService{
    const TG_BASE_URL = "";

    private $method;
    private $data;


    public function getUpdates() {
        $this->method = "getUpdates";
        $this->clearData();
        $response = $this->makeRequest();
        return is_null($response) ? ["error" => "null"] : json_decode($response);
    }

    public function sendGreeting(int $user_id)
    {
        $text = [""];
		$text[] = "Assalomu aleykum! Tilni tanlang";
		$text[] = "~~~~~~~~~~~~~~~~~~~~~~~~~";
		$text[] = "Здраствуйте! Выберите язык";
		$text[] = "~~~~~~~~~~~~~~~~~~~~~~~~~";
		$text[] = "Hello! Choose language";

		$this->data = [
			"chat_id" => $user_id,
			"text" => implode("\n", $text),
			"reply_markup" => [
				// "resize_keyboard" => true,
				"inline_keyboard" => [
					[
						[
                            "text" => "🇺🇿 O'zbek tili",
                            "callback_data" => "uzbek"
                        ],
						[
                            "text" => "🇺🇿 Ўзбек тили ",
                            "callback_data" => "ozbek"
                        ]
					], 
					[
						[
                            "text" => "🇷🇺 Русский",
                            "callback_data" => "russian"
                        ],
						[
                            "text" => "🇬🇧 English",
                            "callback_data" => "english"
                        ]
					],
				]
            ]
        ];

        return $this->sendMessage();
    }


    private function sendMessage() {
        $this->method = "sendMessage";
        $response = $this->makeRequest();
        return is_null($response) ? ["error" => "null"] : json_decode($response);
    }

    private function makeRequest() {
        $ch = curl_init(self::TG_BASE_URL . $this->method);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-type:application/json"]);
        if($this->data !== []){
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));
        }
        $result = curl_exec($ch);
        if($result) {
            curl_close($ch);
            return $result;
        } else {
            info(curl_error($ch));
            curl_close($ch);
            return null;
        }
    }

    private function clearData(){
        $this->data = [];
    }

    
}