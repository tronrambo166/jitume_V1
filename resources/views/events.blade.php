@extends('layout')

@section('page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container" id="" style="background:white;">
        
         
        <div class="heading">
                   
                </div>
                <h3 class="text-center font-weight-bold bg-light"><b class="h5 text-success" > {{ Session:: get('success') }}</b> </h3>
        <div class="row pt-4  m-auto">
            <div class="col-sm-7">
                <div class="row">
                <h1 style="font-family: system-ui;font-weight: 800; font-size: 40px;color:black;" class="mb-4 text-left font-weight-bold">{{ucfirst($service)}}...</h1>

               <div class="mb-2">  <hr class="my-1"> <a href="" class="font-weight-bold btn px-3 text-light " style="background:#ee2f31 ;"><i class="fa fa-arrow-left mr-2 "></i>Back</a> <hr></div> 

               <div><p class="text-secondary font-weight-bold ml-2">
               @if(count($events) == 0) No results found!
               @else Found {{count($events)}} results... @endif</p></div>

            @foreach($events as $ev)
                <div class="col-sm-4 mb-2">
                   <a href="{{route('event',$ev->id)}}">
                    <div class="listing" style="min-height: 350px;">
                        @foreach($poster as $pos)
                        @if($pos->s_id == $ev->id)
                        <img class="rounded" src="images/services/{{$pos->img_name}}" width="180px" height="115px">
                        @break @endif
                        @endforeach
                        <div class="titleDetails" style="min-height:102px">

                        <h5 class="title my-3 font-weight-bold">{{$ev->s_name}}</h5>
                        <p style="height: 42px;" class="h6 font-weight-bold text-secondary text-left"> {{substr($ev->s_details,0,40)}}...</p>

                        </div>

                        <hr>
                        <p class="text-left small text-secondary font-weight-bold">
                            <i class="fa fa-cutlery text-mute m1-2 mb-1" style="margin-right: 4px;color: #d5cccc;font-size:12px"></i></i> 
                            <span class="mt-1">{{$ev->service_cats}}</span></p>
                        

                        <h5 style="font-family: system-ui;font-size: 16px;font-weight: 800;color: #ee2f31;" class="">${{$ev->s_per_hour}}/per hr</h5 >
                        <h5 style="font-family: system-ui;font-size: 16px;font-weight: 800;color: #ee2f31;" class="">${{$ev->s_per_day}}/per day</h5>
                    </div>
                     </a>
                    
                </div>
                @endforeach

                </div>

                </div>

                <div style="background:aliceblue;" class="col-sm-5"><p class="mx-auto my-5 py-5 font-weight-bold text-center">MAP Loading...</p></div>

            </div>


            <div class="clear"></div>
            <div class="clearfix py-5"></div>

        </div>


@endsection



