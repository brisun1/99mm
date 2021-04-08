<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\services\IpLocation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('shared', function() {

            $sharingService = new IpLocation();
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
            }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        else
            {
            $ip=$_SERVER['REMOTE_ADDR'];
            }
        $jsonurl = "http://ip-api.com/json/$ip?lang=zh-CN";
        /////
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,$jsonurl);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, config('app.name'));
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        ///////
        //dd(file_get_contents($jsonurl));
        //if(!(file_get_contents($jsonurl))){
        $json = file_get_contents($jsonurl);
        $djason=json_decode($json);
        //}
        if(isset($djason->country) && isset($djson->city)){
            $ip_location['country']=$djason->country;
            $ip_location['city']=$djason->city;
        }    
        else {
            $ip_location['country']='爱尔兰'; //set the default for local machine or ...
            $ip_location['city']='都柏林';
        }
        $ipCountry=$ip_location['country'];
    
        //return $ip_location;
        
            $sharingService->share('ipCountry', $ipCountry);
            // ☝️ you can set values here or in any place, since it's a public method
        
            return $sharingService;
        });
    }
}
