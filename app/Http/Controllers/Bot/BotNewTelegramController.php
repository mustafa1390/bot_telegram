<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BotNewTelegramController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $data = $request->all();

        // Handle /start command



$word = "name"; 
if (isset($data['message']) && isset($data['message']['photo']) && ($data['message']['caption']!=null)&&(strpos($data['message']['caption'], $word) !== false) ) {
     $fileName = $this->photo($data);
     return movefile_irpay($fileName);
}

        if (isset($data['message']) && isset($data['message']['text'])) {
            $text = $data['message']['text'];
            $chatId = $data['message']['chat']['id'];

            if ($text === '/start') {
                return $this->sendMenu($chatId);
            }

$word = "test";

if (strpos($text, $word) !== false) {
    $fileName = 'bb';
if (isset($data['message']['photo'])) {
    return $fileName = $this->photo($data);
}
    return $this->Reg_data($chatId,$fileName);
} else {

}

        }



        // Handle inline button click (callback query)
        if (isset($data['callback_query'])) {
            $chatId = $data['callback_query']['message']['chat']['id'];
            $callbackData = $data['callback_query']['data'];
            $callbackId = $data['callback_query']['id'];

            $replyText = match($callbackData) {
                'help' => "📘 Here's some help info!",
                'search' => "🔎 Please type your search query.",
                default => "🤖 Unknown option"
            };

            // Answer the button press
            Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/answerCallbackQuery", [
                'callback_query_id' => $callbackId
            ]);

            // Send reply
            Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
                'chat_id' => $chatId,
                'text' => $replyText,
            ]);
        }

        return response('ok', 200);
    }

    public function sendMenu($chatId)
    {
        $keyboard = [
            "inline_keyboard" => [
                [
                    ["text" => "📄 Help", "callback_data" => "help"],
                    ["text" => "🔍 Search", "callback_data" => "search"]
                ],
                [
                    ["text" => "🌐 Website", "url" => "https://example.com"]
                ]
            ]
        ];

        $message = "👋 Welcome! Use the menu below:";

        return Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'reply_markup' => json_encode($keyboard),
        ]);
    }
    public function Reg_data($chatId,$fileName)
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
          CURLOPT_POSTFIELDS => array('firstname' => 'moestafaa','lastname' => 'yooseffi',
          'email' => 'mustafa1388@gmail.com',
          'phonenum' => '09384762155','password' => '123456','verifyimg' => $fileName,'city' => 'bot',
          'token' => 'Amer*&uioKOp345!ghJloPPde5&ds'),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 321|2xMkRhkeWHrAcnBZPlmAtTqzg4KU3bhTgpViStoY4fa6ea0b'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

// echo $response;


                $text_html = '<b><a href="#"> ثبت نام شما در سایت irpay با موفقیت انجام شد </a></b>';
                $datan = [
                        'parse_mode'=>'HTML',
                        'text'=>  $text_html,
                        'chat_id'=> $chatId
                    ];
                $paramm = http_build_query($datan);
                $api_url = "https://api.telegram.org/bot". env('TELEGRAM_BOT_TOKEN') ."/sendMessage?".$paramm;
                return Http::post($api_url);





    }

    public function photo($data)
    {

               // Handle incoming photo
               if (isset($data['message']['photo'])) {
                $chatId = $data['message']['chat']['id'];
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
                    Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                        'chat_id' => $chatId,
                        'text' => "📸 Your photo has been saved as: {$fileName}"
                    ]);



                }

                return $fileName;
            }


    }



}
