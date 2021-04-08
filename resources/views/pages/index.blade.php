@extends('layouts.app')

@section('content')
<div class="container">
    
    <h4> {{$ip_country}}</h4>
    <hr>
    @if(count($city_num) > 0)
        @foreach($city_num as $city_name)
            <h5>{{$city_name->city}}</h5>
            
            @if(count($posts) > 0)
                
                    <div class="row">
                    @foreach($posts as $post)
                  
                        @if($post->city==$city_name->city)
                            @if(($post->status)=='free'|($post->status)=='paid')
                             
                                <div class="col-md-4 col-sm-3">
                                    @if($post->img0)
                                        <!-- first word in link misss must be controller's fore part--> 
                                        <a href="/misss/{{$post->id}}">
                                            <img src="/storage/img_name/{{$post->img0}}" style="height:130px; width:200px">
                                        </a>
                                    @else
                                        <a href="/posts/{{$post->id}}">
                                            <img src="/storage/img_name/no-user.jpg" style="height:130px; width:200px">
                                        </a>
                                    @endif
                                        <h6>{{$post->uname}}</h6>
                                        
                                        <small> {{$post->addr1}} </small>
                                        
                                </div>
                            @endif
                        @endif        
                    @endforeach
                    </div>
                @else
                <p>无内容</p>

            @endif

        @endforeach
    @else
            <p>无内容</p>
    @endif
</div>

   
    <div id="map" class="invisible"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY&callback=initMap"
    async defer></script>     
@endsection



