<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ERROR);

require("Operation.php");
require("config.php");

$operation = new Operation(TOKEN, HOST, USERNAME, PASSWORD, DBNAME);
$result = $operation->recivedInfoUser();
if (isset($result->callback_query)) {
    $ChatIdCurrentUser = $result->callback_query->from->id;
    $MessageIdCurrent = $result->callback_query->message->message_id;
    $CallBackData = $result->callback_query->data;

} else {
    $ChatIdCurrentUser = $result->message->from->id;
    $FirstNameCurrentUser = $result->message->from->first_name;
    $UsernameCurrentUser = $result->message->from->username;
    $text = $result->message->text;
}

if ($text == '/start') {
    $join_mandatory = $operation->GetMember(CHANNELNAME, $ChatIdCurrentUser);
    if ($join_mandatory == 0) {
        $callback_text = " سلام$FirstNameCurrentUser   عزیز!
       
شما در کانال پشتیبانی عضو نیستید و امکان استفاده از خدمات رباط را ندارید ⚠️
         	
⭕️برای استفاده کامل از ربات بایستی ابتدا در کانال زیر عضو شوید :

🆔 " . CHANNELNAME . "

سپس به ربات برگشته و مجدد دستور /start را ارسال کنید و امتحان کنید ✔️";
        $reply = array(
            array($operation->InlineKeyboardButton('عضویت در کانال 💯', 'JoinInChannel')),
            array($operation->InlineKeyboardButton('بررسی عضویت 📢', 'JoinChecked')),
        );
        $reply = $operation->InlineKeyboardMarkup($reply);
        $operation->SendSMS($ChatIdCurrentUser, $callback_text, $reply);
    } else {
        $callback_text = " به منوی اصلی  رباط خوش اومدی$FirstNameCurrentUser عزیز! 🥰 
       
برای بهره بردن از خدمات رباط از کلیدهای زیر استفاده کنید 👇 ";
        $reply = array(
            array($operation->InlineKeyboardButton('فروشگاه 🧥', 'Shopping')),
            array($operation->InlineKeyboardButton('گرفتن شارژ رایگان 🎁', 'GetFreeCharged'), $operation->InlineKeyboardButton('عضویت در کانال VIP 👨‍🏫', 'AddedChannelVIP')),
            array($operation->InlineKeyboardButton('سبد خرید 🛒', 'Cart'), $operation->InlineKeyboardButton('انتقادات و پیشنهادات 📝', 'Offers')),
            array($operation->InlineKeyboardButton('ارتباط با ما 🙋‍♂️', 'RelationUs'), $operation->InlineKeyboardButton('امتیاز به عمکرد 🥇', 'Scoring')),
            array($operation->InlineKeyboardButton('آمار رباط 📊', 'StatisticsBot'))
        );
        $reply = $operation->InlineKeyboardMarkup($reply);
        $operation->SendSMS($ChatIdCurrentUser, $callback_text, $reply);
    }
}


file_put_contents('infobot.txt', $join_mandatory);

