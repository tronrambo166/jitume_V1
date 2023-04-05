@extends('layout')

@section('page')
    <div class="container mx-auto" id="" style="width:95%;background:white;">
        
        <h3 class="text-center font-weight-bold bg-light"><b class="h5 text-success" > {{ Session:: get('success') }}</b> </h3>
        <div class="row pt-4 m-auto">
           
           <div class="col-sm-12"> 
            <div class="row mb-4">
                <div class="col-sm-4"> <h3 class="text-left  title font-weight-bold ml-3">New Events This Week</h3> </div>

                 <div class="col-sm-8"> 
                            <form action="search" method="get" class=" w-100">
                            <div class="shadow row py-0 px-0 text-center"
                            style="border-radius: 30px 30px 30px 30px;">

                            <div style="border-radius: 30px 0 0 30px;" class="py-2 col-sm-3 bg-white">
                              <input id="searchbox" required="" onkeyup="suggest(this.value);" style="border: none;height: 42px;" class=" form-control d-inline bg-white" type="text" name="search" value="" placeholder="Enter a location..."></div>

                            <div class="py-2 col-sm-3 bg-white"><div class="dropdown">
                          <button class="w-100 py-2 btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Add a service
                          </button>

                          
                        </div></div>


                         <div class="py-2 col-sm-3 bg-white">
                           <div class="">
                          <a class="w-100 py-2 pr-1 btn"  onclick="date_div();" >
                           Add Dates  <i class="float-right mt-1 fa fa-angle-down"> </i>
                          </a>


                        </div>

                        <div style="width:250px; position: absolute;" class="px-3 collapse bg-white"
                        id="date_div">
                        <p>
                          <input name="s_day" class="w-100 rounded mt-4 mb-2 py-2 pl-2 font-weight-bold border border-dark"  type="text" placeholder ="Start Date" id="datepickerHome1" value=""></p>

                           <input name="s_day" class="w-100 rounded mt-2 mb-2 py-2 pl-2 font-weight-bold border border-dark"  type="text" placeholder ="End Date" id="datepickerHome2" value="">

                        <hr>

                        <a onclick="close_date();" class="float-right my-2 small btn btn-danger text-light font-weight-bold">Close</a>
                        </div>

                        </div>

                         <div class="py-2 col-sm-2 bg-white">
                          <div class="">
                          <a class="w-100 py-2 pr-1 btn" type="button" id="" onclick="guest_div();"  aria-haspopup="true" aria-expanded="false">
                           Select  <i class="float-right mt-1 fa fa-angle-down"> </i>
                          </a>


                        </div>

                        <div  style="width:250px; position: absolute;" class="px-3 collapse bg-white" id="guest_div">
                        <p class="my-2 font-weight-bold text-dark d-inline"> Adults: 
                        <input type="number" name="adults" value="0" class="my-2 bg-light py-1 pl-1 w-75 d-inline dropdown-item" /> </p>

                        <p class=" font-weight-bold text-dark d-inline"> Childs: 
                        <input type="number" name="childs" value="0" class="my-2 bg-light py-1  pl-1 w-75 d-inline dropdown-item" /> </p>

                        <div class="my-2 row">
                          <div class="col-sm-3 text-left font-weight-bold"> Infants:</div>
                          <div class="col-sm-9" style="padding-left: 9px;"> <p class="font-weight-bold text-dark"> 
                        <input style="margin-top: -3px;" name="infants" value="0" class="bg-light py-1 w-100  dropdown-item" /> </p></div>
                        </div>
                        <hr>
                        <p class="px-3 text-secondary">Select the number of guests, infants don’t count toward the number of guests.</p>

                        <a onclick="close_guest();" class="text-light float-right my-2 small btn btn-danger font-weight-bold">Close</a>
                        

                          </div>

                        </div>

                            <div style="border-radius: 0 30px 30px 0;" class="col-sm-1 bg-white py-2 ">
                                <button style="width: 40px;height: 40px;" class="bg-danger rounded-circle float-right" type="submit"><i class="fas text-light fa-search"></i></button>
                            </div>


                            


                            <div class="row" style="">
                                <div id="result_list" class="text-left" style="display: none;width:41%; z-index: 1000;height: 600px;position: absolute; margin-left: -7px;">
                                    
                                </div>
                            </div>
  
                        </form>

                  </div>
            </div>
        </div>
         </div>

<!-- EVENTS --> 
    <div class="row m-auto">
            @foreach($events as $ev) 

                <div class="col-sm-3 mb-3">
                   <a href="{{route('event',$ev->id)}}">
                    <div class="listing" style="min-height: 334px;">

                        <div class="test" style="min-height: 221px;">
                        @foreach($poster as $pos)
                        @if($pos->ev_id == $ev->id)
                        <img class="rounded" src="images/events/{{$pos->img_name}}" width="260px" height="170px">
                        @break @endif
                        @endforeach
                        <h6 style="font-weight: 800; color:black;" class=" mt-3 ">{{$ev->name}}</h6>
                        <!--<p style="height: 42px;" class="text-secondary">
                            {{substr($ev->details,0,40)}}...</p> -->
                        </div>

                        <hr>
                        <div class="test" style="min-height: 83px;">
                        <p  style="width:260px;">
                            <span style="color: #ababab;font-size:12px;width:10%;" class="p-0 mr-2 d-inline-block small font-weight-bold">
                                @if($ev->isFree == 'yes')
                               Free @else Paid @endif</span> <i class="fa fa-calendar text-secondary"></i>

                            <span style="color: #ababab;font-size:12px;width:90%;"class="p-0 small d-inline">From {{$ev->ev_start}} To {{$ev->ev_end}}</span>
                        </p>

                        <h6 style="font-size: 16px;font-weight: 600; color:#ee2f31;" class="w-100 d-block mt-3 ">{{$ev->address}}</h6>
                    </div>

                    </div> </a>
                    
                </div>
                @endforeach

            </div>


            <div class="clear"></div>
        </div>


@endsection



