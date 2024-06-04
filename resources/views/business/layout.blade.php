@php
use App\Models\User;

if(Auth::check()) $user_id = Auth::id();
else {
        $e_mail = Session::get('investor_email');
        $u = User::where('email', $e_mail)->first();
        $user_id = $u->id;
     }

use App\Models\Listing;
use App\Models\Services;
use App\Models\serviceBook;
use App\Models\ServiceMessages;
use App\Models\BusinessBids;
use App\Models\BusinessSubscriptions;


$business = Listing::where('user_id',$user_id)->get();
$service = Services::where('shop_id',$user_id)->get();
$booking = serviceBook::where('booker_id',$user_id)->get();
$subscribed = BusinessSubscriptions::where('investor_id',$user_id)
    ->where('active',1)->orderBy('id','DESC')->first();

$messages = ServiceMessages::where('to_id', $user_id)
->where('new',1)->latest()->get();

$new_bids = BusinessBids::where('owner_id', $user_id)
->where('new',1)->latest()->get();

$new_books = serviceBook::where('service_owner_id', $user_id)
->where('new',1)->latest()->get();
@endphp

<!DOCTYPE HTML>
<head>
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
    <title>JITUME - Business</title>
    <script type="module" src="../places.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnKB7p3g8iG6IGE9nXX4PqlZ6EPHNUo3w&callback=initAutocomplete&libraries=places&v=weekly" defer ></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
   <style type="text/css"> 
   .btn-success{background:#72c537;color:white;}
   .bg-light{background:grey;}
   </style>
    
    
    
    
    <!-- <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'> -->

   <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('/css/style.css') }}" rel="stylesheet"/>

     <link href="{{ asset('/css/datatables.min.css') }}" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
       <!--  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" /> -->

<!-- {{-- Vue component files --}} -->
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/http-vue-loader"></script>
  {{-- Vue component files --}}
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  
</head>

<body style="overflow-x: hidden;">

    @if(Session::has('loginFailed'))
        <p class="text-danger font-weight-bold float-right">{{Session::get('loginFailed')}} @php Session::forget('loginFailed'); @endphp</p>@endif


