<?php

namespace App\Http\Controllers;

use CURLFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;

class ConfigController extends Controller
{


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
