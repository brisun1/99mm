<?php

namespace App\Http\Controllers;
use App\Ip;
use Illuminate\Support\Facades\Schema;
//use Illuminate\Support\Facades\Auth;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Status;
use App\Miss;
use App\Ptmiss;
use App\Massage;
use App\Contract;
//use App\More;
use App\Baoyang;
use App\Escorth;
use App\Escortb;
//use App\Post;


class PagesController extends Controller
{
    private $ip_country;
    //get country name from ip-api.com
    private $city_num=array();
    private $posts=array();
    public function __construct(Ip $customServiceInstance)
    {
        $ip_location=$customServiceInstance->get_location();
        $this->ip_country=$ip_location['country']; 
        
        
       /* $jsonurl="http://api.ipstack.com/?access_key=a555bd8c31430bd0fcd7bc9ab1a76096 & fields=ip & language=zh & output=json";
        $json = file_get_contents($jsonurl);
        $djason=json_decode($json);
        $this->ip_country= $djason->country_name;
        ***/
        /*
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
       
$access_key = 'a555bd8c31430bd0fcd7bc9ab1a76096';

// Initialize CURL:
$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$api_result = json_decode($json, true);

// Output the "capital" object inside "location"
$this->ip_country=$api_result['country_name'];
***/
}

    public function index()
    {
        
        $miss = new Miss;
        $status = new Status;
        //get country name by ip
        /*
        $jsonurl = "http://ip-api.com/json/?lang=zh-CN";
        $json = file_get_contents($jsonurl);
        
        //var_dump(json_decode($json));
        $djason=json_decode($json);
        $ip_country= $djason->country;
        */
        $tbl=$this->ip_country.'_miss_tbl';
        $miss -> setTable($tbl);
       // $posts = Post::where('status','free')->get();
        //$posts = Post::orderBy('name','asc')->get();
        //$posts = Post::orderBy('name','asc')->get();
        //if(){
            if (Schema::hasTable($tbl))
            {
                //join tbl with status
                //  $miss_display=DB::table($tbl)
                //  //->join('contacts', 'users.id', '=', 'contacts.user_id')
                //  ->join('statuses', '?????????_miss_tbl.user_id','=','statuses.user_id')
                 
                //  ->where('expire_at', '>=', date("Y-m-d"))
                //  ->get();
            $this->city_num=$miss->select('city')->distinct('city')->get();
            //1$city_num=Miss::select('city')->distinct('city')->get();
            //$this->posts = $miss_display->orderBy('created_at','asc')->get();
            $string_id=$tbl.'.uname';
            $this->posts = DB::table($tbl)
            ->join('statuses', $string_id,'=','statuses.uname')
            
            //->where('expire_at', '<=', date('Y-m-d'))->orderBy('created_at','asc')
            ->get();
            //$city_num=Post::select('city')->groupBy('city');
            //2$posts = Miss::orderBy('created_at','asc')->get();
            //$posts=Post::groupBy('city')->get();
            //$posts = DB::table('posts')->groupBy('city')->get();
            
            
            }else{
                $this->posts=0;
                $this->city_number=0;

            }
        
        return view('pages.index')->with('posts', $this->posts)->
        with('city_num',$this->city_num)->with('ip_country', $this->ip_country);
    }
    ////
    public function massage(){
        $massage = new Massage;
        $status = new Status;
        
        $tbl=$this->ip_country.'_massage_tbl';
        $massage -> setTable($tbl);
       
            if (Schema::hasTable($tbl))
            {
               
            $this->city_num=$massage->select('city')->distinct('city')->get();
            //1$city_num=Miss::select('city')->distinct('city')->get();
            //$this->posts = $miss_display->orderBy('created_at','asc')->get();
            $string_id=$tbl.'.uname';
            $this->posts = DB::table($tbl)
            ->join('statuses', $string_id,'=','statuses.uname')
            
            
            ->get();
            
            }else{
                $this->posts=0;
                $this->city_number=0;

            }
        
        return view('pages.massage')->with('posts', $this->posts)->
        with('city_num',$this->city_num)->with('ip_country', $this->ip_country);
    }
    