<div class="container-fluid">
   

 <div  class="row px-0 shadow primary_bg" style="min-height: 91.98px;">

    <div class="col-sm-3">
        <ul class="navbar-nav ">
        <li class="nav-item  px-3">
            <a href="{{route('business')}}"><img class="img-fluid py-1" width="170px" height="45px" src="../images/logo.png" style="margin-left: 17px;"></a>
        </li> 
         
      </ul> 

    </div>

     <div class="col-sm-9 px-0">
        <nav class="navbar navbar-expand-lg primary_bg pt-4">
            <div class="navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto text-white">
                    <li class="nav-item py-1 active ">
                        <a href="{{route('/')}}" class=" py-1"> 
                          <div class=" rounded-circle px-2 pb-2 pt-1 mr-1" style="background: #6d8b8291;">
                               <img width="14px" class="" src="../images/home-Icon.png" />

                            </div>
                        </a>
                    </li>

                   
                </ul>

                <div class="my-2 my-lg-0">
                    <div class="pb-2 px-md-3" style="padding-top: 2px;">
                        <div class="ml-3 ml-md-0 dash_menu">
                            <div class="nav-item ">
                                <a href="{{route('account')}}" class="header_buttons px-sm-3 my-1 mr-2 px-1 py-1"><i class="fa fa-dollar-sign"></i></a>
                            </div>
                            <div class="nav-item bg">

                                <a href="{{route('service-messages')}}" class="header_buttons px-sm-3 my-1 mr-2 px-1 py-1"><i class="fa fa-envelope"></i>
                                    @if(count($messages) != 0)
                                    <span class="new_msg font-weight-bold px-1">{{count($messages)}}</span>
                                    @endif
                                </a>
                            </div>

                            <div class="nav-item mr-4">
                                <a href="{{route('business', ['url'=>'url'])}}" class="header_buttons px-sm-3 my-1 mr-2 px-1 py-1 "><b>Dashboard</b></a>
                            </div>

                            <div class="nav-item">
                                <a v-if="" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();" class=" sign_in_btn  px-sm-3 header_buttons my-1 mr-2 px-1 py-1 "><b>Sign Out</b></a>
                            </div>

                        </div>
                         </div>
                          </div>
                           </div>
                       </nav>
     </div>

    
    
    <!-- <div class="col-sm-4" style="background: white;">
              <ul class="myaccount">
                <div class="dropdown show d-block ml-5 mt-3">
                  <a class="btn btn-light dropdown-toggle float-right" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Options
                  </a>
                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li style="list-style-type: none;" class="float-right mt-3 nav-item py-1 px-3 text-secondary">
                         <a class="font-weight-bold dropdown-item text-secondary" href="{{route('home')}}">Back to Main</a>
                        <a class="font-weight-bold dropdown-item text-secondary" href="">My Account</a>                       
                        <a v-if="" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" class=" dropdown-item text-secondary" ><b>Logout</b></a>

                                <form id="logout-form " style="cursor: pointer;" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>
                            </li>                    
                          </div>
                        </div> 
                 </ul>     
    </div>  -->
       

    </div>

    <!-- Layout -->



    <div class="row">
              <div class="py-4 bid_header col-md-3 sidebar-inner slimscroll" style="">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul class="sidebar text-light px-2" style="color:white;">
                           

                            <li class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf1E_') || Request::is('business/')? 'active' : '' }}"> 
                                
                                <a class="navLink" href="{{route('business')}}"><i class="fe fe-home"></i> <span>Dashboard</span></a> 
                            </li>

                        @if(!$business->count() && !$service->count())
                        <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf5E_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('my_bids')}}"><i class="fe fe-layout"></i> <span>My Bids</span></a>
                            </li>
                        @endif

                        @if($business->count())
                            <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf2E_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('add-listing')}}"><i class=" fe fe-layout"></i> <span>Add Business</span></a>
                            </li>

                             <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf3E_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('listings')}}"><i class=" fe fe-layout"></i> <span>My Businesses</span></a>           

                            </li>


                            <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf6E_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('add_milestones')}}"><i class=" fe fe-layout"></i> <span>Add Business Milestone</span></a>
       
                            </li>

                            <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf7E_-*') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('milestones','all')}}"><i class=" fe fe-layout"></i> <span>Milestones</span></a>
                            </li>

                            <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf4E_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('business_bids')}}"><i class=" fe fe-layout"></i> <span>Business Bids</span>
                                    @if(count($new_bids) != 0)
                                    <span class="new_msg2 small rounded px-1">New {{count($new_bids)}}</span>
                                    @endif
                            </a>
                            </li>
                          </ul>

                        @endif  


                        
                        @if($service->count())
                         <hr class=""> 

                         <ul class="sidebar text-light px-2" style="color:white;">
                            <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf2F_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('add-services')}}"><i class=" fe fe-layout"></i> <span>Add Service</span></a>
                            </li>


                             <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf8F_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('services')}}"><i class=" fe fe-layout"></i> <span>My Services</span></a>
                            </li>



                            <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf3F_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('add_s_milestones')}}"><i class=" fe fe-layout"></i> <span>Add Service Milestone</span></a>
                            </li>

                               <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf4F_-*') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('s_milestones','all')}}"><i class=" fe fe-layout"></i> <span>Milestones</span></a>
                            </li>

                             <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf5F_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('service_booking')}}"><i class=" fe fe-layout"></i> <span>Service Booking</span>

                                @if(count($new_books) != 0)
                                    <span class="new_msg2 small rounded px-1">New {{count($new_books)}}</span>
                                    @endif
                                </a>
                            </li>
                          </ul>

                            @endif

                            @if($booking->count())
                            <ul class="sidebar text-light px-2" style="color:white;">
                            <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf6F_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('my_booking')}}"><i class=" fe fe-layout"></i> <span>My Booking</span></a>
                            </li>

                            <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf6F__') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('booker-milestones')}}"><i class=" fe fe-layout"></i> <span>Milestones</span></a>
                            </li>
                            </ul>
                            @endif

                        <!-- <ul class="sidebar text-light px-0" style="color:white;">
                            <li  class="{{ Request::is('business/bBQhdsfE_WWe4Q-_f7ieh7Hdhf_E_') ? 'active' : '' }}"> 
                                <a class="navLink" href="{{route('applyForShow')}}"><i class=" fe fe-layout"></i> <span>Apply For Show</span></a>
                            </li>
                            
                        </ul> -->
                    </div>

                    @if($subscribed)
                    <div class=" mx-auto mt-5" style="width:95%;">
                        <a onclick="return confirm('Are you sure?');" style="background: azure;" class="header_buttons seacrhListing px-5 sign_in_btn text-center" href="{{route('cancelSubscription', $subscribed->id)}}"><i class=" fe fe-layout"></i> <span>Cancel Subscription</span></a>
                    </div>
                    @endif
                </div>

       
   <div class="col-md-9 bg-white px-0 pt-3">
    <!-- Session -->
    @if(Session::has('success'))
        <p class="success_session text-center mb-2 w-100 shadow font-weight-bold float-right">{{Session::get('success')}} @php Session::forget('success'); @endphp </p>@endif

        @if(Session::has('failed'))
        <p class="failed_session text-center mb-2 w-100 shadow font-weight-bold float-right">{{Session::get('failed')}} @php Session::forget('failed'); @endphp </p>@endif
    <!-- Session -->

         @yield('page') </div>  

     </div>


        <div class="clearfix bg-white py-5"></div>
         <div class="clearfix bg-white py-5"></div>
          <div class="clearfix bg-white py-5"></div>
           <div class="clearfix bg-white py-1"></div>

        <div class="bg-white h-50 w-100">
        <footer class="border border-top-dark bg-light w-100 fixed-bottom">
            <div class="row py-2">

                 <div class="col-sm-6 m-auto text-center">
                    
                    <p class="text-center text-secondary py-2">© JITUME PROJECT. All Rights Reserved.
                    </p>
                </div>

           

                
            </div>
        </footer>
       
        </div>
        
        
    </div>
    
    
    



