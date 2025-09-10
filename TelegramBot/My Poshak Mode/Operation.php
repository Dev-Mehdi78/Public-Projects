<?php

class Operation
{
    public $token;
    public $db;

    public function __construct($token, $host, $username, $password, $dbname)
    {
        $this->token = $token;
        $this->db = new mysqli($host, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function CloseCon($conn)
    {
        $conn->close();
    }

    public function recivedInfoUser()
    {
        $information = json_decode(file_get_contents('php://input'));
        return $information;
    }

    public function Source_Home($method, $data = [])
    {
        $url = "https://api.telegram.org/bot" . TOKEN . "/" . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        if (curl_error($ch)) {
            var_dump(curl_error($ch));
        } else {
            return json_decode($res);
        }
    }

    public function GetMember($chat_id , $user_id)
    {
        $get_data = $this -> Source_Home('getChatMember' , [
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ]);
        $result_data = file_get_contents($get_data);
        $result_data = json_decode($result_data , TRUE);
        $final_data = $result_data->result->status;
        return ($final_data == 'left')? 0 : 1;
    }

    public function SendSMS ($chat_id , $text , $reply_markup = null){
        $this->Source_Home('sendMessage' , [
            'chat_id' => $chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup
        ]);
    }

    public function InlineKeyboardButton($label_btn, $callback_data)
    {
        $params = array(
            'text' => $label_btn,
            'callback_data' => $callback_data
        );
        return $params;
    }

    public function InlineKeyboardMarkup(array $parameters)
    {
        $response = array(
            'inline_keyboard' => $parameters
        );
        $final_response = json_encode($response, true);
        return $final_response;
    }

}