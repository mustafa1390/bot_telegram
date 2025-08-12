<?php

namespace App\Http\Controllers\Bot;

use GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BotLog;
use App\Models\BotStatus;
use App\Services\Telegram\BotTelegram;
use Illuminate\Support\Facades\Http;

class BotTelegramController extends Controller
{

    public $bot_token;

    public function __construct()
    {

        $this->bot_token='7318110679:AAGulnwhChbYaHh-Ziva6FBayx4pFmkQiVk';

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



    $bot_status = BotStatus::where([ ['id','=',1],   ])->orderBy('id', 'desc')->first();

    if(isset($data->callback_query)){
        if(($data->callback_query->data=='register')&&($bot_status->register==1)){
            $bot_status = BotStatus::where([ ['id','=',1], ['register','=',1], ])->update( ['register' => 0 ] );
            // $telegram = new  BotTelegram();
            // $output = $telegram->inline_cl($data,'back');
            // $chat_id = $data->callback_query->id;
            // $chat_id = $data->callback_query->from->id;
            // $chat_id = 166451980;

            $text_html = "<b> 📢 لطفا اطلاعات کاربر را به همراه تصویر وریفای کاربر آپلود نمایید ◼️◾️▪️  </b>";
    // $data = [
    //     'parse_mode'=>'HTML',
    //     'text'=> $text_html,
    //     'chat_id'=> 166451980
    // ];

    $inline= array(
        'resize_keyboard'=>true,
        'inline_keyboard'=>array(
            array(
                 array('text'=>'اینستfffاگرام',
                'url'=>"https://instagram.com/rezakarimpour.pro")
            ), array(
                array('text'=>'گوگل 🔺️ ','url'=>"https://google.com"),
                array('text'=>'بازگشت ↖️','callback_data'=>"back"),
                array('text'=>'ثبت نام کاربر 🚹','callback_data'=>"register"),
            )
        )
    );


    $datan = [
        'parse_mode'=>'HTML',
        'text'=>  $text_html,
        'chat_id'=> $data->callback_query->from->id,
        // 'reply_markup'=>json_encode($inline)
    ];

    $paramm = http_build_query($datan);
    $api_url = "https://api.telegram.org/bot".$this->bot_token."/sendMessage?".$paramm;
    $result = Http::get($api_url);

         $bot_status = BotStatus::where([ ['id','=',1],   ])->update( ['registerdone' => 1 ] );
        }
    }

    $bot_status = BotStatus::where([ ['id','=',1],   ])->orderBy('id', 'desc')->first();
    if(isset($data->message)){
    if(isset($data->message->text)){
        if(($data->message->text=='/reset')&&($bot_status->start==0)){

            $bot_status = BotStatus::where([ ['id','=',1],  ])->update( ['start' => 1 ] );
        }
        if(($data->message->text=='/start')){
            // &&($bot_status->start==1)
            $telegram = new  BotTelegram();
            $output = $telegram->menue_start($data );
            $bot_status = BotStatus::where([ ['id','=',1],  ])->update( ['register' => 1 ] );
            $bot_status = BotStatus::where([ ['id','=',1],  ])->update( ['start' => 0 ] );




            // BotLog::create(['chat_id'=>$data->message->chat->id  ]);
        }
    //     $text_html = "<b>به ربات irpaybbbbb خوش آمدید   text: {$data->message->text} </b>";


    //     $datan = [
    //             'parse_mode'=>'HTML',
    //             'text'=>  $text_html,
    //             'chat_id'=> $data->message->chat->id
    //         ];
    //     $paramm = http_build_query($datan);
    //     $api_url = "https://api.telegram.org/bot".$this->bot_token."/sendMessage?".$paramm;

    // $result = Http::get($api_url);


    }


    $bot_status = BotStatus::where([ ['id','=',1],   ])->orderBy('id', 'desc')->first();

    $word = "name";
    if (isset($data->message) && isset($data->message->photo)&& isset($data->message->caption) && ($bot_status->registerdone==1) ) {
    if (  ($data->message->caption!=null)  ) {
        $mydata = $request->all();
        $bot_status = BotStatus::where([ ['id','=',1],  ])->update( ['start' => 1 ] );
         $telegram = new  BotTelegram();
         $fileName = $telegram->photo($mydata);
        //  $bot_status = BotStatus::where([ ['id','=',1],   ])->update( ['registerdone' => 0 ] );

    }
    }



}





   }
   public function set_webhook(){

    $this->bot_token = '7318110679:AAGulnwhChbYaHh-Ziva6FBayx4pFmkQiVk';
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