<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> 
 <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
       

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
<!-- <script type="text/javascript" src="../js/app.js"></script> -->

 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
<!-- DATEPICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <!-- DATEPICKER -->
  
 <script type="text/javascript">
        function suggest(search) {
            $("#result_list").html('');
            var searchText = search;

            $.ajax({
                url: 'https://photon.komoot.io/api/?q=' + encodeURIComponent(searchText),
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    //console.log(response.features);
                
                    for (i = 0; i < 10; i++) { //console.log(response.features[i].name);
                        var name = response.features[i].properties.name;
                        var city = response.features[i].properties.city;
                        if(city == null || city == 'undefined')
                        city = '';
                        var country = response.features[i].properties.country;
                        var lng = response.features[i].geometry.coordinates[0];
                        var lat = response.features[i].geometry.coordinates[1];

                        $("#result_list").show();
                            if(i<10)

                            if(city == '')
                            $("#result_list").append(' <div onclick="address(\'' + name + ','  + country + '\', \'' + lat + '\', \'' + lng + '\');" style="" data-id="' + name + '" class="address  py-1 px-1 my-0 border-top bg-white single_comms">  <p class="h6 text-dark d-inline" ><i class="fa fa-map-marker mr-1 text-dark" aria-hidden="true"></i> ' + name + '</p> <p  class="d-inline text-dark"><small>, ' + country + '</small> </p> </div>');
                            else
                            $("#result_list").append(' <div onclick="address(\'' + name + ','+ city + ','  + country + '\', \'' + lat + '\', \'' + lng + '\');" style="" data-id="' + name + '" class="address  py-1 px-1 my-0 border-top bg-white single_comms">  <p class="h6 text-dark d-inline" ><i class="fa fa-map-marker mr-1 text-dark" aria-hidden="true"></i> ' + name + '</p> <p  class="d-inline text-dark"><small>, ' + city + ',' + country + '</small> </p> </div>');


                        }
                        //document.getElementById('result_list').style.overflowY="scroll";                      
                },
                error: function(error) {
                    console.log(error);
                }

            });

        }

  
</script>


    
<!-- <script type="text/javascript" src="js/app.js"></script> -->

 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

       
        <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script> -->
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
 


