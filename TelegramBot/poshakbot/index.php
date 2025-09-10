<?php

class bot
{
    public $token = "5055295690:AAGfGeRZoUKaiN5qOQZF_wpfJG0-dsFm6Tw";
    public $url = "https://api.telegram.org/bot";
    public $username_channel = "@krmahdi1053";

    public function __construct()
    {
        $update = file_get_contents('php://input');
        file_put_contents('infobot.txt', $update);
        $update = json_decode($update, TRUE);

        if (isset($update['callback_query'])) {
            $current_user_chat_id = $update['callback_query']['from']['id'];
            $current_message_id = $update['callback_query']['message']['message_id'];
            $current_callback_data = $update['callback_query']['data'];
        } else {
            $current_user_text = $update['message']['text'];
            $current_user_chat_id = $update['message']['from']['id'];
            $current_username_user = $update['message']['from']['first_name'];
        }

        if ($current_user_text == '/start') {
            $getMember = $this -> GetMember( $this->username_channel , $current_user_chat_id);
            if ($getMember == 1){
                $response_message = 'خوش اومدی عزیزم! خوش حالیم ازین که در کانال ما عضو هستی. پس بزن بریم...';
                $reply = array(
                    array(
                        $this->InlineKeyboardButton('برو بریم', 'Continues'),
                    ),
                );
                $final_reply = $this->InlineKeyboardMarkup($reply);
                $this->sendMessage($current_user_chat_id, $response_message , $final_reply);
            }else{
                $response_message = " خوش اومدی عزیزم! برای استفاده از خدمات این رباط، اول باید عضو کانالم بشی. مطئن باش پشیمون نمیشی.            @krmahdi1053";
                $reply = array(
                    array(
                        $this->InlineKeyboardButton('عضو شدم', 'Member_IBecame'),
                    ),
                );
                $final_reply = $this->InlineKeyboardMarkup($reply);
                $this->sendMessage($current_user_chat_id, $response_message, $final_reply);

            }
        }

        if (isset($current_callback_data)){

            if ($current_callback_data == 'Member_IBecame'){
                $confir_Member_channels = $this -> GetMember( $this -> username_channel , $current_user_chat_id);
                if ($confir_Member_channels == 1){
                    $response_message = 'هویت شما تایید شد. حالا میتونی راحت از خدماتم استفاده کنی.';
                    $reply = array(
                        array(
                            $this->InlineKeyboardButton('برو بریم', 'Continues'),
                        ),
                    );
                    $final_reply = $this->InlineKeyboardMarkup($reply);
                    $this->sendMessage($current_user_chat_id, $response_message , $final_reply);
                }else{
                    $response_message = "هویت شما هنوز تایید نشده.";
                    $reply = array(
                        array(
                            $this->InlineKeyboardButton('عضو شدم', 'Member_IBecame'),
                        ),
                    );
                    $final_reply = $this->InlineKeyboardMarkup($reply);
                    $this->sendMessage($current_user_chat_id, $response_message, $final_reply);

                }
            }

            elseif ($current_callback_data == 'Continues'){
                $getMember = $this -> GetMember( $this->username_channel , $current_user_chat_id);
                if ($getMember == 1){
                    $response_message = 'از کدوم خدمات ما میخوای استفاده کنی؟';
                    $reply = array(
                        array(
                            $this->InlineKeyboardButton('اجناس و محصولات', 'Product'),
                        ),
                        array(
                            $this->InlineKeyboardButton('گرفتن شارژ رایگان', 'GetFreeCharge'),
                            $this->InlineKeyboardButton('مناسبت های ویژه', 'OccasionSpecial'),
                        ),
                        array(
                            $this->InlineKeyboardButton('سبد خرید', 'Cart'),
                            $this->InlineKeyboardButton('ثبت نام', 'Registration'),
                        ),
                        array(
                            $this->InlineKeyboardButton('شرکت در نظر سنجی', 'Survey'),
                            $this->InlineKeyboardButton('امتیاز دهی', 'Scoring'),
                        ),
                        array(
                            $this->InlineKeyboardButton('ارتباط با ما', 'WeConnected'),
                        )
                    );
                    $final_reply = $this->InlineKeyboardMarkup($reply);
                    $this->sendMessage($current_user_chat_id, $response_message , $final_reply);
                }else{
                    $response_message = "متاسفانه به دلیل ترک کانالم نمیتونی از خدماتم استفاده کنی.    @krmahdi1053";
                    $reply = array(
                        array(
                            $this->InlineKeyboardButton('عضو شدم', 'Member_IBecame'),
                        ),
                    );
                    $final_reply = $this->InlineKeyboardMarkup($reply);
                    $this->sendMessage($current_user_chat_id, $response_message, $final_reply);
                }
            }

            elseif ($current_callback_data == 'WeConnected'){
                $getMember = $this -> GetMember( $this->username_channel , $current_user_chat_id);
                if ($getMember == 1){
                    $response_message = 'به بهترین ها فکر کنید! خوش آمدید';
                    $reply = array(
                        array(
                            $this->InlineKeyboardButton('درباره ما', 'AboutMe'),
                        ),
                        array(
                            $this->InlineKeyboardButton('ساعات کاری', 'WorkingTime'),
                            $this->InlineKeyboardButton('آدرس و تلفن', 'AddressAndPhone'),
                        ),
                        array(
                            $this->InlineKeyboardButton('ارسال پیام به مدیریت', 'SendSMSToManagement'),
                        ),
                        array(
                            $this->InlineKeyboardButton('بازگشت به منوی اصلی', 'BackMainMenu'),
                        )
                    );
                    $final_reply = $this->InlineKeyboardMarkup($reply);
                    $this->sendMessage($current_user_chat_id, $response_message , $final_reply);
                }else{
                    $response_message = "متاسفانه به دلیل ترک کانالم نمیتونی از خدماتم استفاده کنی.@krmahdi1053";
                    $reply = array(
                        array(
                            $this->InlineKeyboardButton('عضو شدم', 'Member_IBecame'),
                        ),
                    );
                    $final_reply = $this->InlineKeyboardMarkup($reply);
                    $this->sendMessage($current_user_chat_id, $response_message, $final_reply);
                }
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