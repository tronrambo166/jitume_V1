@extends('layout')

@section('page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container" id="" style="background:white;">
        
        <h3 class="text-center font-weight-bold bg-light"><b class="h5 text-success" > {{ Session:: get('success') }}</b> </h3>
        <div class="row pt-4 m-auto" style="width:87%;">
           
           <div class="col-sm-12" >


               <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    @php $i=0; @endphp
                    @foreach($poster as $pos) 
                        @if($pos->s_id == $event->id) 
                        @php $i++; @endphp
                    <div class="rounded carousel-item @if($i==1) active @endif">
                      <img src="../images/services/{{$pos->img_name}}" class="rounded d-block w-100"  alt="First slide" height="350px">
                    </div>
                     @endif
                        @endforeach
                    
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>



           </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-8"> 
                        <h1 style="font-family: system-ui;font-weight: 700; font-size: 32px;color:black;" class="text-left how my-4 ">{{$event->s_name}}</h1>

                        <h1 style="font-family: system-ui;font-weight: 700; font-size: 25px;color:black;" class="text-left how mt-5 ">Service Name</h1>

                        <h5 style="font-family: system-ui;font-weight: 700; color:black;" class="text-left how my-4 ">{{$event->s_name}}</h5>

                        <h5 style="font-family: system-ui;font-weight: 700; font-size: 25px;color:black;" class=" my-4">Description </h5>

                        <p class="font-weight-bold h6">{{$event->s_details}}</p>
                        
                        <h5 style="font-family: system-ui;font-weight: 700; font-size: 25px;color:black;" class=" my-4">Our Location </h5>

                        <div class="bg-light  map_box" style="min-height:420px;"><h1 style="min-height:400px" class="my-5">Map Coming</h1>
                        
                        <div class="card bg-white py-3"> <h6 class="font-weight-bold">
                            <i class="mx-2 fa fa-map-marker"></i>
                            {{$event->s_loction}}</h6></div> 

                             </div>


                            <div class="row my-5">
                                <div class="col-sm-6">
                                     <h5 style="font-family: system-ui;font-weight: 700; font-size: 25px;color:black;" class=" ">Reviews </h5>

                                     <h6 class="font-weight-bold my-3">0 Reviews</h6>
                                </div>

                                <div class="col-sm-6 ">
                                    <button data-toggle="modal" data-target="#exampleModal"  class="float-right my-3 font-weight-bold btn px-3 text-light " style="background:#ee2f31 ;">Submit a review</button>
                                </div>
                            </div>
                  

                      
                    </div>

                        <div class="col-sm-4">
                        <div id="choose" class="card my-3 p-3">
                         <h5 class="my-2 bg-light py-2">Please select your billing preference</h5>

                        <a style="cursor:pointer;" onclick="bookForm('daily');" ><h6 class="text-dark font-weight-bold">I want to be billed daily</h6 ></a> 

                        <a href=""><h6 class="text-dark font-weight-bold">I want to be billed hourly</h6 ></a>
                         </div>

                         <div id="booking" class="collapse card my-4 p-3">
                         <h4 class="my-4 bg-light py-2 px-5">Booking</h4>

                        <p><h5 class="text-dark ml-2 font-weight-bold">${{$event->per_day}} / Perday</h5></p> 
                        <input type="hidden" id="per_day" value="{{$event->s_per_day}}">
                        <a href="" onclick="window.location.reload();"><h6 class="text-dark font-weight-bold">Choose preferences again</h6 ></a>

                        <form action="{{route('booking_request')}}" method="post">@csrf
                        <div class="dropdown show">
                            <a class="btn btn-light dropdown-toggle w-100" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select guests
                            </a>

                         <div class="px-3 dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <p class="font-weight-bold text-dark d-inline"> Adults: 
                        <input name="adults" value="0" class="w-75 d-inline dropdown-item" /> </p>

                        <p class="font-weight-bold text-dark d-inline"> Childs: 
                        <input name="childs" value="0" class="w-75 d-inline dropdown-item" /> </p>

                        <p class="font-weight-bold text-dark d-inline"> Infants: 
                        <input style="padding-left: 14px;" name="infants" value="0" class="w-75 d-inline dropdown-item" /> </p>

                          </div>
                        </div>

                       <p><input name="s_day" class="w-100 rounded mt-4 mb-2 py-2 pl-2 font-weight-bold border border-dark"  type="text" placeholder ="Start Date" id="datepicker" value=""></p>

                       <p><input name="e_day" class="w-100 rounded my-2 py-2 pl-2 font-weight-bold border border-dark"  type="text" placeholder ="End Date" id="datepicker2" value=""></p>


                       <div class="card p-2">
                     <div class="row"><p class="w-75 font-weight-bold">Length (days): </p> 
                      <p id="days" class="font-weight-bold w-25"></p></div>

                      <div class="row"><p class="w-75 font-weight-bold">Price: </p> 
                      <p id="price" class="font-weight-bold w-25"></p></div>

                      <div class="row"><p class="w-75 font-weight-bold">Service Fee: </p> 
                      <p id="s_fee" class="font-weight-bold w-25">$200</p></div>

                      <div  class="row"><p class="w-75 font-weight-bold">Total: </p> 
                      <p id="total_price" class="font-weight-bold w-25"></p></div>
                      <input id="t_price" type="hidden" name="total" value="">
                      

                      <div class="row"><p class="w-75 font-weight-bold">Due Now: </p> 
                      <p id="due" class="font-weight-bold w-25"></p></div>
                       </div>

                        <button type="submit" class="py-2 w-100 btn-success rounded text-center font-weight-bold">Send Request Booking</button>


                        </form>

                       </div>


                      
                         </div>

                         </div>
                    </div>



                              <div class="row my-5">
                                <div class="div">
                                <h5 style="font-family: system-ui;font-weight: 700; font-size: 25px;color:black;" class=" ">See what's nearby </h5>
     
                                </div>

                                @foreach($rel_events as $ev)
                <div class="col-sm-4 mb-2">
                   <a href="{{route('event',$ev->id)}}">
                    <div class="listing" style="min-height: 350px;">
                        @foreach($poster as $pos)
                        @if($pos->s_id == $ev->id)
                        <img class="rounded" src="../images/services/{{$pos->img_name}}" width="265px" height="170px">
                        @break @endif
                        @endforeach
                        <div class="titleDetails" style="min-height:70px">

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
                

            </div>


            <div class="clear"></div>
        </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit a review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        <h5 class="my-3 font-weight-bold">Service rating <span class="ml-4 ">* * * * *</span></h5>

        <h5 class="font-weight-bold">Leave a review</h5>
        <textarea name="reply" class="bg-light border border-none" cols="55" rows="3"></textarea>
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="font-weight-bold btn btn-danger w-50 m-auto">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>


  <script type="text/javascript">
  
    function bookForm(shift) {
      $('#choose').hide();
      $('#booking').show();
    }
  </script>

@endsection