<script type="text/javascript">
    function address(place,lat2,lng2) {
            document.getElementById('searchbox').value = place;
            //$("#result_list").html('');
            document.getElementById("result_list").style.display = 'none';

              const lat = document.getElementById('lat');
              const lng = document.getElementById('lng');

              lat.value = lat2;
              lng.value = lng2;

        }

</script>
 
 <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>



<!-- LOGIN MODAL -->
  <div  class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

         <div class="card-header w-100">
            <button id="login" onclick="login()" class="w-25 btn   px-4 mr-2">{{ __('Log In') }}</button>
            <button  id="register" onclick="register()" class="w-25 btn  px-4">{{ __('Register') }}</button>

             @if(Session::has('email')) <p class="text-danger ml-5">{{Session::get('email')}} @php Session::forget('email'); @endphp </p> @endif
        </div>

              

        <button type="button" class="m-0 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
    
      <div class="modal-body">

         

        
      <div class="hidden_currency ">

    <div class="row justify-content-center py-3 mb-5">
        <div class="px-0 w-100 py-2">
            <div class="card collapse" id="all_registers">

            <div class=" mt-2 text-center User-Artist-Select">
            <div class="col-md-5"></div>                
            
             <div class="card-header w-100">
            <button  id="user"onclick="user()" class="w-25 btn  font-weight-bold px-3 mr-2">{{ __('User') }}</button>
            <button  id="business" onclick="business()" class="font-weight-bold w-25 btn px-3 mr-2">{{ __("Business") }}</button>
            </div>

                                          </div>

                <!-- HIDDEN USER REG -->

                    <div id="user_reg" class=" collapse card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __( 'Name') }} <span  class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

           


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                         <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password') }}<span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12 ">
                                <button type="submit" class="w-25 d-block mx-auto btn btn-outline-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            </div> <hr>

                              <div class="row mb-0">
                            <div class="col-md-12">
                                <a href="{{route('login')}}" class=" w-25 d-block mx-auto btn btn-outline-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                            
                        </div>
                    </form>

                </div>

                <!-- HIDDEN USER REG -->


                <!-- HIDDEN Business REG -->

                <div id="business_reg" class=" collapse card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf    
                         

                         <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Business Name') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="stage_name" value="{{ old('fname') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Password') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-left">{{ __('Telephone') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control @error('email') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-left">{{ __('Image') }} <span title="Required" class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control @error('email') is-invalid @enderror" name="image" autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="row mb-4">
                            <div class="col-md-12 ">
                                <button type="submit" class="mt-3 w-25 d-block mx-auto btn btn-outline-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            </div> <hr>

                              <div class="row mb-0">
                            <div class="col-md-12">
                                <a href="{{route('login')}}" class=" w-25 d-block mx-auto btn btn-outline-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                            
                        </div>
                    </form>

                </div>
                <!-- HIDDEN Business REG -->


                </div>
                 <!-- Logout-->


