<?php

ob_start();
include('jdf.php');
define('API_KEY', '516605862:AAEp976zHR_uYiDu4crNDPElb8v3fb_DlV0'); // توکن ربات را در اینجا قرار دهید
//WWW.NAZROID.IR//
function Source_Home($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

//WWW.NAZROID.IR//
$Dev = array("226277615", "0000", "0000"); // آیدی های ادمین ها را در اینجا قرار دهید
$usernamebot = "nhmmmbot"; // آیدی ربات را در اینجا بدون @ قرار دهید
$channel = "nazroid"; // آیدی کانال را در اینجا بدون @ قرار دهید
$token = API_KEY; // در اینجا چیزی رو دست نزنید
$poshtibani = "nazroid1"; // آیدی مستقیم پشتیبانی را بدون @ در اینجا قرار دهید
$botsupport = "nazroid1"; // آیدی پشتیبانی برای افراد ریپورت را بدون @ در اینجا قرار دهید
//WWW.NAZROID.IR//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$Source_Home = $message->text;
$firstname = $update->callback_query->from->first_name;
$usernames = $update->callback_query->from->username;
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->from->id;
$membercall = $update->callback_query->id;
$time = jdate('H:i:s');
$date = jdate("Y/F/d");
//WWW.NAZROID.IR//
$forward_from_chat = $update->message->forward_from_chat;
$from_chat_id = $forward_from_chat->id;
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$tc = $update->message->chat->type;
$gpname = $update->callback_query->message->chat->title;
$namegroup = $update->message->chat->title;
$forward_from = $update->message->forward_from;
$forward_from_id = $forward_from->id;
$forward_from_username = $forward_from->username;
$reply = $update->message->reply_to_message->forward_from->id;
//WWW.NAZROID.IR//
$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=@" . $channel . "&user_id=" . $from_id));
$tch = $forchannel->result->status;
$forchannelq = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=@" . $channel . "&user_id=" . $fromid));
$tchq = $forchannelq->result->status;
//WWW.NAZROID.IR//
mkdir("data/$from_id");
@$select = file_get_contents("data/$from_id/select.txt");
@$chat = file_get_contents("data/$from_id/chat.txt");
@$member = file_get_contents('data/chat.txt');
@$nashnas = file_get_contents("data/$from_id/nashnas.txt");
@$nashnas2 = file_get_contents("data/$fromid/nashnas.txt");
@$jenstyat = file_get_contents("data/$from_id/jenstyat.txt");
@$age = file_get_contents("data/$from_id/age.txt");
@$city = file_get_contents("data/$from_id/city.txt");
@$adds = file_get_contents("data/$from_id/member.txt");
@$adds2 = file_get_contents("data/$fromid/member.txt");
@$numchat = file_get_contents("data/$from_id/numchat.txt");
@$step = file_get_contents("data/$from_id/file.txt");
@$vip = file_get_contents("data/$from_id/vip.txt");
@$editinfo = file_get_contents("data/$from_id/edit.txt");
@$name = file_get_contents("data/$from_id/name.txt");
@$blocklist = file_get_contents('data/blocklist.txt');
@$like = file_get_contents("data/$from_id/like.txt");
@$deslike = file_get_contents("data/$from_id/deslike.txt");
@$blacklist = file_get_contents("data/$from_id/blacklist.txt");
@$frinds = file_get_contents("data/$from_id/frinds.txt");
//WWW.NAZROID.IR//
function SendMessage($chat_id, $text)
{
    Source_Home('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'MarkDown']);
}

function Forward($berekoja, $azchejaei, $kodompayam)
{
    Source_Home('ForwardMessage', [
        'chat_id' => $berekoja,
        'from_chat_id' => $azchejaei,
        'message_id' => $kodompayam
    ]);
}

function getUserProfilePhotos($token, $from_id)
{
    $url = 'https://api.telegram.org/bot' . $token . '/getUserProfilePhotos?user_id=' . $from_id;
    $result = file_get_contents($url);
    $result = json_decode($result);
    $result = $result->result;
    return $result;
}

//WWW.NAZROID.IR//
@$user = file_get_contents('Member.txt');
$members = explode("\n", $user);
if (!in_array($chat_id, $members)) {
    $add_user = file_get_contents('Member.txt');
    $add_user .= $chat_id . "\n";
    file_put_contents('Member.txt', $add_user);
}
//WWW.NAZROID.IR//
if (strpos($blocklist, "$from_id") !== false) {
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🛑شما به خاطر رعایت نکردن قوانین از ربات مسدود شدید 

❇️لطفا پیام دوباره ارسال نکنید",
        'reply_markup' => json_encode(['KeyboardRemove' => [
        ], 'remove_keyboard' => true
        ])
    ]);
}
if (strpos($Source_Home, '/start ') !== false) {
    $start = str_replace("/start ", "", $Source_Home);
    if ($start == $from_id) {
        Source_Home('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "شما قبلا به ربات دعوت شده ایده ✔️",
        ]);
    } else {
        if ($tch == 'member' or $tch == 'creator' or $tch == 'administrator') {
            if ($start > 0) {
                file_put_contents("data/$from_id/numchat.txt", "10");
                file_put_contents("data/$from_id/member.txt", "0");
                file_put_contents("data/$from_id/like.txt", "0");
                file_put_contents("data/$from_id/deslike.txt", "0");
                $adds1 = file_get_contents("data/$start/member.txt");
                $newmember = $adds1 + 1;
                file_put_contents("data/$start/member.txt", "$newmember");
                $adds2 = file_get_contents("data/$start/member.txt");
                Source_Home('sendmessage', [
                    'chat_id' => $start,
                    'text' => "یک کابر با لینک دعوت شما وارد ربات شد ✔️
📌 تعداد افرادی که دعوت کرده اید : $adds2",
                ]);
                Source_Home('sendmessage', [
                    'chat_id' => $chat_id,
                    'text' => "سلام دوست گرامی به ربات جایزه بگیر تیم نازروید خوش اومدی میتونی با دعوت دوستات به این ربات از جوایز ویژه ما بهرهمند بشی
  

📣 جوایز ویژه هفتگی🙈

📣 جوایز ویژه هفتگی🙈

🌿 جوایز خاص فقط برای شما👇


📅 $date
🕗 $time
🤖 $usernamebot",

                ]);
                file_put_contents("data/$from_id/name.txt", "$first_name");
            }

        } else {
            Source_Home('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "دوست گرامی $first_name عزیز شما در کانال پشتیبانی عضو نیستید و امکان استفاده از چت ناشناس را ندارید ⚠️
	
⭕️برای استفاده کامل از ربات بایستی ابتدا در کانال زیر عضو شوید :

🆔 @$channel

سپس به ربات برگشته و مجدد دستور /start را ارسال کنید و امتحان کنید ✔️
📅 $date
🕗 $time
🤖 $usernamebot",
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => "📍 عضویت در کانال", 'url' => "https://t.me/$channel"],
                        ],
                        [
                            ['text' => "📣 بررسی عضویت", 'callback_data' => "lockchannel"],
                        ],
                    ]
                ])
            ]);
            file_put_contents("data/$from_id/inviter.txt", "$start");
        }
    }
}
if ($Source_Home == "/start" && $tc == "private") {
    if (strpos($user, "$from_id") !== false) {
        Source_Home('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "به منوی اصلی ربات خوش امدید🎉

💮 از دکمه های زیر استفاده کنید👇",
            'reply_markup' => json_encode([
                'keyboard' => [
                    [
                        ['text' => "دریافت جایزه شما"]
                    ],
                    [
                        ['text' => "🏅 زیر مجموعه های شما"]
                    ],

                    [
                        ['text' => "📍 پشتیبانی"], ['text' => "🔖 راهنما"], ['text' => "🤖 درباره ربات"]
                    ],

                ],
                'resize_keyboard' => true
            ])
        ]);
    } else {
        file_put_contents("data/$from_id/numchat.txt", "4");
        file_put_contents("data/$from_id/member.txt", "0");
        file_put_contents("data/$from_id/like.txt", "0");
        file_put_contents("data/$from_id/deslike.txt", "0");
        Source_Home('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "سلام دوست گرامی به ربات جایزه بگیر تیم نازروید خوش اومدی میتونی با دعوت دوستات به این ربات از جوایز ویژه ما بهرهمند بشی
  

📣 جوایز ویژه هفتگی🙈

📣 جوایز ویژه هفتگی🙈

🌿 جوایز خاص فقط برای شما👇


📅 $date
🕗 $time
🤖 $usernamebot",

        ]);
        file_put_contents("data/$from_id/name.txt", "$first_name");
    }
}

