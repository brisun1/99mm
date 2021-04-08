<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoresController extends Controller
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
            'city' => 'required',
            'tel' => 'required',
            'info' => 'required'
            //'img_name'=>'image|nullable'
            //'image|mimes:jpeg,bmp,png|size:2000'
        ]);

        $uname=auth()->user()->username;

        $status = new Status;
        $status_uname=Status::where('uname', '=', $uname)->first();
        if ($status_uname===null) {
            // user found


            $baoyang = new Baoyang;
            $baoyang->user_id = auth()->user()->id;
            //$baoyangs -> setTable(Auth::user()->ucountry.'_baoyangs_tbl');
            $baoyang->ucountry = auth()->user()->ucountry;
            $baoyang->city = $request->input('city');
            $baoyang->uname = $uname;
            $baoyang->tel = $request->input('tel');
            $baoyang->email = $request->input('email');
            $baoyang->info = $request->input('info');
            $baoyang->age = $request->input('age');
            $baoyang->national = $request->input('national');
            $baoyang->look = $request->input('look');
            $baoyang->shape = $request->input('shape');
            $baoyang->height = $request->input('height');
            $baoyang->hobby = $request->input('hobby');
            $baoyang->price = $request->input('price');
            $baoyang->period = $request->input('period');
          
            //  Handle File Upload
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
                    $baoyang->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            } else {
                $fileNameToStore = 'no-user.jpg';
                $baoyang->img0=$fileNameToStore;
            }

          
            $baoyang->save();


            //store data to status tbl

            
            $status->user_id = auth()->user()->id;
            $status->uname = $uname;
            $status->utype = auth()->user()->utype;
            $status->ucountry = auth()->user()->ucountry;
            $status->verified= 0;

            $status->status= 'free';
            $status->expire_at = date('Y-m-d', strtotime(' + 4months'));
            $status->last_update=date("Y-m-d");
            $status->save();



            //email to baoyangs


            //Mail::to(Auth::user()->email)->send(new EmailClass('regConf.baoyangsReg',$uname));


       
        return redirect('/baoyang')->with('success', '上传成功!');
        }else{
            return redirect('/baoyang')->with('error', '你的资料已上传过了!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
   
}
