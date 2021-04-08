@extends('layouts.app')

@section('content')

<div class="container">
    <div class="jumbotron">
  
    <h5 class="text-center">包养修改表</h5>
        <h6>主要资料</h6>
        <label>国家:{{auth()->user()->ucountry}}</label>
        <label>  &nbsp&nbsp &nbsp 用户名:{{auth()->user()->username}}</label>
        {!!Form::open(['action' => ['BaoyangsController@update',$baoyang->id], 'method'=>'post','enctype'=>'multipart/form-data']) !!}
        
        <div class="form-group form-inline">
          {{Form::label('tel', '电话 :  ')}}
          {{Form::text('tel', $baoyang->tel, ['class' => 'form-control', 'placeholder' => '电话'])}}
        </div>
        
        <div class="form-group form-inline">
          {{Form::label('city', '城市 :  ')}}
          {{Form::text('city', $baoyang->city, ['class' => 'form-control', 'placeholder' => '城市'])}}
        </div>
        
        <div class="form-group ">
            {{Form::label('topic', '包养标题 :')}}
            {{Form::text('topic', $baoyang->topic, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '包养标题'])}}
        </div>
        <div class="form-group ">
          {{Form::label('info', '内容信息 :')}}
          {{Form::textarea('info', $baoyang->info, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '内容信息'])}}
        </div>
      
        <h5>个人详情</h5>
        <div class="form-group form-inline">
          {{Form::label('age', '年龄 :')}}
          {{Form::number('age', $baoyang->age, ['class' => 'form-control','min'=>'18', 'placeholder' => '年龄'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('national', '来自国家或地区 :')}}
          {{Form::text('national', $baoyang->national, ['class' => 'form-control', 'placeholder' => '来自国家'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('look', '相貌 :')}}
          {{Form::text('look', $baoyang->look, ['class' => 'form-control', 'placeholder' => '相貌'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('shape', '身材 :')}}
          {{Form::text('shape', $baoyang->shape, ['class' => 'form-control', 'placeholder' => '身材'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('height', '身高 :')}}
          {{Form::number('height', $baoyang->height, ['class' => 'form-control', 'min'=>'1','step'=>'0.05','placeholder' => '身高, m'])}}
        </div>
        <div class="form-group form-inline">
          {{Form::label('hobby', '喜好 :')}}
          {{Form::text('hobby', $baoyang->hobby, ['class' => 'form-control', 'placeholder' => '喜好'])}}
        </div>
        
        <div class="form-group form-inline">
          {{Form::label('price', '价格范围 ：')}}
          {{Form::text('price', $baoyang->price, ['class' => 'form-control', 'placeholder' => '价格范围'])}}
        </div>
        
        <div class="form-group form-inline">
          {{Form::label('period', '计划包养时间：')}}
          {{Form::text('period', $baoyang->period, ['class' => 'form-control', 'placeholder' => '计划包养时间'])}}
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

<script>
    $(document).ready(function(){
      $("#showBy").click(function(){
        $("#byForm").show();
        $("#estForm").hide();
        $("#estbForm").hide();
      });
      $("#showEst").click(function(){
        $("#byForm").hide();
        $("#estForm").show();
        $("#estbForm").hide();
      });
      $("#showEstb").click(function(){
        $("#byForm").hide();
        $("#estForm").hide();
        $("#estbForm").show();
      });
    });
</script>
@endsection
