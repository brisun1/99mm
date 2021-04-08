@extends('layouts.app')

@section('content')


    <div class="container">
        
    @if(count($city_num) > 0)
        <h5>包养(协议式关系)信息</h5>
        <hr>
        @foreach($city_num as $city_name)
            <h5 class="text-success">{{$city_name->city}}</h5>
            @if(count($baoyangs) > 0)
            
                <div class="row">
                @foreach($baoyangs as $baoyang)
                    @if($baoyang->city==$city_name->city)
                                    
                        <div class="col-md-3 col-sm-3">
                                
                            @if($baoyang->img0)
                                <div class="">
                                    <img src="/storage/img_name/{{$baoyang->img0}}" style="height:150px; width:240px" atl="无图片">
                                </div>
                            
                            @endif
                            <div class="row">
                            
                            @if(($baoyang->img1)&&($baoyang->img2))
                                <div class="col-md-6 col-sm-6">
                                    
                                    <img src="/storage/img_name/{{$baoyang->img1}}" style=" height:70px; width:100px">
                                    
                                </div>

                                <div class="col-md-6 col-sm-6">
                                
                                    <img src="/storage/img_name/{{$baoyang->img2}}" style=" height:70px; width:100px">
                                    
                                </div>
                            @endif
                            </div>
                            <h3 class="text-center font-weight-bold">{{$baoyang->uname}}</h3>
                            
                        </div>

                    <div class="col-md-6 col-sm-6">
                            
                        <h5>{{$baoyang->topic}}</h5>
                    
                        <p class="">
                                {{$baoyang->info}}
                        </p>
                        
                        <div class="button-group">
                            <button class="btn btn-outline-primary emailbtn" data-last="{{$baoyang->email}}" data-email_on="1">
                                    <span><a class="seeE">显示Email</a></span>
                            </button>
                            
                            @if(isset($_COOKIE[$baoyang->user_id])&&$_COOKIE[$baoyang->user_id]=='pending')
                                <div >
                                    电话号码:<b class="text-danger">{{$baoyang->tel}}</b> 
                                </div>
                            @else
                                <a href="/customerPay/{{$baoyang->user_id}}/baoyang" class="btn btn-primary ">付款取得电话</a>
                            @endif
                            {{--@if (session()->has($baoyang->user_id))
                            
                                @if(session($baoyang->user_id)=='paid') 
                                    <div class="text-danger">
                                    你要查询的电话号码是:<b>{{$baoyang->tel}}</b> 
                                    </div>
                                @endif
                            @elseif(isset($_COOKIE[$baoyang->user_id])&&$_COOKIE[$baoyang->user_id]=='pending')
                            
                                    
                                    <p class="text-danger d-inline">你的付款正在处理中...</p>
                                    <button class="btn btn-primary " onClick="window.location.reload();">刷新查看</button>
                                
                                -->
                            @else
                                <a href="/customerPay/contract/{{$baoyang->user_id}}" class="btn btn-primary ">付款取得电话</a>
                            @endif
                            --}}
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-">
                        
                        <div>
                            <ul>
                                    
                                    <li>居住国家 :{{$baoyang->ucountry}}</li>
                                @if($baoyang->city)
                                    <li>现住城市 :{{$baoyang->city}}</li>
                                @endif
                                    <li>性别 :
                                        {{$baoyang->gender}}
                                        
                                    </li>
                                
                                @if($baoyang->age)
                                    <li>年龄 :{{$baoyang->age}}</li>
                                @endif
                                @if($baoyang->national)
                                    <li>原国籍 :{{$baoyang->national}}</li>
                                @endif
                                @if($baoyang->look)
                                    <li>相貌 :{{$baoyang->look}}</li>
                                @endif
                                @if($baoyang->shape)
                                    <li>身材 :{{$baoyang->shape}}</li>
                                @endif
                                @if($baoyang->height)
                                    <li>身高 :{{$baoyang->height}}</li>
                                @endif
                                @if($baoyang->hoppy)
                                    <li>爱好 :{{$baoyang->hoppy}}</li>
                                @endif
                                @if($baoyang->period)
                                    <li>计划包养时间 :{{$baoyang->period}}</li>
                                @endif
                                @if($baoyang->price)
                                    <li>价格范围 :{{$baoyang->price}}</li>
                                @endif
                                
                                
                                
                            </ul>
                                
                            <small>&nbsp&nbsp刷新日期：{{$baoyang->updated_at}}  </small>
                        </div>
                    </div>
                                
                    <div class="container">  
                        
                        @if(!Auth::guest())
                            @if(Auth::user()->id==$baoyang->user_id)
                                <a href="/baoyangs/{{$baoyang->id}}/edit" class="btn btn-primary">修改</a>
                                {!!Form::open(['action' => ['BaoyangsController@destroy', $baoyang->id], 'method' => 'POST', 'class' => 'float-right'])!!}
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
                <p>对不起，没有包养的资料。</p>
            @endif
        @endforeach
    @else
    <p>对不起，没有包养(协议式关系)信息。</p>
    @endif
    <!--escorth starts-->
    @if(count($city_num_h) > 0)
        <h5>伴游信息</h5>
        <hr>
        @foreach($city_num_h as $city_name)
            <h5 class="text-success">{{$city_name->city}}</h5>
            @if(count($escorths) > 0)
            
                <div class="row">
                @foreach($escorths as $escorth)
                    @if($escorth->city==$city_name->city)
                                    
                        <div class="col-md-3 col-sm-3">
                                
                            @if($escorth->img0)
                                <div class="">
                                    <img src="/storage/img_name/{{$escorth->img0}}" style="height:150px; width:240px" atl="无图片">
                                </div>
                            
                            @endif
                            <div class="row">
                            
                            @if(($escorth->img1)&&($escorth->img2))
                                <div class="col-md-6 col-sm-6">
                                    
                                    <img src="/storage/img_name/{{$escorth->img1}}" style=" height:70px; width:100px">
                                    
                                </div>

                                <div class="col-md-6 col-sm-6">
                                
                                    <img src="/storage/img_name/{{$escorth->img2}}" style=" height:70px; width:100px">
                                    
                                </div>
                            @endif
                            </div>
                            <h3 class="text-center font-weight-bold">{{$escorth->uname}}</h3>
                            
                        </div>

                    <div class="col-md-6 col-sm-6">
                    
                        <p>{{$escorth->info}}</p>
                        
                        
                        <div class="btn-group">
                            
                            <button class="btn btn-outline-primary escTel" data-last="{{$escorth->tel}}">
                                    <span><a class="see">显示电话 </a></span>
                            </button>
                        
                        </div>
                            
                            
                            {{--@if (session()->has($baoyang->user_id))
                            
                                @if(session($baoyang->user_id)=='paid') 
                                    <div class="text-danger">
                                    你要查询的电话号码是:<b>{{$baoyang->tel}}</b> 
                                    </div>
                                @endif
                            @elseif(isset($_COOKIE[$baoyang->user_id])&&$_COOKIE[$baoyang->user_id]=='pending')
                            
                                    
                                    <p class="text-danger d-inline">你的付款正在处理中...</p>
                                    <button class="btn btn-primary " onClick="window.location.reload();">刷新查看</button>
                                
                                -->
                            @else
                                <a href="/customerPay/contract/{{$baoyang->user_id}}" class="btn btn-primary ">付款取得电话</a>
                            @endif
                            --}}
                        
                    </div>

                    <div class="col-md-3 col-sm-">
                        
                        <div>
                            <ul>
                                    
                                    <li>居住国家 :{{$escorth->ucountry}}</li>
                                @if($escorth->city)
                                    <li>现住城市 :{{$escorth->city}}</li>
                                @endif
                                    <li>性别 :
                                        {{$escorth->gender}}
                                        
                                    </li>
                                
                                @if($escorth->age)
                                    <li>年龄 :{{$escorth->age}}</li>
                                @endif
                                @if($escorth->national)
                                    <li>原国籍 :{{$escorth->national}}</li>
                                @endif
                                @if($escorth->look)
                                    <li>相貌 :{{$escorth->look}}</li>
                                @endif
                                @if($escorth->shape)
                                    <li>身材 :{{$escorth->shape}}</li>
                                @endif
                                @if($escorth->height)
                                    <li>身高 :{{$escorth->height}}</li>
                                @endif
                                @if($escorth->hoppy)
                                    <li>爱好 :{{$escorth->hoppy}}</li>
                                @endif
                                
                                @if($escorth->price)
                                    <li>价格 :{{$escorth->price}}</li>
                                @endif
                                
                                
                                
                            </ul>
                                
                            <small>&nbsp&nbsp刷新日期：{{$escorth->updated_at}}  </small>
                        </div>
                    </div>
                                
                    <div class="container">  
                        
                        @if(!Auth::guest())
                            @if(Auth::user()->id==$escorth->user_id)
                                <a href="/escorths/{{$escorth->id}}/edit" class="btn btn-primary">修改</a>
                                {!!Form::open(['action' => ['EscorthsController@destroy', $escorth->id], 'method' => 'POST', 'class' => 'float-right'])!!}
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
                <p>对不起，没有伴游的资料。</p>
            @endif
        @endforeach
    @else
        <p>对不起，没有伴游信息。</p>
    @endif
    <!--escortb starts-->
    @if(count($city_num_b) > 0)
        <h5>商务陪伴信息</h5>
        <hr>
        @foreach($city_num_b as $city_name)
            <h5 class="text-success">{{$city_name->city}}</h5>
            @if(count($escortbs) > 0)
            
                <div class="row">
                @foreach($escortbs as $escortb)
                    @if($escortb->city==$city_name->city)
                                    
                        <div class="col-md-3 col-sm-3">
                                
                            @if($escortb->img0)
                                <div class="">
                                    <img src="/storage/img_name/{{$escortb->img0}}" style="height:150px; width:240px" atl="无图片">
                                </div>
                            
                            @endif
                            <div class="row">
                            
                            @if(($escortb->img1)&&($escortb->img2))
                                <div class="col-md-6 col-sm-6">
                                    
                                    <img src="/storage/img_name/{{$escortb->img1}}" style=" height:70px; width:100px">
                                    
                                </div>

                                <div class="col-md-6 col-sm-6">
                                
                                    <img src="/storage/img_name/{{$escortb->img2}}" style=" height:70px; width:100px">
                                    
                                </div>
                            @endif
                            </div>
                            <h3 class="text-center font-weight-bold">{{$escortb->uname}}</h3>
                            
                        </div>

                    <div class="col-md-6 col-sm-6">
                    
                        <p>{{$escortb->info}}</p>
                        
                        
                        <div class="btn-group">
                            
                            <button class="btn btn-outline-primary escTel" data-last="{{$escortb->tel}}">
                                    <span><a class="see">显示电话 </a></span>
                            </button>
                        
                        </div>
                            
                            
                            {{--@if (session()->has($baoyang->user_id))
                            
                                @if(session($baoyang->user_id)=='paid') 
                                    <div class="text-danger">
                                    你要查询的电话号码是:<b>{{$baoyang->tel}}</b> 
                                    </div>
                                @endif
                            @elseif(isset($_COOKIE[$baoyang->user_id])&&$_COOKIE[$baoyang->user_id]=='pending')
                            
                                    
                                    <p class="text-danger d-inline">你的付款正在处理中...</p>
                                    <button class="btn btn-primary " onClick="window.location.reload();">刷新查看</button>
                                
                                -->
                            @else
                                <a href="/customerPay/contract/{{$baoyang->user_id}}" class="btn btn-primary ">付款取得电话</a>
                            @endif
                            --}}
                        
                    </div>

                    <div class="col-md-3 col-sm-">
                        
                        <div>
                            <ul>
                                    
                                    <li>居住国家 :{{$escortb->ucountry}}</li>
                                @if($escortb->city)
                                    <li>现住城市 :{{$escortb->city}}</li>
                                @endif
                                    <li>性别 :
                                        {{$escortb->gender}}
                                        
                                    </li>
                                
                                @if($escortb->age)
                                    <li>年龄 :{{$escortb->age}}</li>
                                @endif
                                @if($escortb->national)
                                    <li>原国籍 :{{$escortb->national}}</li>
                                @endif
                                @if($escortb->look)
                                    <li>相貌 :{{$escortb->look}}</li>
                                @endif
                                @if($escortb->shape)
                                    <li>身材 :{{$escortb->shape}}</li>
                                @endif
                                @if($escortb->height)
                                    <li>身高 :{{$escortb->height}}</li>
                                @endif
                                @if($escortb->hobby)
                                    <li>爱好 :{{$escortb->hobby}}</li>
                                @endif
                                
                                @if($escortb->price)
                                    <li>价格 :{{$escortb->price}}</li>
                                @endif
                                
                                
                                
                            </ul>
                                
                            <small>&nbsp&nbsp刷新日期：{{$escortb->updated_at}}  </small>
                        </div>
                    </div>
                                
                    <div class="container">  
                        
                        @if(!Auth::guest())
                            @if(Auth::user()->id==$escortb->user_id)
                                <a href="/escortbs/{{$escortb->id}}/edit" class="btn btn-primary">修改</a>
                                {!!Form::open(['action' => ['EscortbsController@destroy', $escortb->id], 'method' => 'POST', 'class' => 'float-right'])!!}
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
                <p>对不起，没有商务陪伴的资料。</p>
            @endif
        @endforeach
    @else
        <p>对不起，没有商务陪伴的信息。</p>
    @endif
    </div> 

    <script>
        $('.escTel').click(function() {
            var tel = $(this).data('last');
            // var tel_on= $(this).data('tel_on');
            // if(tel_on){
                $(this).find('span').html( '<a href="tel:' + tel + '">' + tel + '</a>' );
            // }
        });
        </script> 
    
@endsection

