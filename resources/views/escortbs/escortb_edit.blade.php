@extends('layouts.app')

@section('content')

<div class="container">
    <div class="jumbotron">
  
    <h5 class="text-center">商务陪伴修改表</h5>
        <h6>主要资料</h6>
        <label>国家:{{auth()->user()->ucountry}}</label>
        <label>  &nbsp&nbsp &nbsp 用户名:{{auth()->user()->username}}</label>
        {!!Form::open(['action' => ['EscortbsController@update',$escortb->id], 'method'=>'post','enctype'=>'multipart/form-data']) !!}
        
        <div class="form-group form-inline">
          {{Form::label('tel', '电话 :  ')}}
          {{Form::text('tel', $escortb->tel, ['class' => 'form-control', 'placeholder' => '电话'])}}
        </div>
        
        <div class="form-group form-inline">
          {{Form::label('city', '城市 :  ')}}
          {{Form::text('city', $escortb->city, ['class' => 'form-control', 'placeholder' => '城市'])}}
        </div>
                
        <div class="form-group ">
          {{Form::label('info', '内容信息 :')}}
          {{Form::textarea('info', $escortb->info, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '内容信息'])}}
        </div>
      
        <h5>个人详情</h5>
        <div class="form-group form-inline">
          {{Form::label('age', '年龄 :')}}
          {{Form::number('age', $escortb->age, ['class' => 'form-control','min'=>'18', 'placeholder' => '年龄'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('national', '来自国家或地区 :')}}
          {{Form::text('national', $escortb->national, ['class' => 'form-control', 'placeholder' => '来自国家'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('look', '相貌 :')}}
          {{Form::text('look', $escortb->look, ['class' => 'form-control', 'placeholder' => '相貌'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('lan', '语言 :')}}
          {{Form::text('lan', $escortb->lan, ['class' => 'form-control', 'placeholder' => '语言'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('shape', '身材 :')}}
          {{Form::text('shape', $escortb->shape, ['class' => 'form-control', 'placeholder' => '身材'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('height', '身高 :')}}
          {{Form::number('height', $escortb->height, ['class' => 'form-control', 'min'=>'1','step'=>'0.05','placeholder' => '身高, m'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('hobby', '喜好 :')}}
          {{Form::text('hobby', $escortb->hobby, ['class' => 'form-control', 'placeholder' => '喜好'])}}
        </div>
        
        <div class="form-group form-inline">
          {{Form::label('price', '价格 ：')}}
          {{Form::text('price', $escortb->price, ['class' => 'form-control', 'placeholder' => '价格范围'])}}
        </div>
        
        
        
        <h5>上传图片</h5>
            <div class="input-group control-group increment" >
              <input type="file" name="filename[]" class="form-control">
      
              <div class="input-group-btn">
                <button id="add_file" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>加载更多图片</button>
              </div>
      
            </div>
            <div class="clone hide">
              <div class="control-group input-group" style="margin-top:10px">
                <input type="file" name="filename[]" class="form-control" multiple>
                <div class="input-group-btn">
                  <button id="remove_file" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> 取消本图片</button>
                </div>
              </div>
            </div>
            {{Form::hidden('_method','PUT')}}
            <button type="submit" class="btn btn-primary" style="margin-top:10px">登记</button>
      
            {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript">

  $(document).ready(function() {

    $("#add_file").click(function(){
        var html = $(".clone").html();
        $(".increment").after(html);
    });

    $("body").on("click","#remove_file",function(){

        $(this).parents(".control-group").remove();
    });

  });

</script>

<!--

<link rel= "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
-->


@endsection
