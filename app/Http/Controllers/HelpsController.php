<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
//use App\Mail\NewUserWelcome;
use App\Mail\EmailClass;
use Auth;

class HelpsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    public function email(){
        $topic='12345';
        
        Mail::to('highlevelstructures@gmail.com')->send(new EmailClass('contactus',$topic,auth()->user()->username));
        //Mail::to(Auth::user()->email)->send(new EmailClass('contactus',auth()->user()->username));
        return redirect('/');

    }
}