//**********

//***********
if ($Source_Home == "🔙 برگشت" && $tc == "private") {
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "به منوی اصلی ربات خوش امدید🎉

💮 از دکمه های زیر استفاده کنید👇",
        'reply_markup' => json_encode([
            'keyboard' => [
                [
                    ['text' => "دریافت جایزه شما"]
                ],
                [
                    ['text' => "🏅 زیر مجموعه های شما"]
                ],

                [
                    ['text' => "📍 پشتیبانی"], ['text' => "🔖 راهنما"], ['text' => "🤖 درباره ربات"]
                ],

            ],
            'resize_keyboard' => true
        ])
    ]);
    file_put_contents("data/$from_id/chat.txt", "none");
    $now = str_replace("$from_id\n", "", $member);
    file_put_contents("data/chat.txt", "$now");
    file_put_contents("data/$from_id/file.txt", "none");
} elseif ($Source_Home == "دریافت جایزه شما" && $tc == "private") {
    if ($vip != "") {
        $memberex = explode("\n", $member);
        $howmember = count($memberex) - 1;
        $randmember = $memberex[mt_rand(0, $howmember)];
        if ($randmember != "" && $randmember != $from_id) {
            file_put_contents("data/$from_id/chat.txt", "chatnashnas");
            file_put_contents("data/$randmember/chat.txt", "chatnashnas");
            file_put_contents("data/$randmember/nashnas.txt", "$from_id");
            file_put_contents("data/$from_id/nashnas.txt", "$randmember");
            $aval = str_replace("$from_id\n", "", $member);
            $member = file_get_contents('data/chat.txt');
            file_put_contents("data/chat.txt", "$aval");
            $dovom = str_replace("$randmember\n", "", $member);
            file_put_contents("data/chat.txt", "$dovom");
            $getuserprofile = getUserProfilePhotos($token, $randmember);
            $cuphoto = $getuserprofile->total_count;
            $getuserphoto = $getuserprofile->photos[0][0]->file_id;
            $getuserprofile2 = getUserProfilePhotos($token, $from_id);
            $cuphoto2 = $getuserprofile2->total_count;
            $getuserphoto2 = $getuserprofile2->photos[0][0]->file_id;
            $like = file_get_contents("data/$randmember/like.txt");
            $deslike = file_get_contents("data/$randmember/deslike.txt");
            $like2 = file_get_contents("data/$from_id/like.txt");
            $deslike2 = file_get_contents("data/$from_id/deslike.txt");
            Source_Home('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "📣 برای گرفتن جوایز آماده باش 🙈

📅 $date
🕗 $time
🤖 $usernamebot",

            ]);

        } else {
            Source_Home('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "🤖 با تشکر از شما :

از لینک زیر میتونی برنامه آموزش زبان انگلیسی رو دانلود کنی👇👇
https://nazroid.ir/1398/02/learning-english-with-paria-akhavass/"


                ,
            ]);

        }
    } else {
        Source_Home('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "دوست عزیز توهم به راحتی میتونی از ما جایزه بگیری 😞
	
کافیه همین الان روی دکمه دعوت دوستان کلیک کنی و  10 نفر از دوستات رو عضو ربات کنی🎯

بعدشم جایزه ت رو بگیری😍"


            ,
            'reply_markup' => json_encode([
                'keyboard' => [
                    [
                        ['text' => "⭐️ دعوت دوستان"]
                    ],
                    [
                        ['text' => "🔙 برگشت"]
                    ],
                ],
                'resize_keyboard' => true
            ])
        ]);

    }
} elseif ($Source_Home == "/vip" or $Source_Home == "🏅 زیر مجموعه های شما" or $Source_Home == "⭐️ دعوت دوستان" && $tc == "private") {
    //************ tedad add ozv 10tA
    $cheghadr = 10 - $adds;
    Source_Home('sendphoto', [
        'chat_id' => $chat_id,

        //***** آدرس لینک بنرتون رو باید در این قسمت بذارید
        'photo' => "https://bit.ly/2VPDhuO",
        'caption' => "📣  ربات تلگرام افزایش ممبر کانال بصورت هرمی و زیر مجموعه گیری😁💦

▫️ربات تلگرم افزایش ممبر کانال بصورت هرمی و زیر مجموعه گیری،با سرعت تصاعدی برای کانال و ربات تون ممبر واقعی و فعال جذب میکنه و همه چیز به صورت خودکار توسط ربات صورت میگیره.🙈

🔖 سورس کد کامل ربات تلگرم افزایش ممبر کانال بصورت هرمی🤦🏼‍♀👇

🌐 https://t.me/$usernamebot?start=$from_id",
    ]);
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "👆🏻 بنر بالا حاوی لینک دعوت شماست ان رو برای دوستان و گروه و کانال خود ارسال کنید و با جمع اوری زیر مجموعه ربات خودتون رو رایگان ویژه کنید 👆🏻",
    ]);
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "📌 تعداد افرادی که دعوت کرده اید : $adds
	
