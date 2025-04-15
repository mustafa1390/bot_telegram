<?php

namespace App\Http\Controllers;

use CURLFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;

class ConfigController extends Controller
{


    public function send_curl_test(){


        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://irpay.pro/api/user/validate_user',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array(
          'email' => 'mustafa1390@gmail.com',
          'phonenum' =>  '09384762155',
          'token' => 'Amer*&uioKOp345!ghJloPPde5&ds'),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 321|2xMkRhkeWHrAcnBZPlmAtTqzg4KU3bhTgpViStoY4fa6ea0b'
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        echo $response->status;
        dd($response);

    }


    public function config_optimize(){
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('migrate');

    // exec('composer dump-autoload');


    // return movefile_irpay('Me_file_8.jpg');

    $fileName = '1744300222file_8.jpg';
    $imagePath = '/public/upload/telegram/';
    // $filePath = public_path($imagePath.$fileName);
    // $filePath = $imagePath.$fileName;

    $filePath = public_path('/upload/telegram/'.$fileName);

    // dd($filePath);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://irpay.pro/api/user/upload');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, [
       'image' => new CURLFile($filePath, mime_content_type($filePath), $fileName),
       'token' => 'Amer*&uioKOp345!ghJloPPde5&ds',
    ]);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
       echo 'no curl';
    } else {
       echo 'Ok';
    }
    curl_close($ch);




    }


public function add_admin_demo(){


// update_model_v1('admin_demo1');
// update_model_v1('admin_demo2');


// $cleander_month =  calender_route_origin(null  ,null , 'cleander_month'  );
// $cleander_today =  calender_route_origin(null  ,null , 'cleander_today'  );

    }




}
