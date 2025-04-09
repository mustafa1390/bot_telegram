<?php

namespace App\Http\Controllers\Bot;

use GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BotLog;
use Illuminate\Support\Facades\Http;

class BotTelegramController extends Controller
{

    public $bot_token;

    public function __construct()
    {

        $this->bot_token='6815750639:AAHhrOI075qPJw1kAjxt7HHV-hnY5dIaLNA';

    }


    public function inline_cl($data,$buton){


        $bot_token = '6815750639:AAHhrOI075qPJw1kAjxt7HHV-hnY5dIaLNA';

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
                    array('text'=>'chaaaange','callback_data'=>"change"),array('text'=>'wellcome','callback_data'=>"hi"),
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

   public function token(){



    $api_url = "https://api.telegram.org/bot".$this->bot_token."/getme";
    $result = Http::get($api_url);
    $response = json_decode($result, true);
    return $response;

    echo '<br>';

    echo 'first_name = '.$response['result']['first_name'].'<br>';
    echo 'Username = '.$response['result']['username'].'<br>';
    echo 'id = '.$response['result']['id'].'<br>';


   }

   public function get_update(){
    $api_url = "https://api.telegram.org/bot".$this->bot_token."/getUpdates";
    $result = Http::get($api_url);
    $response = json_decode($result, true);
    return $response;

    echo '<br>';


   }


   public function url_webhook(Request $request){


    $content = file_get_contents("php://input");
    $data = json_decode($content);



    if(isset($data->callback_query)){

        if($data->callback_query->data=='change'){

            $h = new BotTelegramController();
            $output = $h->inline_cl($data,'back');
        }

        // $back_chat_id = $data->callback_query->message->message_id;
        $back_chat_id = $data->callback_query->from->id;
        $bot_log = BotLog::where([ 'chat_id'=>$back_chat_id ])->first();

        if($bot_log==null){
        $text = $data->callback_query->data." _ ".$data->callback_query->id." _ ".$data->callback_query->from->id;
        BotLog::create(['text'=>$text , 'chat_id'=>$back_chat_id ]);
        }
    }else{


        if($data->message->text=='chati'){
            $h = new BotTelegramController();
            $output = $h->inline_cl($data,'send');
        }

        if($data->message->text=='member'){
            $h = new BotTelegramController();
            $output = $h->inline_cl($data,'member');
        }


    }


   }
   public function set_webhook(){

    $this->bot_token = '6815750639:AAHhrOI075qPJw1kAjxt7HHV-hnY5dIaLNA';
    $url_webhook = 'https://alfa724.ir/telegram/url_webhookk';
    $api_url = "https://api.telegram.org/bot".$this->bot_token."/setWebhook?url=".$url_webhook;

    echo 'set is webhook';
    echo '<br>';
    $result = Http::get($api_url);
    return $result;

    echo '<br>';

   }

   public function info_webhook(){

    $api_url = "https://api.telegram.org/bot".$this->bot_token."/getWebhookInfo";
    $result = Http::get($api_url);
    $response = json_decode($result, true);
    return $response;


   }
   public function test_send(){




    // $my_text = '00';
    // $chat_id = '22';
    // $btn=array(
    //     'resize_keyboard'=>true,
    //     'keyboard'=>array(
    //         array("شعر","آموزش"),
    //         array("آموزش")
    //     ));
    //     $data = [
    //         'text'=> 'message replay'.$my_text,
    //         'chat_id'=> $chat_id,
    //         'reply_markup'=>$btn
    //     ];
    //    $b = array("chat_id"=>$chat_id,'text'=>$my_text,'reply_markup'=>$btn);
    //     $paramm =  json_encode($b);






    $data = [
        'text'=> 'message man',
        'chat_id'=> 166451980
    ];

    $paramm = http_build_query($data);

    $api_url = "https://api.telegram.org/bot".$this->bot_token."/sendMessage?".$paramm;
    // dd($api_url);
    $result = Http::get($api_url);

    // $a= bot_1("sendMessage",array('parse_mode'=>'HTML','chat_id'=>$chat_id,'text'=>"  سلام به ربات root one  خوش امدید"."\n".$text2, 'disable_web_page_preview' =>  true, 'reply_to_message_id'=>$msg_id ));


    // $contet = file_get_contents("php://input");
    // $update = json_decode($contet,true);
    // $chat_id = $update["message"]["chat"]["id"];
    // $text = $update["message"]['text'];
    // $msg_id = $update['message']['message_id'];

    // $text2 = "https://youtube.com/@root_one";

    // echo $chat_id;

    BotLog::create(['text'=>$result]);




   }

}
