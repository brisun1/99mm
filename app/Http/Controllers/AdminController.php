<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use DB;

class AdminController extends Controller
{
    function initprice(){
        DB::table('price')->insert([
            ['country' => '爱尔兰', 'name'=>'miss','week_price'=>'50','dweeks_price'=>
            '90','month_price'=>'170','created_at'=> now(),'updated_at'=> now()],
        
            ['country' => '爱尔兰', 'name'=>'ptmiss','week_price'=>'40','dweeks_price'=>
            '80','month_price'=>'150','created_at'=> now(),'updated_at'=> now()],
       
            ['country' => '爱尔兰', 'name'=>'massage','week_price'=>'50','dweeks_price'=>
            '90','month_price'=>'170','created_at'=> now(),'updated_at'=> now()]
        ]);
 
        return view('admin')->with('success','ireland price init');
    } 
}
