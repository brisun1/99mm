<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Escortb;
use App\Status;
use Mail;
use App\Mail\EmailClass;
use Image;

class EscortbsController extends Controller
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
            'city' => 'required|string|max:30',
            'tel' => 'required|string|max:40',
            
            'info' => 'required|string|max:700',
            'age'=>'required|numeric|max:99',
            'national'=>'string|max:15|nullable',
            'look'=>'string|max:8|nullable',
            'lan'=>'string|max:30|nullable',
            'shape'=>'string|max:8|nullable',
            'height'=>'numeric|max:5|nullable',
            'hobby'=>'string|max:25|nullable',
            'price'=>'string|max:15|nullable',
            
            'img0'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img1'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img2'=>'image|mimes:jpeg,bmp,png|size:10000|nullable'
                      
        ]);

        $uname=auth()->user()->username;

        $escortb = new Escortb;
        if ($escortb->uname===null) {
            $escortb->user_id = auth()->user()->id;
            //$escortbs -> setTable(Auth::user()->ucountry.'_escortbs_tbl');
            $escortb->ucountry = auth()->user()->ucountry;
            $escortb->city = $request->input('city');
            $escortb->uname = $uname;
            $escortb->tel = $request->input('tel');
            $escortb->email = auth()->user()->email;
          
            $escortb->info = $request->input('info');
            $escortb->age = $request->input('age');
            $escortb->national = $request->input('national');
            $escortb->look = $request->input('look');
            $escortb->lan = $request->input('lan');
            $escortb->shape = $request->input('shape');
            $escortb->height = $request->input('height');
            $escortb->hobby = $request->input('hobby');
            $escortb->price = $request->input('price');
          
          
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
                    $img[$i]=Image::make($photo)->resize(null,300)->save(public_path().'/storage/img_name/'.$fileNameToStore[$i]);
                    // Upload Image
                    //$path = $photo->storeAs('public/img_name', $fileNameToStore[$i]);
                    //dd($path);
                    $img_column='img'.$i;
                    $escortb->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            } else {
                $fileNameToStore = 'no-user.jpg';
                $escortb->img0=$fileNameToStore;
            }

          
            $escortb->save();


            

            //email to escortbs


            //Mail::to(Auth::user()->email)->send(new EmailClass('regConf.escortbsReg',$uname));


       
        return redirect('/more')->with('success', '上传成功!');
        }else{
            return redirect('/more')->with('error', '你的资料已上传过了。如须更改，请按修改按钮!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        $escortb= Escortb::find($id);
        
        if(auth()->user()->id!=$escortb->user_id){
            //need to confirm if '/posts'
            return redirect('/escortbs')->with('error','unathorized page');
        }
        
        return view('escortbs.escortb_edit')->with('escortb',$escortb);
        
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
            'city' => 'required|string|max:30',
            'tel' => 'required|string|max:40',
         
            'info' => 'required|string|max:700',
            'age'=>'required|numeric|max:99',
            'national'=>'string|max:15|nullable',
            'look'=>'string|max:8|nullable',
            'lan'=>'string|max:30|nullable',
            'shape'=>'string|max:8|nullable',
            'height'=>'numeric|max:5|nullable',
            'hobby'=>'string|max:25|nullable',
            'price'=>'string|max:15|nullable',
          
            'img0'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img1'=>'image|mimes:jpeg,bmp,png|size:2000|nullable',
            'img2'=>'image|mimes:jpeg,bmp,png|size:2000|nullable'
                      
        ]);

        $uname=auth()->user()->username;
        // user found
        $escortb= Escortb::find($id);
        
        if ($escortb->uname==$uname) {
            //$escortb->user_id = auth()->user()->id;
            //$escortbs -> setTable(Auth::user()->ucountry.'_escortbs_tbl');
            $escortb->ucountry = auth()->user()->ucountry;
            $escortb->city = $request->input('city');
            $escortb->uname = $uname;
            $escortb->tel = $request->input('tel');
            $escortb->email = auth()->user()->email;
         
            $escortb->info = $request->input('info');
            $escortb->age = $request->input('age');
            $escortb->national = $request->input('national');
            $escortb->look = $request->input('look');
            $escortb->lan = $request->input('lan');
            $escortb->shape = $request->input('shape');
            $escortb->height = $request->input('height');
            $escortb->hobby = $request->input('hobby');
            $escortb->price = $request->input('price');
          
          
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
                    $img[$i]=Image::make($photo)->resize(null,300)->save(public_path().'/storage/img_name/'.$fileNameToStore[$i]);
                    // Upload Image
                    //$path = $photo->storeAs('public/img_name', $fileNameToStore[$i]);
                    //dd($path);
                    $img_column='img'.$i;
                    $escortb->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            } else {
                $fileNameToStore = 'no-user.jpg';
                $escortb->img0=$fileNameToStore;
            }

          
            $escortb->save();


            //store data to status tbl
            


            //email to escortbs


            //Mail::to(Auth::user()->email)->send(new EmailClass('regConf.escortbsReg',$uname));


       
        return redirect('/more')->with('success', '上传成功!');
        }else{
            return redirect('/more')->with('error', '你的资料已上传过了。如须更改，请按修改按钮!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Escortb::find($id);
        if(auth()->user()->id!=$post->user_id){
            return redirect('/more')->with('error','you are unathorized！');
        }
        $post->delete();
        return redirect('/more')->with('success', '你的资料已成功删除！');
    }
}

