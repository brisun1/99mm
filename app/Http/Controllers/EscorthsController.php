<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Escorth;
use App\Status;
use Mail;
use App\Mail\EmailClass;
use Image;

class EscorthsController extends Controller
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
            'shape'=>'string|max:8|nullable',
            'height'=>'numeric|max:5|nullable',
            'hobby'=>'string|max:25|nullable',
            'price'=>'string|max:15|nullable',
            
            'img0'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img1'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img2'=>'image|mimes:jpeg,bmp,png|size:10000|nullable'
                      
        ]);

        $uname=auth()->user()->username;

        $escorth = new Escorth;
        if ($escorth->uname===null) {
            $escorth->user_id = auth()->user()->id;
            //$escorths -> setTable(Auth::user()->ucountry.'_escorths_tbl');
            $escorth->ucountry = auth()->user()->ucountry;
            $escorth->city = $request->input('city');
            $escorth->uname = $uname;
            $escorth->tel = $request->input('tel');
            $escorth->email = auth()->user()->email;
          
            $escorth->info = $request->input('info');
            $escorth->age = $request->input('age');
            $escorth->national = $request->input('national');
            $escorth->look = $request->input('look');
            $escorth->shape = $request->input('shape');
            $escorth->height = $request->input('height');
            $escorth->hobby = $request->input('hobby');
            $escorth->price = $request->input('price');
          
          
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
                    $escorth->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            } else {
                $fileNameToStore = 'no-user.jpg';
                $escorth->img0=$fileNameToStore;
            }

          
            $escorth->save();


            

            //email to escorths


            //Mail::to(Auth::user()->email)->send(new EmailClass('regConf.escorthsReg',$uname));


       
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
        
        
        $escorth= Escorth::find($id);
        
        if(auth()->user()->id!=$escorth->user_id){
            //need to confirm if '/posts'
            return redirect('/escorths')->with('error','unathorized page');
        }
        
        return view('escorths.escorth_edit')->with('escorth',$escorth);
        
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
            'shape'=>'string|max:8|nullable',
            'height'=>'numeric|max:5|nullable',
            'hobby'=>'string|max:25|nullable',
            'price'=>'string|max:15|nullable',
          
            'img0'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img1'=>'image|mimes:jpeg,bmp,png|size:10000|nullable',
            'img2'=>'image|mimes:jpeg,bmp,png|size:10000|nullable'
                      
        ]);

        $uname=auth()->user()->username;
        // user found
        $escorth= Escorth::find($id);
        
        if ($escorth->uname==$uname) {
            //$escorth->user_id = auth()->user()->id;
            //$escorths -> setTable(Auth::user()->ucountry.'_escorths_tbl');
            $escorth->ucountry = auth()->user()->ucountry;
            $escorth->city = $request->input('city');
            $escorth->uname = $uname;
            $escorth->tel = $request->input('tel');
            $escorth->email = auth()->user()->email;
         
            $escorth->info = $request->input('info');
            $escorth->age = $request->input('age');
            $escorth->national = $request->input('national');
            $escorth->look = $request->input('look');
            $escorth->shape = $request->input('shape');
            $escorth->height = $request->input('height');
            $escorth->hobby = $request->input('hobby');
            $escorth->price = $request->input('price');
          
          
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
                    $escorth->{$img_column}=$fileNameToStore[$i];
                    $i++;
                }
            } else {
                $fileNameToStore = 'no-user.jpg';
                $escorth->img0=$fileNameToStore;
            }

          
            $escorth->save();


            //store data to status tbl
            


            //email to escorths


            //Mail::to(Auth::user()->email)->send(new EmailClass('regConf.escorthsReg',$uname));


       
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
        $post= Escorth::find($id);
        if(auth()->user()->id!=$post->user_id){
            return redirect('/more')->with('error','you are unathorized！');
        }
        $post->delete();
        return redirect('/more')->with('success', '你的资料已成功删除！');
    }
}

