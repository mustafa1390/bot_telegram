<?php

namespace App\Services\Telegram;

use GuzzleHttp\Psr7;
use App\Models\BotLog;
use App\Models\BotUser;
use App\Models\BotStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BotTelegram
{

    public $bot_token;

    public function __construct()
    {

        $this->bot_token='7616795976:AAFPZljj5HHq_mUXrUB4L9ZGfMz_9LvE0HE';

    }


    public function register($data ){




        $url_news = 'https://www.irpay.pro/';
        $url_bot = 'https://t.me/laravel13_bot';
        $inline= array(
            'resize_keyboard'=>true,
            'inline_keyboard'=>array(
                array(
                    array('text'=>'بازگشت ↖️','callback_data'=>"back"),
                    array('text'=>'ثبت نام کاربر 🚹','callback_data'=>"register"),
                ), array(
                    array('text'=>'آدرس سایت 🌎','url'=>$url_news),
                    array('text'=>'پشتیبانی تلگرام 📱', 'url'=>"https://t.me/irpay_net"),
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
    // BotLog::create(['text'=>$paramm , 'chat_id'=>$data->message->chat->id]);

    }
    public function menue_start($data ){


        $url_news = 'https://www.irpay.pro/';
        $url_bot = 'https://t.me/laravel13_bot';
        $inline= array(
            'resize_keyboard'=>true,
            'inline_keyboard'=>array(
                array(
                    array('text'=>'بازگشت ↖️','callback_data'=>"back"),
                    array('text'=>'ثبت نام کاربر 🚹','callback_data'=>"register"),
                ), array(
                    array('text'=>'آدرس سایت 🌎','url'=>$url_news),
                    array('text'=>'پشتیبانی تلگرام 📱', 'url'=>"https://t.me/irpay_net"),
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
    // BotLog::create(['text'=>$paramm , 'chat_id'=>$data->message->chat->id]);


    }


    public function inline_cl($data,$buton){


        $bot_token = '7616795976:AAFPZljj5HHq_mUXrUB4L9ZGfMz_9LvE0HE';

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
            // BotLog::create(['text'=>$paramm , 'chat_id'=>$msg_id]);
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
                $mediaGroupId = $data['message']['media_group_id'] ?? null;

                if($mediaGroupId){


                    $media_group_id = $data['message']['media_group_id'];
                    $caption = $data['message']['caption'] ?? '';
                    $file_id = end($data['message']['photo'])['file_id'];

                    $album_dir = __DIR__ . "/albums";
                    if (!is_dir($album_dir)) {
                        mkdir($album_dir, 0777, true);
                    }

                    $album_file = $album_dir . "/{$media_group_id}.json";

                    // Load or initialize album data
                    if (file_exists($album_file)) {
                        $album_data = json_decode(file_get_contents($album_file), true);
                    } else {
                        $album_data = ['photos' => [], 'caption' => $caption];
                    }

                    $album_data['photos'][] = $file_id;
                    file_put_contents($album_file, json_encode($album_data));


                    $bot_status = BotStatus::where([ ['id','=',1],   ])->update( ['registerdone' => 0 ] );
                    $text_html = " 🎴 چند تصویری وجود دارد! 🎴 ";
                    $data = [
                        'parse_mode'=>'HTML',
                        'text'=> $text_html,
                        'chat_id'=> $chatId
                    ];

                    $paramm = http_build_query($data);
                    $api_url = "https://api.telegram.org/bot".$this->bot_token."/sendMessage?".$paramm;
                    $result = Http::get($api_url);

                }else{



                // $chatId = $data['message']['chat']['from']['id'];
                $photos = $data['message']['photo'];
                $text = $data['message']['caption'];

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





                    // Send confirmation
                    // Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    //     'chat_id' => $chatId,
                    //     'text' => "📸 Your photo has been saved as: {$fileName}"
                    // ]);




// $text ="
// Wallet ID 2647364
// Full name نرگس ال کثیر (Narges Alkasir)
// First Name نرگس
// Last Name ال کثیر
// Phone 989138660585
// Email narges.alkasir585@gmail.com";


$telegram = new  BotTelegram();
$myarray = $telegram->parseUserData($text);
$tt = preg_match('/^first name\s+(.*)$/im', $text, $matches);



$useri = BotUser::where([ ['email',$myarray['email']], ])->first();

if($useri){

    $text_html = " 🔴 این کاربر قبلا ثبت نام شده است ! 🔴";
}else{

    Storage::disk('uploads')->put("telegram/{$fileName}", $contents);
    $text_html = "<b>✔️ ثبت نام کاربر با موفقیت انجام شد
    💭 اطلاعات ثبت شده
    نام : {$myarray['firstname']}
    نام خانوادگی : {$myarray['lastname']}
    ایمیل : {$myarray['email']}
    تلفن : {$myarray['phonenum']}
    رمزعبور : 🔒🔒🔒🔒🔒🔒
      </b>";
    $myarray['password'] = Hash::make($myarray['wallet_id']);
    $myarray['verifyimg'] = $fileName;
    $bot_user = BotUser::create($myarray);
    $telegram = new  BotTelegram();
    $dater = $telegram->store_irpay($myarray);

    movefile_irpay($bot_user);


}



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

    public function parseUserData($text)
    {
        $lines = explode("\n", $text);
        $data = [];
        $data['wallet_id'] = '';
        $data['firstname'] = '';
        $data['lastname'] = '';
        $data['fullname'] = '';
        $data['phonenum'] = '';
        $data['email'] = '';

        foreach ($lines as $line) {
            $line = trim($line);

            // if (str_starts_with($line, 'Wallet ID')) {
            if (preg_match('/^wallet id\s+(.*)$/im', $line, $matches)) {
                $data['wallet_id'] = trim(str_replace('Wallet ID', '', $line));
            }

            if (preg_match('/^first name\s+(.*)$/im', $line, $matches)) {
                $data['firstname'] = trim(str_replace('First Name', '', $line));
            }


            if (preg_match('/^last name\s+(.*)$/im', $line, $matches)) {
                $data['lastname'] = trim(str_replace('Last Name', '', $line));
            }


            if (preg_match('/^phone\s+(.*)$/im', $line, $matches)) {
                $data['phonenum'] = trim(str_replace('Phone', '', $line));
            }

            if (preg_match('/^email\s+(.*)$/im', $line, $matches)) {
                $data['email'] = trim(str_replace('Email', '', $line));
            }
        }

        return $data;
    }


    public function store_irpay($data)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://irpay.pro/api/user/store',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array(
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
          'email' => $data['email'],
          'phonenum' =>  $data['phonenum'],
          'password' => $data['wallet_id'],
          'verifyimg' => '','city' => 'bot',
          'token' => 'Amer*&uioKOp345!ghJloPPde5&ds'),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 321|2xMkRhkeWHrAcnBZPlmAtTqzg4KU3bhTgpViStoY4fa6ea0b'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    }
