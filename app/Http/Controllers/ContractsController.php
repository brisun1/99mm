<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Contract;
use App\Status;
use Image;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'visa' => 'required|string|max:12',
            'tel' => 'required|string|max:40',
            'gender' => 'required|string|max:8',
            'info' => 'required|string|max:800',
            'topic'=>'required|string|max:50',
            'city'=>'string|max:20|nullable',
            'national'=>'required|string|max:20',
            'age'=>'required|integer|max:99',
            'mstatus'=>'required|string|max:8',
            'look'=>'string|max:20|nullable',
            'price'=>'required|string|max:30|nullable',
            'img0'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img1'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img2'=>'image|mimes:jpeg,bmp,png|size:10000|nullable'
            //'img_name'=>'image|nullable'
            //'image|mimes:jpeg,bmp,png|size:2000'
        ]);

        $uname=auth()->user()->username;

        $status = new Status;
        $status_uname=Status::where('uname', '=', $uname)->first();
        $contract = new Contract;
        $contract_uname=Contract::where('uname', '=', $uname)->first();
        if ($contract_uname===null) {
            // user found

            $contract->user_id = auth()->user()->id;
            //$contracts -> setTable(Auth::user()->ucountry.'_contracts_tbl');
            $contract->ucountry = auth()->user()->ucountry;
            $contract->uname = auth()->user()->username;
            $contract->email = auth()->user()->email;
            $contract->topic = $request->input('topic');
            $contract->info = $request->input('info');
            $contract->tel = $request->input('tel');
            $contract->email = auth()->user()->email;
            $contract->visa = $request->input('visa');
            $contract->city = $request->input('city');
            $contract->national = $request->input('national');
            $contract->gender = $request->gender;
            $contract->age = $request->input('age');
            $contract->mstatus= $request->input('mstatus');
            $contract->look = $request->input('look');
            $contract->price = $request->input('price');
            
            // Handle File Upload
            $i=0;
            if($request->hasFile('filename')){

                foreach ($request->file('filename') as $photo){
                    // Get filename with the extension
                    $filenameWithExt = $photo->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $photo->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore[$i]= $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $photo->storeAs('public/img_name', $fileNameToStore[$i]);
                    //dd($path);
                    $img_column='img'.$i;
                    $contract->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            }
          
            $contract->save();
            if ($status_uname===null) {
                $status->user_id = auth()->user()->id;
                $status->uname = $uname;
                $status->utype = auth()->user()->utype;
                $status->ucountry = auth()->user()->ucountry;
                $status->verified= 0;
                $status->status= 'free';
                $status->expire_at = date('Y-m-d', strtotime(' + 12months'));
                $status->last_update=date("Y-m-d");
                $status->verified="pending";
                $status->save();
            }
            //email to contracts

            //Mail::to(Auth::user()->email)->send(new regEmailClass('contractReg',$uname));
        
        return redirect('/contract')->with('success', '上传成功!');
        }else{
            return redirect('/contract')->with('error', '你的资料已上传过了!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $contract=new Contract;
        $post= $contract->find($user_id);
        /*
        if(Auth::check()){
            $ename=auth()->user()->username;
            $email=auth()->user()->email;
        }else{
            $ename=null;
            $email=null;
        }
        */
        return view('contracts.contract_show')->with('post',$post);
    //    return view('contracts.showNemail')->with('post',$post)->
    //    with('content','contactus')->with('ename',$ename)->with('email',$email);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ucountry=Auth::user()->ucountry;
        $contract= Contract::find($id);
        
        if(auth()->user()->id!=$contract->user_id){
            //need to confirm if '/posts'
            return redirect('/contracts')->with('error','unathorized page');
        }
        
        return view('contracts.contract_edit')->with('contract',$contract)->with('ucountry',$ucountry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'visa' => 'required|string|max:12',
            'tel' => 'required|string|max:40',
            'gender' => 'required|string|max:8',
            'info' => 'required|string|max:800',
            'topic'=>'required|string|max:50',
            'city'=>'string|max:20|nullable',
            'national'=>'required|string|max:20',
            'age'=>'required|integer|max:99',
            'mstatus'=>'required|string|max:8',
            'look'=>'string|max:20|nullable',
            'price'=>'required|string|max:30|nullable',
            'img0'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img1'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img2'=>'image|mimes:jpeg,bmp,png|size:10000|nullable'
            //'img_name'=>'image|nullable'
            //'image|mimes:jpeg,bmp,png|size:2000'
        ]);

        $uname=auth()->user()->username;

        
        $contract = Contract::find($id);
        //$contract_uname=Contract::where('uname', '=', $uname)->first();
            
        
            // user found

            $contract->user_id = auth()->user()->id;
            //$contracts -> setTable(Auth::user()->ucountry.'_contracts_tbl');
            $contract->ucountry = auth()->user()->ucountry;
            $contract->uname = auth()->user()->username;
            $contract->email = auth()->user()->email;
            $contract->topic = $request->input('topic');
            $contract->info = $request->input('info');
            $contract->tel = $request->input('tel');
            $contract->email = auth()->user()->email;
            $contract->visa = $request->input('visa');
            $contract->city = $request->input('city');
            $contract->national = $request->input('national');
            $contract->gender = $request->gender;
            $contract->age = $request->input('age');
            $contract->mstatus= $request->input('mstatus');
            $contract->look = $request->input('look');
            $contract->price = $request->input('price');
            
            // Handle File Upload
            $i=0;
            if($request->hasFile('filename')){

                foreach ($request->file('filename') as $photo){
                    // Get filename with the extension
                    $filenameWithExt = $photo->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $photo->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore[$i]= $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $photo->storeAs('public/img_name', $fileNameToStore[$i]);
                    //dd($path);
                    $img_column='img'.$i;
                    $contract->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            }
          
            $contract->save();
            
            //email to contracts

            //Mail::to(Auth::user()->email)->send(new regEmailClass('contractReg',$uname));
            

       
        return redirect('/contract')->with('success', '你的资料修改成功!');
        /*
        {
            return redirect('/contract')->with('error', '你的资料已修改过了!');
        }
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Contract::find($id);
        if(auth()->user()->id!=$post->user_id){
            return redirect('/contract')->with('error','you are unathorized！');
        }
        $post->delete();
        return redirect('/contract')->with('success', '你的资料已成功删除！');
    }
    public function email(Request $request){
        $subject=$request->input('subject');
        $topic=$request->input('message');
        $from=auth()->user()->email;
        $ename=auth()->user()->name;
        
        Mail::to('chinesedriver.com@gmail.com')->send(new EmailClass('contactus',$topic,$ename));
        //Mail::to(Auth::user()->email)->send(new EmailClass('contactus',auth()->user()->username));
        return redirect('/');
    }
}