🔱 تعداد نفراتی که باید دعوت کنید تا ربات ویژه شود : $cheghadr",
    ]);
}
if ($Source_Home == "🤖 درباره ربات" && $tc == "private") {
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🤖 ربات جایزه بگیر نازروید 
➖➖➖
📍تمامی حقوق کد نویسی و انتشار این ربات برای سایت نازروید محفوظ است 


💠 WWW.NAZROID.IR

✅ رباتی هوشمند برای جذب ممبر به صورت هرمی

🆔 @$usernamebot",
    ]);
}
if ($Source_Home == "🔖 راهنما" && $tc == "private") {
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🤖 ربات جایزه بگیر نازروید 
➖➖➖➖➖
به بخش راهنمای ربات خوش آمدید 🔆

1️⃣ قوانین ربات ساده است 

⚠️ دوستات رو عضو کن بعدشم جایزه ت رو بگیر


🆔 @$usernamebot",
    ]);
}
if ($Source_Home == "📍 پشتیبانی" && $tc == "private") {
    file_put_contents("data/$from_id/file.txt", "nazar");
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "نظرات شما باعث دلگرمی ماست❤️
➖➖➖➖➖
انتفادات پیشنهادات و نظرات خود را برای ما ارسال کنید✔️
➖➖➖
پیام خود را وارد کنید",
        'reply_markup' => json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [
                    ['text' => "🔙 برگشت"]
                ],
            ]
        ])

    ]);
} elseif ($step == "nazar" && $tc == "private") {
    if ($Source_Home != "🔙 برگشت") {
        unlink("data/$from_id.txt");
        Source_Home('ForwardMessage', [
            'chat_id' => $Dev[0],
            'from_chat_id' => $chat_id,
            'message_id' => $message_id
        ]);
        Source_Home('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "✔️نظر شما ارسال شد.\nبا تشکر از شما",
        ]);
    }
} elseif ($update->message && $rt && $from_id == $Dev[0] && $tc == "private") {
    if ($update->message->text) {
        Source_Home('sendmessage', [
            "chat_id" => $chat_id,
            "text" => "پیام شما برای فرد ارسال شد ✔️"
        ]);
        Source_Home('sendmessage', [
            "chat_id" => $reply,
            "text" => "👤پاسخ پشتیبان برای شما :

`$Source_Home`",
            'parse_mode' => 'MarkDown'
        ]);
    }
}

