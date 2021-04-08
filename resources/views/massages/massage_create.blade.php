@extends('layouts.app')

@section('content')

<div class="container">
  <h4 class="text-center" >按摩登记表</h4>
  
  <h5>主要资料</h5>
  <label>国家:{{$ucountry}}</label>
  
  {!!Form::open(['action' => 'MassagesController@store', 'method'=>'post','enctype'=>'multipart/form-data']) !!}
    <div class="form-group form-inline {{ $errors->has('city') ? 'has-error' : ''}}">
      {{Form::label('uname', '用户名 :  ')}}
      {{Form::text('uname', $uname, ['class' => 'form-control', 'placeholder' => '用户名'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('city') ? 'has-error' : ''}}">
      {{Form::label('city', '城市 :  ')}}
      {{Form::text('city', '', ['class' => 'form-control', 'placeholder' => '城市'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('tel') ? 'has-error' : ''}}">
        {{Form::label('tel', '电话 :  ')}}
        {{Form::text('tel', '', ['class' => 'form-control ', 'placeholder' => '电话'])}}
        {!! $errors->first('tel', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group form-inline {{ $errors->has('addr1') ? 'has-error' : ''}}">
      {{Form::label('addr1', '大慨位置 :  ')}}
      {{Form::text('addr1', '', ['class' => 'form-control', 'placeholder' => '如：七区，Smithfield。'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('addr2') ? 'has-error' : ''}} ">
      {{Form::label('addr2', '详细地址 :  ')}}
      {{Form::text('addr2', '', ['class' => 'form-control',  'placeholder' => '地址'])}}

      <input id="show_marker" type="button" class="btn btn-primary" value="在地图中查看位置是否正确">
      <label class="label-note">注：本栏需要实际存在地址,可在地图上用图标标出，以方便顾客查找。地址文字不在网页上显示,与你的工作场所可以有误差。</label>
    </div>

    <div id="map" style="height:310px;width:500px;overflow: visible;"></div>

    <div class="form-group {{ $errors->has('intro') ? 'has-error' : ''}}">
        {{Form::label('intro', '自我介绍 :')}}
        {{Form::textarea('intro', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '文字自述'])}}
    </div>

    <h5>个人详情</h5>
    <div class="form-group form-inline {{ $errors->has('age') ? 'has-error' : ''}}">
      {{Form::label('age', '年龄 :')}}
      {{Form::number('age', '', ['class' => 'form-control', 'min' => '18','placeholder' => '年龄'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('national') ? 'has-error' : ''}}">
      {{Form::label('national', '来自国家或地区 :')}}
      {{Form::text('national', '', ['class' => 'form-control', 'placeholder' => '来自国家'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('shape') ? 'has-error' : ''}}">
      {{Form::label('shape', '身材 :')}}
      {{Form::text('shape', '', ['class' => 'form-control', 'placeholder' => '如：苗条，丰满，匀称'])}}
    </div>

    <div class="form-group form-inline {{ $errors->has('skin') ? 'has-error' : ''}}">
      {{Form::label('skin', '皮肤 :')}}
      {{Form::text('skin', '', ['class' => 'form-control', 'placeholder' => '皮肤'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('height') ? 'has-error' : ''}}">
      {{Form::label('height', '身高 :  ')}}
      {{Form::number('height', '', ['class' => 'form-control','min' => '0.01','step' => '0.01', 'placeholder' => '身高,米'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('chest') ? 'has-error' : ''}}">
      {{Form::label('chest', '胸围 :')}}
      {{Form::number('chest', '', ['class' => 'form-control','min' => '1', 'placeholder' => '胸围,cm'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('waist') ? 'has-error' : ''}}">
      {{Form::label('waist', '腰围 :')}}
      {{Form::number('waist', '', ['class' => 'form-control', 'min' => '1','placeholder' => '腰围,cm'])}}
    </div>

    <div class="form-group form-inline {{ $errors->has('weight') ? 'has-error' : ''}}">
      {{Form::label('weight', '体重 :')}}
      {{Form::number('weight', '', ['class' => 'form-control', 'min' => '1','placeholder' => '体重,kg'])}}
    </div>
    <h5>语言沟通</h5>
    <div class="form-group form-inline {{ $errors->has('lan1') ? 'has-error' : ''}}">
      {{Form::label('lan1', '第一语言 :')}}
      {{Form::text('lan1', '', ['class' => 'form-control', 'placeholder' => '第一语言'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('lan2') ? 'has-error' : ''}}">
      {{Form::label('lan2', '其它语言或方言 :')}}
      {{Form::text('lan2', '', ['class' => 'form-control', 'placeholder' => '其它语言'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('lan_des') ? 'has-error' : ''}}">
      {{Form::label('lan_des', '语言说明 :')}}
      {{Form::text('lan_des', '', ['class' => 'form-control', 'placeholder' => '语言说明'])}}
    </div>
    <h5>价格</h5>
    <div class="form-group form-inline {{ $errors->has('price30') ? 'has-error' : ''}}">
      {{Form::label('price30', '30分钟价格 ：')}}
      {{Form::number('price30', '', ['class' => 'form-control', 'min' => '1','placeholder' => '30分钟价格,€'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('price1h') ? 'has-error' : ''}}">
      {{Form::label('price1h', '1小时价格 ：')}}
      {{Form::number('price1h', '', ['class' => 'form-control','min' => '1', 'placeholder' => '1小时价格,€'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('price_out') ? 'has-error' : ''}}">
      {{Form::label('price_out', '上门服务价格 ：')}}
      {{Form::number('price_out', '', ['class' => 'form-control', 'min' => '1','placeholder' => '上门服务价格,€'])}}
    </div>

    <div class="form-group form-inline {{ $errors->has('price_note') ? 'has-error' : ''}}">
      {{Form::label('price_note', '价格说明：')}}
      {{Form::text('price_note', '', ['class' => 'form-control', 'placeholder' => '价格说明'])}}
    </div>
    <h5>服务内容</h5>
    <div class="form-group form-inline {{ $errors->has('service_des') ? 'has-error' : ''}}">
      {{Form::label('service_des', '主要服务：')}}
      {{Form::text('service_des', '', ['class' => 'form-control', 'placeholder' => '主要服务'])}}
    </div>
    <div class="form-group form-inline {{ $errors->has('special_serv') ? 'has-error' : ''}}">
      {{Form::label('special_serv', '特色服务：')}}
      {{Form::text('special_serv', '', ['class' => 'form-control', 'placeholder' => '特色服务'])}}
    </div>

    <div class="form-group form-inline ">
      {{Form::label('western_serv', '是否接待西方人：')}}
      {{Form::checkbox('western_serv', '',null, ['class' => 'form-control,checkbox'])}}
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

        <button type="submit" class="btn btn-primary" style="margin-top:10px">登记</button>

      {!! Form::close() !!}
  

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





<script>
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: {lat: -6, lng: 33}
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('show_marker').addEventListener('click', function() {
      geocodeAddress(geocoder, map);
    });
  }

  function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('addr2').value;
    geocoder.geocode({'address': address}, function(results, status) {
      if (status === 'OK') {
        resultsMap.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: resultsMap,
          position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY&callback=initMap">
</script>

<link rel= "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

@endsection



    <? php
    /*
    $tags = get_meta_tags('http://www.geobytes.com/IpLocator.htm?GetLocation&template=php3.txt&IpAddress=' . $_SERVER['REMOTE_ADDR']);
    echo $tags['country'];
    echo $tags['city'];
    **/
    ?>
