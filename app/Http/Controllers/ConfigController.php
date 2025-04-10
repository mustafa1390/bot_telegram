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




    exec('composer dump-autoload');





    }


public function add_admin_demo(){


// update_model_v1('admin_demo1');
// update_model_v1('admin_demo2');


// $cleander_month =  calender_route_origin(null  ,null , 'cleander_month'  );
// $cleander_today =  calender_route_origin(null  ,null , 'cleander_today'  );

    }




}
