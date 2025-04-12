<?php

namespace App\Services\Telegram;

use GuzzleHttp\Psr7;
use App\Models\BotLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BotTelegram
{

    public $bot_token;

    public function __construct()
    {

        $this->bot_token='7675274082:AAH2mrj9oM_A6t7sbqq_U1QfOhtHdKR3u9g';

    }


    public function register($data ){




        $url_news = 'https://www.irpay.pro/';
        $url_bot = 'https://t.me/laravel13_bot';
        $inline= array(
            'resize_keyboard'=>true,
            'inline_keyboard'=>array(
                array(
                    array('text'=>'آدرس سایت','url'=>$url_news),array('text'=>'اینستاگرام',
                    'url'=>"https://instagram.com/rezakarimpour.pro"),array('text'=>'گیت هاب','url'=>$url_news)
                ), array(
                    array('text'=>'گوگل 🔺️ ','url'=>"https://google.com"),
                    array('text'=>'بازگشت ↖️','callback_data'=>"back"),
                    array('text'=>'ثبت نام کاربر 🚹','callback_data'=>"register"),
                )
            )
        );

        $output = array();

        $output['inline']=$inline;
        $text_html = '<b><a href="'.$url_bot.'">به ربات irpaybbbbb خوش آمدید </a></b>';
        // $datan = [
        //         'text'=>  $text_html,
        //         'chat_id'=> $chat_id,
        //         'reply_markup'=>json_encode($inline)
        //     ];



        // $chat_id = $data->callback_query->id;
        // $text = $data->callback_query->message->text;
        // $msg_id = $data->callback_query->message->message_id;
        // $datab = $data->callback_query->data;


        $datan = [
                'parse_mode'=>'HTML',
                'text'=>  $text_html,
                'chat_id'=> $data->message->chat->id,
                'reply_markup'=>json_encode($inline)
            ];
        $paramm = http_build_query($datan);
        $api_url = "https://api.telegram.org/bot".$this->bot_token."/sendMessage?".$paramm;

    // if(isset($data->message->chat)){
    $result = Http::get($api_url);
    // }
    BotLog::create(['text'=>$paramm , 'chat_id'=>$data->message->chat->id]);

    }
    public function menue_start($data ){


        $url_news = 'https://www.irpay.pro/';
        $url_bot = 'https://t.me/laravel13_bot';
        $inline= array(
            'resize_keyboard'=>true,
            'inline_keyboard'=>array(
                array(
                    array('text'=>'آدرس سایت','url'=>$url_news),array('text'=>'اینستاگرام',
                    'url'=>"https://instagram.com/rezakarimpour.pro"),array('text'=>'گیت هاب','url'=>$url_news)
                ), array(
                    array('text'=>'گوگل 🔺️','url'=>"https://google.com"),
                    array('text'=>'بازگشت ↖️','callback_data'=>"back"),
                    array('text'=>'ثبت نام کاربر 🚹','callback_data'=>"register"),
                )
            )
        );

        $output = array();

        $output['inline']=$inline;
        $text_html = '<b><a href="'.$url_bot.'">به ربات irpay خوش آمدید </a></b>';
        // $datan = [
        //         'text'=>  $text_html,
        //         'chat_id'=> $chat_id,
        //         'reply_markup'=>json_encode($inline)
        //     ];
        $datan = [
                'parse_mode'=>'HTML',
                'text'=>  $text_html,
                'chat_id'=> $data->message->chat->id,
                'reply_markup'=>json_encode($inline)
            ];
        $paramm = http_build_query($datan);
        $api_url = "https://api.telegram.org/bot".$this->bot_token."/sendMessage?".$paramm;

    if(isset($data->message->chat)){
    $result = Http::get($api_url);
    }
    BotLog::create(['text'=>$paramm , 'chat_id'=>$data->message->chat->id]);


    }


    public function inline_cl($data,$buton){


        $bot_token = '7675274082:AAH2mrj9oM_A6t7sbqq_U1QfOhtHdKR3u9g';

        if($buton!='back'){
            $chat_id = $data->message->chat->id;
            $text = $data->message->text;
            $msg_id = $data->message->message_id;
        }
        if($buton=='back'){
            $chat_id = $data->callback_query->id;
            $text = $data->callback_query->message->text;
            $msg_id = $data->callback_query->message->message_id;
            $datab = $data->callback_query->data;
        }
        $my_text = 'جواب پیام شما که اینه را بده لطفا '.$text;




        $btn=array(
            'resize_keyboard'=>true,
            'keyboard'=>array(
                array("شعر","آموزش"),
                array("آموزش")
            ));


            $keyboard = array(
                "inline_keyboard" => array(
                    array(
                        array(
                            "text" => "My Button Text",
                            "callback_data" => "myCallbackData"
                        )
                    )
                )
            );



        $url_news = 'https://www.shabgoosh.ir/';
        $inline= array(
            'resize_keyboard'=>true,
            'inline_keyboard'=>array(
                array(
                    array('text'=>'یوتیوب','url'=>$url_news),array('text'=>'اینستاگرام','url'=>"https://instagram.com/rezakarimpour.pro"),array('text'=>'گیت هاب','url'=>$url_news)
                ), array(
                    array('text'=>'گوگل 🔺️','url'=>"https://google.com"),
                    array('text'=>'chaaaange','callback_data'=>"change"),
                    array('text'=>'wellcome','callback_data'=>"hi"),
                )
            )
        );

        $output = array();

        $output['inline']=$inline;
        $output['my_text']=$my_text;
        $output['chat_id']=$chat_id;
        $output['bot_token']=$bot_token;
        $output['msg_id']=$msg_id;
        $text_html = '<b><a href="'.$url_news.'">لظفا کییک کنید</a></b>';


        if($buton=='send'){
                // $datan = [
                //         'text'=>  $text_html,
                //         'chat_id'=> $chat_id,
                //         'reply_markup'=>json_encode($inline)
                //     ];
                $datan = [
                        'parse_mode'=>'HTML',
                        'text'=>  $text_html,
                        'chat_id'=> $chat_id,
                        'reply_markup'=>json_encode($inline)
                    ];
                $paramm = http_build_query($datan);
                $api_url = "https://api.telegram.org/bot".$bot_token."/sendMessage?".$paramm;

            if(isset($data->message->chat)){
            $result = Http::get($api_url);
            }
            BotLog::create(['text'=>$paramm , 'chat_id'=>$msg_id]);
        }


        if($buton=='back'){

        // $back_chat_id = $data->callback_query->message->message_id;
        $back_chat_id = $data->callback_query->from->id;
        $call_id = $data->callback_query->id;

                $datan = [
                        'text'=> 'message replay'.$my_text,
                        'callback_query_id'=> $call_id,
                        'show_alert'=>false
                    ];
                $paramm = http_build_query($datan);
                $api_url = "https://api.telegram.org/bot".$bot_token."/answerCallbackQuery?".$paramm;
            $result = Http::get($api_url);


            $inline= array(
                'resize_keyboard'=>true,
                'inline_keyboard'=>array(
                    array(
                        array('text'=>'شروع','url'=>$url_news),array('text'=>'شهرجوراب','url'=>"https://instagram.com/rezakarimpour.pro"),array('text'=>' سایرمحصولات ما','url'=>$url_news)
                    ), array(
                        array('text'=>'تقسیم','url'=>"https://google.com"),
                    )
                )
            );

$datan = [
    'text'=>  'بازگشت با موفقیت انجام شد',
    'chat_id'=> $output['chat_id'],
    'reply_markup'=>json_encode($inline)
];
$paramm = http_build_query($datan);
$api_url = "https://api.telegram.org/bot".$bot_token."/sendMessage?".$paramm;
$result = Http::get($api_url);

        }

        if($buton=='member'){

            $channel_id ='@rootonechannel';


            $datan = [
                    'chat_id'=> $channel_id,
                    'user_id'=> $chat_id
                ];
            $paramm = http_build_query($datan);
            $api_url = "https://api.telegram.org/bot".$bot_token."/getChatMember?".$paramm;


$result = Http::get($api_url);
$r  = json_decode($result,true);

$datan = [
        'text'=>  $r,
        'chat_id'=> $chat_id,
        'reply_markup'=>json_encode($inline)
    ];
$paramm = http_build_query($datan);
$api_url = "https://api.telegram.org/bot".$bot_token."/sendMessage?".$paramm;

if(isset($data->message->chat)){
$result = Http::get($api_url);
}

// BotLog::create(['text'=>$result  ]);

        }
        // if($datab=='hi'){

        //     $datan = [
        //         'text'=>  'خوش اومدی',
        //         'chat_id'=> $output['chat_id'],
        //         'reply_markup'=>json_encode($inline)
        //     ];
        // $paramm = http_build_query($datan);
        // $api_url = "https://api.telegram.org/bot".$bot_token."/sendMessage?".$paramm;

        // $result = Http::get($api_url);



        // }

        // return $output;
    }



    public function photo($data)
    {

               // Handle incoming photo
               if (isset($data['message']['photo'])) {
                $chatId = $data['message']['chat']['id'];
                // $chatId = $data['message']['chat']['from']['id'];
                $photos = $data['message']['photo'];

                // Get the highest-resolution version (last one)
                $fileId = end($photos)['file_id'];

                // Get file path from Telegram API
                $token = env('TELEGRAM_BOT_TOKEN');
                $getFile = Http::get("https://api.telegram.org/bot{$token}/getFile", [
                    'file_id' => $fileId
                ])->json();

                if (isset($getFile['result']['file_path'])) {
                    $filePath = $getFile['result']['file_path'];
                    $fileUrl = "https://api.telegram.org/file/bot{$token}/{$filePath}";

                    // Download and save to storage (e.g., storage/app/public/telegram/)
                    $contents = file_get_contents($fileUrl);
                    $fileName = basename($filePath);

                    $current_timestamp = \Carbon\Carbon::now()->timestamp;
                    // $current_timestamp = 'Me_';
                    $fileName =$current_timestamp.$fileName;

                    // uploadFile_bot($data);

                    Storage::disk('uploads')->put("telegram/{$fileName}", $contents);




                    // Send confirmation
                    // Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    //     'chat_id' => $chatId,
                    //     'text' => "📸 Your photo has been saved as: {$fileName}"
                    // ]);


            $text_html = "<b> تصویر با موفقیت
            آپلود شد  saved as: {$fileName} </b>";
            $data = [
                'parse_mode'=>'HTML',
                'text'=> $text_html,
                'chat_id'=> $chatId
            ];

            $paramm = http_build_query($data);
            $api_url = "https://api.telegram.org/bot".$this->bot_token."/sendMessage?".$paramm;
            $result = Http::get($api_url);




                }

                return $fileName;
            }


    }



    }