//************** test
if ($Source_Home == "ادمینم" or $Source_Home == "/panel" or $Source_Home == "مدیریت" or $Source_Home == "/start panel") {
    if (in_array($from_id, $Dev) != false) {
        if ($tc == "private") {
            Source_Home('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "🚦ادمین عزیز به پنل مدریت ربات خوش امدید",
                'reply_to_message_id' => $message_id,
                'reply_markup' => json_encode([
                    'keyboard' => [
                        [
                            ['text' => "💥 امار ربات "], ['text' => "🔆 ویژه کردن"]
                        ],
                        [
                            ['text' => "🔅 ارسال به همه"], ['text' => "📍 فروارد همگانی"]
                        ],
                        [
                            ['text' => "📌 افراد انلاین"], ['text' => "⛔️ مسدود کردن"]
                        ],
                        [
                            ['text' => "🔙 برگشت"]
                        ],
                    ],
                    'resize_keyboard' => true
                ])
            ]);
        }
    }
} elseif ($Source_Home == "⛔️ مسدود کردن") {
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "لطفا یک پیام از کاربر را فوروارد کنید یا ایدی عددی فرد را وارد کنید🚀",
        'reply_markup' => json_encode([
            'keyboard' => [
                [
                    ['text' => "برگشت 🔙"]
                ]
            ],
            'resize_keyboard' => true
        ])
    ]);
    file_put_contents("data/$from_id/file.txt", "block");
} elseif ($step == 'block') {
    if ($Source_Home != "برگشت 🔙") {
        if ($forward_from == true) {
            Source_Home('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "کابر با موفقیت از ربات مسدود شد ✔️

🔹ایدی : $forward_from_id
🔸یوزرنیم : @$forward_from_username",
                'reply_to_message_id' => $message_id,
            ]);
            $adduser = file_get_contents("data/blocklist.txt");
            $adduser .= $forward_from_id . "\n";
            file_put_contents("data/blocklist.txt", $adduser);
            file_put_contents("data/$from_id/file.txt", "none");
        } else {
            Source_Home('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "کابر با موفقیت از ربات مسدود شد ✔️

🔹ایدی : $Source_Home",
                'reply_to_message_id' => $message_id,
            ]);
            $adduser = file_get_contents("data/blocklist.txt");
            $adduser .= $Source_Home . "\n";
            file_put_contents("data/blocklist.txt", $adduser);
            file_put_contents("data/$from_id/file.txt", "none");
        }
    }
} elseif ($Source_Home == "📌 افراد انلاین") {
    $member1 = file_get_contents("data/chat.txt");
    $member2 = explode("\n", $member1);
    $how = count($member2) - 1;
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🤖 تعداد افراد در انتظار چت ناشناس : $how",
        'hide_keyboard' => true,
    ]);
} elseif ($Source_Home == "💥 امار ربات") {
    $mmemcount = count($members) - 1;
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🤖 امار ربات شما : $mmemcount",
        'hide_keyboard' => true,
    ]);
} elseif ($Source_Home == '🔅 ارسال به همه') {
    file_put_contents("data/$from_id/file.txt", "sendtoall");
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "لطفا متن خود را ارسال کنید 🚀",
        'reply_to_message_id' => $message_id,
        'reply_markup' => json_encode([
            'keyboard' => [
                [
                    ['text' => "برگشت 🔙"]
                ]
            ],
            'resize_keyboard' => true
        ])
    ]);
} elseif ($step == 'sendtoall') {
    file_put_contents("data/$from_id/file.txt", "none");
    if ($Source_Home != "برگشت 🔙") {
        Source_Home('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "پیام با موفقیت ارسال شد✔️",
            'reply_to_message_id' => $message_id,
        ]);
        $mem = fopen("Member.txt", 'r');
        while (!feof($mem)) {
            $memuser = fgets($mem);
            Source_Home('sendmessage', [
                'chat_id' => $memuser,
                'text' => $Source_Home,
            ]);
        }
    }
} elseif ($Source_Home == '📍 فروارد همگانی') {
    file_put_contents("data/$from_id/file.txt", "fortoall");
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "لطفا متن خود را فوروارد کنید 🚀",
        'reply_to_message_id' => $message_id,
        'reply_markup' => json_encode([
            'keyboard' => [
                [
                    ['text' => "برگشت 🔙"]
                ]
            ],
            'resize_keyboard' => true
        ])
    ]);
} elseif ($step == 'fortoall') {
    file_put_contents("data/$from_id/file.txt", "none");
    if ($Source_Home != "برگشت 🔙") {
        Source_Home('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "پیام با موفقیت ارسال شد✔️",
            'reply_to_message_id' => $message_id,
        ]);
        $mem = fopen("Member.txt", 'r');
        while (!feof($mem)) {
            $memuser = fgets($mem);
            Forward($memuser, $chat_id, $message_id);
        }
    }
}
if ($Source_Home == 'برگشت 🔙') {
    file_put_contents("data/$from_id.txt", "none");
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "🚦ادمین عزیز به پنل مدریت ربات خوش امدید",
        'reply_to_message_id' => $message_id,
        'reply_markup' => json_encode([
            'keyboard' => [
                [
                    ['text' => "💥 امار ربات "], ['text' => "🔆 ویژه کردن"]
                ],
                [
                    ['text' => "🔅 ارسال به همه"], ['text' => "📍 فروارد همگانی"]
                ],
                [
                    ['text' => "📌 افراد انلاین"], ['text' => "⛔️ مسدود کردن"]
                ],
                [
                    ['text' => "🔙 برگشت"]
                ],
            ],
            'resize_keyboard' => true
        ])
    ]);
} elseif ($Source_Home == '🔆 ویژه کردن') {
    file_put_contents("data/$from_id/file.txt", "setvip");
    Source_Home('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "لطفا یک پیام از کاربر را فوروارد کنید یا ایدی عددی فرد را وارد کنید🚀",
        'reply_to_message_id' => $message_id,
        'reply_markup' => json_encode([
            'keyboard' => [
                [
                    ['text' => "برگشت 🔙"]
                ]
            ],
            'resize_keyboard' => true
        ])
    ]);
} elseif ($step == 'setvip') {
    if ($Source_Home != "برگشت 🔙") {
        if ($forward_from == true) {
            Source_Home('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "کابر با موفقیت ویژه شد ✔️

🔹ایدی : $forward_from_id
🔸یوزرنیم : @$forward_from_username",
                'reply_to_message_id' => $message_id,
            ]);
            file_put_contents("data/$forward_from_id/vip.txt", "true");
            file_put_contents("data/$forward_from_id/member.txt", "10");
            file_put_contents("data/$from_id/file.txt", "none");
        } else {
            if ($Source_Home != "برگشت 🔙") {
                Source_Home('sendmessage', [
                    'chat_id' => $chat_id,
                    'text' => "کابر با موفقیت ویژه شد ✔️

🔹ایدی : $Source_Home",
                    'reply_to_message_id' => $message_id,
                ]);
                file_put_contents("data/$Source_Home/vip.txt", "true");
                file_put_contents("data/$Source_Home/member.txt", "10");
                file_put_contents("data/$from_id/file.txt", "none");
            }
        }
    }
}
unlink("error_log");
	