    public function baoyang(){
            $baoyang = new Baoyang;
            
            
            //$tbl=$this->ip_country.'_baoyang_tbl';
            //$baoyang -> setTable($tbl);
            //if (Schema::hasTable($tbl)){
            if (Schema::hasTable('baoyangs')){
                $this->city_num=Baoyang::select('city')->distinct('city')->get();
                $this->posts = Baoyang::orderBy('created_at','asc')->get();
                //$baoyang =Baoyang::get();
                }
        return view('pages.baoyang')->with('posts',$this->posts)->
        with('city_num',$this->city_num)->with('ip_country',$this->ip_country);
    }
    public function ptmiss(){
        
        $ptmiss = new Ptmiss;
        $status = new Status;
        $tbl=$this->ip_country.'_ptmiss_tbl';
        $ptmiss -> setTable($tbl);
        if (Schema::hasTable($tbl)){
            $this->city_num=$ptmiss->select('city')->distinct('city')->get();
            $string_id=$tbl.'.user_id';
            $this->posts = DB::table($tbl)
            ->join('statuses', $string_id,'=','statuses.user_id')
            ->get();
        }else{
            $this->posts=0;
            $this->city_number=0;

        }
        return view('pages.ptmiss')->with('posts',$this->posts)->
        with('city_num',$this->city_num)->with('ip_country',$this->ip_country);
    }

    public function contract(){
        $contract = new Contract;
        
        $this->country_num=Contract::select('ucountry')->distinct('ucountry')->get();
        $this->posts = Contract::orderBy('created_at','asc')->get();
        //$baoyang =Baoyang::get();
           
        return view('pages.contract')->with('posts',$this->posts)
            ->with('country_num',$this->country_num)->with('ip_country',$this->ip_country);
    }
    /*
    public function more(){
        
        $ptmiss = new Ptmiss;
        $tbl=$this->ip_country.'_ptmiss_tbl';
        $ptmiss -> setTable($tbl);
        if (Schema::hasTable($tbl)){
            $this->city_num=$ptmiss->select('city')->distinct('city')->get();
            $this->posts = $ptmiss->orderBy('created_at','asc')->get();
            //$baoyang =Baoyang::get();
        }
        return view('pages.more')->with('posts',$this->posts)->
        with('city_num',$this->city_num)->with('ip_country',$this->ip_country);
    }
    */
    public function more(){
        //$posts=array();
        $baoyang = new Baoyang;
        if (Schema::hasTable('baoyangs')){
            $this->city_num=$baoyang->select('city')->distinct('city')->get();
            $baoyangs = $baoyang->orderBy('created_at','asc')->get();
            //$baoyang =Baoyang::get();
        }
        $escorth = new Escorth;
        if (Schema::hasTable('escorths')){
            $city_num_h=$escorth->select('city')->distinct('city')->get();
            $escorths = $escorth->orderBy('created_at','asc')->get();
            //$baoyang =Baoyang::get();
        }
        $escortb = new Escortb;
        if (Schema::hasTable('escortbs')){
            $city_num_b=$escortb->select('city')->distinct('city')->get();
            $escortbs = $escortb->orderBy('created_at','asc')->get();
            //$baoyang =Baoyang::get();
        }
        return view('pages.more')->with('baoyangs',$baoyangs)->
        with('city_num',$this->city_num)->with('escorths',$escorths)->
        with('city_num_h',$city_num_h)->with('escortbs',$escortbs)->
        with('city_num_b',$city_num_b)->with('ip_country',$this->ip_country);
    }
    public function help(){
        if(Auth::check()){
            $ename=auth()->user()->username;
            $email=auth()->user()->email;
        }else{
            $ename=null;
            $email=null;
        }
   
        $services=['full','mass','part','others'];
        return view('pages.help',compact('services'))
        
                    ->with('content','contactus')
                    ->with('ename',$ename)
                    ->with('email',$email);
    }
}