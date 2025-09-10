<?php

class bot
{
    public $token = "Your Tocken";
    public $url = "https://api.telegram.org/bot";

    public function __construct()
    {
        $update = file_get_contents('php://input');
        file_put_contents('bot.txt', $update);
        $update = json_decode($update, true);

        if (isset($update['callback_query'])) {
            $current_user_chat_id = $update['callback_query']['from']['id'];
            $current_message_id = $update['callback_query']['message']['message_id'];
            $current_callback_data = $update['callback_query']['data'];
        } else {
            $current_user_text = $update['message']['text'];
            $current_user_chat_id = $update['message']['from']['id'];
        }

        if ($current_user_text == '/start') {
            $getMember = $this -> GetMember( '@krmahdi1053' , $current_user_chat_id);
            if ($getMember == 1){
                $response_message = "خوش اومدی مشتری عزیز! خوش حالیم که در کانال ما عضو هستید. پس بزن بریم...";
                $key = $this->keyboards('ادامه می دهم', 'بعدا میام سراغت');
                $this->sendMessage($current_user_chat_id, $response_message, $key);
            }else{
                $response_message = "خوش اومدی عزیزم! لطفا ابتدا عضو کانال تلگرامی من بشو.";
                $key = $this->keyboards('عضو شدم');
                $this->sendMessage($current_user_chat_id, $response_message, $key);
                exit();
            }
        }

        if ($current_user_text == 'ادامه می دهم') {
            $response_message = "خوش اومدی!";
            $reply = array(
                array(
                    $this->InlineKeyboardButton('ادامه', 'Continues'),
                ),
                array(
                    $this->InlineKeyboardButton('ویرایش', 'Edit'),
                    $this->InlineKeyboardButton('حذف', 'Delete')
                )
            );
            $final_reply = $this->InlineKeyboardMarkup($reply);
            $this->sendMessage($current_user_chat_id, $response_message, $final_reply);
        }

        if (isset($current_callback_data)) {
            if ($current_callback_data == 'Continues') {
                $response_message = "خوش حالیم از این که ادامه می دهید!";
                $this->sendMessage($current_user_chat_id,  $response_message);
            }
            elseif ($current_callback_data == 'Edit') {
                $response_message = "کاربر عزیز پیام شما با موفقیت ویرایش شد.";
                $reply = array(
                    array(
                        $this->InlineKeyboardButton('دکمه تستی 1', 'button_test_1'),
                        $this->InlineKeyboardButton('دکمه تستی 2', 'button_test_2')
                    )
                );
                $final_reply = $this->InlineKeyboardMarkup($reply);
                $this->editMessage($current_user_chat_id, $current_message_id , $response_message , $final_reply);
            }
            elseif ($current_callback_data == 'Delete') {
                $response_message = "کاربر عزیز، از حذف پیام اطمینان دارید؟";
                $reply = array(
                    array(
                        $this->InlineKeyboardButton('بله', 'yes_deleted_message'),
                        $this->InlineKeyboardButton('خیر', 'no_deleted_message')
                    )
                );
                $final_reply = $this->InlineKeyboardMarkup($reply);
                $this->sendMessage($current_user_chat_id,  $response_message , $final_reply);
            }

            elseif ($current_callback_data == 'yes_deleted_message') {
                $response_message = "پیغام، با موفقیت حذف شد.";
                $this->deleteMessage($current_user_chat_id, $current_message_id);
                $this->sendMessage($current_user_chat_id,  $response_message);
            }
        }

    }

    public function sendMessage($chat_id, $text, $reply_markup = null)
    {
        if ($reply_markup == null) {
            $call_url = $this->url . $this->token . "/sendMessage?chat_id=" . $chat_id . "&text=" . $text;
            file_get_contents($call_url);
        } else {
            $call_url = $this->url . $this->token . "/sendMessage?chat_id=" . $chat_id . "&text=" . $text . "&reply_markup=" . $reply_markup;
            file_get_contents($call_url);
        }
    }

    public function editMessage($chat_id, $message_id, $text, $reply_markup = null)
    {

        if ($reply_markup == null) {
            $call_url = $this->url . $this->token . "/editMessageText?chat_id=" . $chat_id . "&message_id=" . $message_id . "&text=" . $text;
            file_get_contents($call_url);
        } else {
            $call_url = $this->url . $this->token . "/editMessageText?chat_id=" . $chat_id . "&message_id=" . $message_id . "&text=" . $text . "&reply_markup=" . $reply_markup;
            file_get_contents($call_url);
        }

    }

    public function deleteMessage($chat_id, $message_id)
    {
        $call_url = $this->url . $this->token . "/deleteMessage?chat_id=" . $chat_id . "&message_id=" . $message_id;
        file_get_contents($call_url);
    }

    public function GetMember($chat_id , $user_id){
        $call_url = $this->url . $this->token . "/getChatMember?chat_id=" . $chat_id . "&user_id=" . $user_id;
        $result_data = file_get_contents($call_url);
        $result_data = json_decode($result_data , TRUE);
        $user_id = $result_data['result']['status'];
        $output = ($user_id == 'left') ?  0 : 1 ;
        return $output;
    }

    public function keyboards($label_button, $label_button1 = null)
    {
        $btn = array(
            array(
                $label_button,
                $label_button1
            )
        );
        $custom_keyboard = array(
            'keyboard' => $btn,
            'resize_keyboard' => true,
            'one_time_keyboard' => true,
            'input_field_placeholder' => 'test me',
            'selective' => true
        );
        $final_custom_keyboard = json_encode($custom_keyboard, true);
        return $final_custom_keyboard;
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

$ob = new bot();