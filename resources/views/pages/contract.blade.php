@extends('layouts.app')

@section('content')
    <div class="container">
        <h5>移民婚约</h5>
        <hr>
@if(count($country_num) > 0)
    
@foreach($country_num as $country_name)
    <h5 class="text-success">{{$country_name->ucountry}}</h5>
    @if(count($posts) > 0)
    
        <div class="row">
        @foreach($posts as $post)
            @if($post->ucountry===$country_name->ucountry)
                            
                <div class="col-md-3 col-sm-3">
                        
                    @if($post->img0)
                        <div class="">
                            <img src="/storage/img_name/{{$post->img0}}" style="height:150px; width:240px" atl="无图片">
                        </div>
                    
                    @endif
                    <div class="row">
                    
                    @if(($post->img1)&&($post->img2))
                        <div class="col-md-6 col-sm-6">
                            
                            <img src="/storage/img_name/{{$post->img1}}" style=" height:70px; width:100px">
                            
                        </div>

                        <div class="col-md-6 col-sm-6">
                        
                            <img src="/storage/img_name/{{$post->img2}}" style=" height:70px; width:100px">
                            
                        </div>
                    @endif
                    </div>
                    <h3 class="text-center font-weight-bold">{{$post->uname}}</h3>
                    
                </div>

            <div class="col-md-6 col-sm-6">
                      
                <h5>{{$post->topic}}</h5>
              
                <p class="">
                        {{$post->info}}
                </p>
                
                <div class="button-group">
                    <button class="btn btn-outline-primary emailbtn" data-last="{{$post->email}}" data-email_on="1">
                            <span><a class="seeE">显示Email</a></span>
                    </button>
                    
                    @if(isset($_COOKIE[$post->user_id])&&$_COOKIE[$post->user_id]=='pending')
                        <div >
                            电话号码:<b class="text-danger">{{$post->tel}}</b> 
                        </div>
                    @else
                        <a href="/customerPay/{{$post->user_id}}/contract" class="btn btn-primary ">付款取得电话</a>
                    @endif
                    {{--@if (session()->has($post->user_id))
                    
                        @if(session($post->user_id)=='paid') 
                            <div class="text-danger">
                              你要查询的电话号码是:<b>{{$post->tel}}</b> 
                            </div>
                        @endif
                    @elseif(isset($_COOKIE[$post->user_id])&&$_COOKIE[$post->user_id]=='pending')
                    
                            
                            <p class="text-danger d-inline">你的付款正在处理中...</p>
                            <button class="btn btn-primary " onClick="window.location.reload();">刷新查看</button>
                        
                        -->
                    @else
                        <a href="/customerPay/contract/{{$post->user_id}}" class="btn btn-primary ">付款取得电话</a>
                    @endif
                    --}}
                </div>
            </div>

            <div class="col-md-3 col-sm-">
                
                <div>
                    <ul>
                            
                            <li>居住国家 :{{$post->ucountry}}</li>
                        @if($post->city)
                            <li>现住城市 :{{$post->city}}</li>
                        @endif
                            <li>性别 :
                                {{$post->gender}}
                                 
                            </li>
                        
                        @if($post->age)
                            <li>年龄 :{{$post->age}}</li>
                        @endif
                        
                        @if($post->look)
                            <li>相貌 :{{$post->look}}</li>
                        @endif
                        @if($post->visa)
                            <li>现有身份或签证 :{{$post->visa}}</li>
                        @endif
                        @if($post->mstatus)
                            <li>婚姻状况 :{{$post->mstatus}}</li>
                        @endif
                        @if($post->national)
                            <li>原国籍 :{{$post->national}}</li>
                        @endif
                        
                    </ul>
                        
                    <small>&nbsp&nbsp刷新日期：{{$post->updated_at}}  </small>
                </div>
            </div>
                        
            <div class="container">  
                
                @if(!Auth::guest())
                    @if(Auth::user()->id==$post->user_id)
                        <a href="/contracts/{{$post->id}}/edit" class="btn btn-primary">修改</a>
                        {!!Form::open(['action' => ['ContractsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('删除', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    @endif
                @endif
                <hr>
            </div>
              
            @endif
        @endforeach
        </div>
    @else
        <p>对不起，没有移民婚约的资料。</p>
    @endif
@endforeach
@else
    <p>对不起，没有签证条件婚约的资料。</p>
@endif
    </div> 

<script>
    $('.emailbtn').click(function() {
        var email = $(this).data('last');
        var email_on= $(this).data('email_on');
        if(email_on){
            $(this).find('span').html( '<a href="emailto:' + email + '">' + email + '</a>' );
        }        
    });
</script>   
    
@endsection

