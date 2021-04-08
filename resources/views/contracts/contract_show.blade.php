@extends('layouts.app')

@section('content')
 <h1>签证条件婚约</h1>
   
 
 <h2>{{$post->ucountry}}</h2>
 
     <div class="container">
         <div class="row">
         
                   
             <div class="col-md-3 col-sm-3">
                 @if($post->img0)
                 
                     <img src="/storage/img_name/{{$post->img0}}" style="height:130px; width:200px">
                 
                     @else
                     
                         <img src="/storage/img_name/no-user.jpg" style="height:130px; width:200px">
                     
                         @endif
                     <h3>{{$post->uname}}</h3>
             </div>
 
             <div class="col-md-6 col-sm-6">
                         
                 <h5>
                         {{$post->topic}}
                 </h5>
                             
                             
                 
                 <p class="">
                         {{$post->info}}
                 </p>
                 
                 <div class="button-group">
                     <a href="/contracts/{{$post->id}}" class="btn btn-primary">发邮件联系</a>
                     <button class="next">付款取得电话</button>
                 </div>
             </div>
 
             <div class="col-md-3 col-sm-">
                 <div>
                         <ul>
                                 
                                 <li>居住国家:{{$post->ucountry}}</li>
                             @if($post->city)
                                 <li>现住城市:{{$post->city}}</li>
                             @endif
                                 <li>性别:{{$post->gender}}</li>
                             
                             @if($post->age)
                                 <li>年龄:{{$post->age}}</li>
                             @endif
                             
                             @if($post->look)
                                 <li>外貌:{{$post->look}}</li>
                             @endif
                             @if($post->visa)
                                 <li>现有身份或签证:{{$post->visa}}</li>
                             @endif
                             @if($post->mstatus)
                                 <li>婚姻状况:{{$post->mstatus}}</li>
                             @endif
                             @if($post->national)
                                 <li>原国籍:{{$post->national}}</li>
                             @endif
                             
                         </ul>
                         
                         <small>&nbsp&nbsp刷新日期：{{$post->updated_at}}  </small>
                 </div>
             </div>
             <hr>
         
     </div>
 
        
 <!-- email form  -->      
    @if(session('message'))
    <div class='alert alert-success'>
      {{ session('message') }}
    </div>
    @endif
    
    <div class="col-12 col-md-6">
      <form class="form-horizontal" method="POST" action="{{ action('HelpsController@email') }}">
        {{ csrf_field() }} 
        <div class="form-group form-inline">
        <label for="Name">姓名： </label>
        <input type="text" class="form-control" id="ename" value="{{$ename}}" placeholder="{{$ename}}" name="name" required>
      </div>

      <div class="form-group form-inline">
        <label for="email">Email或电话: </label>
        <input type="text" class="form-control" id="email" value="{{$email}}" placeholder="{{$email}}" name="email" required>
      </div>

      <div class="form-group">
        <label for="message">内容: </label>
        <textarea type="text" rows="12" class="form-control luna-message" id="help_msg" placeholder="Type your messages here" name="message" required></textarea>
      </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary" value="Send">Send</button>
              </div>
              
      </form>
    </div>
	
 </div>
    
     
     
     
 @endsection