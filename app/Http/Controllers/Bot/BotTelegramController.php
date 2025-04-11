<?php

namespace App\Http\Controllers\Bot;

use GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BotLog;
use App\Services\Telegram\BotTelegram;
use Illuminate\Support\Facades\Http;

class BotTelegramController extends Controller
{

    public $bot_token;

    public function __construct()
    {

        $this->bot_token='7675274082:AAH2mrj9oM_A6t7sbqq_U1QfOhtHdKR3u9g';

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

        if($data->callback_query->data=='register'){
            $telegram = new  BotTelegram();
            $output = $telegram->inline_cl($data,'back');
        }

        if($data->callback_query->data=='change'){
            $telegram = new  BotTelegram();
            $output = $telegram->inline_cl($data,'back');
        }

        // $back_chat_id = $data->callback_query->message->message_id;
        $back_chat_id = $data->callback_query->from->id;
        $bot_log = BotLog::where([ 'chat_id'=>$back_chat_id ])->first();

        if($bot_log==null){
        $text = $data->callback_query->data." _ ".$data->callback_query->id." _ ".$data->callback_query->from->id;
        BotLog::create(['text'=>$text , 'chat_id'=>$back_chat_id ]);
        }
    }else{


        if($data->message->text=='/start'){
            $telegram = new  BotTelegram();
            $output = $telegram->menue_start($data );
        }

        if($data->message->text=='/starti'){
            $telegram = new  BotTelegram();
            $output = $telegram->inline_cl($data,'send');
        }
        if($data->message->text=='member'){
            $telegram = new  BotTelegram();
            $output = $telegram->inline_cl($data,'member');
        }


    }


   }
   public function set_webhook(){

    $this->bot_token = '7675274082:AAH2mrj9oM_A6t7sbqq_U1QfOhtHdKR3u9g';
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
