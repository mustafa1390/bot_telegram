<?php

use App\Models\BotLog;
use Illuminate\Support\Facades\Http;


if(! function_exists('bot_1') ) {
    function bot_1( $method,$parm )
    {

        $bot_token = '6815750639:AAHhrOI075qPJw1kAjxt7HHV-hnY5dIaLNA';
        $api_url = "https://api.telegram.org/bot".$bot_token."/getme";

        $API_URL='https://api.telegram.org/bot'.$bot_token.'/';

        if(!$parm){
            $parm = array();
        }
        $parm["method"] = $method;
        $handle = curl_init($API_URL);
        curl_setopt($handle,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($handle,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($handle,CURLOPT_TIMEOUT,60);
        curl_setopt($handle,CURLOPT_POSTFIELDS,json_encode($parm));
        curl_setopt($handle,CURLOPT_HTTPHEADER,array("Content-Type:application/json"));
        $result = curl_exec($handle);
        return $result;

    }
}

if(! function_exists('bot_10') ) {
    function bot_10( $chat_id , $my_text )
    {



        // return $paramm;







    }
}

if(! function_exists('bot_11') ) {
    function bot_11( $data )
    {

        // if(isset($data->callback_query)){
        //     $text = 'callback';
        // }
        // if(isset($data['callback_query'])){

        //     $call_id= $data['callback_query']['id'];
        //     $data= $data['callback_query']['data'];
        //     $chat_id = $data['callback_query']['from']['id'];
        //     $message_id = $data['callback_query']['message']['message_id'];
        //     $message = $data['callback_query']['message']['text'];
        //     $callback_query = $data->callback_query->data;

        //     $inline= array(
        //         'resize_keyboard'=>true,
        //         'inline_keyboard'=>array(
        //             array(
        //                 array('text'=>'youtube','url'=>$url_news),array('text'=>'instagram','url'=>"https://instagram.com/rezakarimpour.pro"),array('text'=>' git','url'=>$url_news)
        //             ), array(
        //                 array('text'=>'list next','url'=>"https://google.com"),
        //                 array('text'=>'back','callback_data'=>"change"),
        //             )
        //         )
        //     );



        // $datan = [
        //     'text'=> 'ye changeeeee',
        //     'chat_id'=> $chat_id,
        //     'reply_markup'=>json_encode($inline)
        // ];
        // $paramm_chhange = http_build_query($datan);

        //     $api_url = "https://api.telegram.org/bot".$this->bot_token."/sendMessage?".$paramm_chhange;
        //     $result = Http::get($api_url);


        // }


    }
}

if(! function_exists('bot_12') ) {
    function bot_12(   )
    {


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
                    array('text'=>'گوگل','url'=>"https://google.com"),
                    array('text'=>'chaaaange','callback_data'=>"change"),
                )
            )
        );

        return $inline;



    }
}


if(! function_exists('uploadFile') ) {

    function uploadFile($file,$path,$defaultfile)
    {
 if($file){
        $current_timestamp = \Carbon\Carbon::now()->timestamp;
        $imagePath = "/upload/$path/";
        $filename = $current_timestamp . $file->getClientOriginalName();
        $file = $file->move(public_path($imagePath) , $filename);
        return $imagePath.$filename;

 }else{
     return $defaultfile;
 }
    }

}

if(! function_exists('uploadFile_bot') ) {

    function uploadFile_bot($data)
    {
        if (isset($data['message']['photo'])) {
            $photo = end($data['message']['photo']); // Get the highest quality photo
            $file_id = $photo['file_id'];

            // Use Telegram API to get the file path 
            $telegramToken = env('TELEGRAM_BOT_TOKEN');
            $file_info = file_get_contents("https://api.telegram.org/bot$telegramToken/getFile?file_id=$file_id");
            $file_info = json_decode($file_info, true);

            if ($file_info['ok']) {
                $file_path = $file_info['result']['file_path'];
                $file_url = "https://api.telegram.org/file/bot$telegramToken/$file_path";

                // Download the file
                $file_contents = file_get_contents($file_url);

                // Generate filename
                $current_timestamp = time();
                $filename = $current_timestamp . '_' . basename($file_path);

                // Define image path
                $imagePath = 'uploads/telegram/';
                $fullPath = public_path($imagePath);

                // Ensure the directory exists
                if (!file_exists($fullPath)) {
                    mkdir($fullPath, 0777, true);
                }

                // Save the file
                file_put_contents($fullPath . $filename, $file_contents);
            }
        }
    }
}