<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>



                <!-- HIDDEN login-->
                <!-- HIDDEN login-->
                <!-- HIDDEN login-->

  <div class="card" id="all_logins">
    <div class="card-header w-100">
            <button  id="usr_log"onclick="user_log()" class="w-25 btn  font-weight-bold px-3 mr-2">{{ __('User') }}</button>
            <button  id="art_log" onclick="business_log()" class="font-weight-bold w-25 btn px-3 mr-2">{{ __("Business") }}</button>
            </div>

 <div id="user_log" class="card-body text-center py-0">

                          <form method="POST" class="" action="{{route('login')}}">
                           @csrf

                                            <input class=" w-75 d-inline my-2 form-control my-1 px-2 py-1 mr-1" type="email" name="email" placeholder="Enter email" id="inputEmailAddress" 
                                            value=""    />
                                                                       
                                          
                                            <input class=" w-75 d-inline my-2 form-control my-1 px-2 py-1 mr-1" name="password" id="inputPassword" type="password" placeholder="Enter password"
                                            value=""  />
                                            

                                          

                                          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                           @enderror

                                       
                                           
                                            @if (Route::has('forgetPass')) 
                                            <a href="{{ route('password.request') }}" class="small text">Forgot password ?</a> @endif
                                            
                                            <input  type="submit"class=" d-block w-25 mx-auto my-2 btn btn-outline-success  font-weight-bold " href="" name="Log In" value="Login" />
                    </form>

                    
                    @if(Session::has('reset'))<p class="text-light font-weight-bold">{{Session::get('reset')}}   @php Session::forget('reset'); @endphp </p>@endif
                    

                   @if(Session::has('login_err'))
                   <div class="alert alert-danger" role="alert">
                                  <p class="">{{Session::get('login_err')}}   @php Session::forget('login_err'); @endphp </p> 

                                 </div>  @endif
                   
                        
                       <hr>  <div class="row">
                              <div class="col-sm-12 pr-1">
                    <a href="{{ route('forgot','email') }}" class=" text-responsive font-weight-bold text-info mx-auto my-2 d-inline-block py-0 small">Forgot Password?</a>
                    </div>
                  
                    
                    </div>
                    

                </div>




  <!-- HIDDEN USER LOG -->
  <div id="artist_log" class="collapse card-body text-center py-0">

                    <form action="{{route('loginB')}}" method="POST" class="d-inline form-inline" >
                        @csrf
                                  
                                            <input class=" w-75 d-inline my-2 form-control my-1 px-2 py-1 mr-1" type="email" name="email" placeholder="Enter email" id="inputEmailAddress" 
                                            value=""    />
                                                                       
                                          
                                            <input class=" w-75 d-inline my-2 form-control my-1 px-2 py-1 mr-1" name="password" id="inputPassword" type="password" placeholder="Enter password"
                                            value=""  />
                                            

                                          

                                          @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                           @enderror

                                       
                                           
                                            @if (Route::has('forgetPass')) 
                                            <a href="{{ route('password.request') }}" class="small text">Forgot password ?</a> @endif
                                            
                                            <input  type="submit"class=" d-block w-25 mx-auto my-2 btn btn-outline-success  font-weight-bold " href="" name="Log In" value="Login" />
                    </form>
                    
                    @if(Session::has('reset'))<p class="text-light font-weight-bold">{{Session::get('reset')}}  </p>
                      @php Session::forget('reset'); @endphp @endif
                    

                   @if(Session::has('login_err'))
                    <p class="text-danger ">{{Session::get('login_err')}}</p>@php Session::forget('login_err'); 
                    @endphp @endif
                        
                     <hr>   <div class="row">
                              <div class="col-sm-12 pr-1">
                    <a href="{{ route('forgot','email') }}" class=" text-responsive font-weight-bold text-info mx-auto my-2 d-inline-block py-0 small">Forgot Password?</a>
                    </div>
                  
                    
                    </div>

                </div>

            </div>
        </div>
    </div>
  
  </div>
    
    
      </div>
    
    
     
    </div>
  </div>
</div>



<input type="number" hidden id="temp_id" name="temp_id" value="">
<script type="text/javascript">
function bg_change(id) {
        var temp_id = $('#'+temp_id).val();
        document.getElementById('temp_id').value = id;
        $('#'+id).addClass('bg_light');
        $('#'+temp_id).removeClass('bg_light');
     }

 // function initAutocomplete(){
 //      const input = document.getElementById("pac-input");
 //      const searchBox = new google.maps.places.SearchBox(input);
 //      searchBox.addListener("places_changed", () => {
 //      const places = searchBox.getPlaces();
 //      if (places.length == 0) { return; }
 //      const bounds = new google.maps.LatLngBounds();

 //      places.forEach((place) => {
 //        if (!place.geometry || !place.geometry.location) {
 //        console.log("Returned place contains no geometry");return; }
 //         //console.log(place); 
 //       }); });
 //    }
new DataTable('#d_table', {
    columnDefs: [
  
        { orderable: false, targets: '_all' }
    ],
    order: [[1, 'asc']],
    rowReorder: {
        dataSrc: 1
    }
});

new DataTable('#d_table2', {
    columnDefs: [
  
        { orderable: false, targets: '_all' }
    ],
    order: [[1, 'asc']],
    rowReorder: {
        dataSrc: 1
    }
});

</script>





</body>
</html>