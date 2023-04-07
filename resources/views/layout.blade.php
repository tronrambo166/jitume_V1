

<!DOCTYPE HTML>
<head>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <title>JITUME</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
   <style type="text/css"> 
   .btn-success{background:#72c537;color:white;}</style>
    
    
    
    
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

   <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('/css/style.css') }}" rel="stylesheet"/>

     <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
<!-- {{-- Vue component files --}}
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/http-vue-loader"></script>
  {{-- Vue component files --}} -->
  
</head>
<body>

     

<div class="app container-fluid "  >
 
<!-- Layout -->
    <!--  <div  class="row border_dark p-0" style="">
     <div class="col-sm-8">
      
     <div class="navbar navbar-expand-sm p-0 navy  ">
       <ul class="navbar-nav py-2 ">

        <li class="nav-item py-1 px-3">
            <a href="home"><img class="" src="images/logo.png" width="200px" height="65px" style="margin-left: 58px;"></a>
        </li>
        
                    <li class="nav-item py-1 px-3 text-light  "><router-link to="/home" class="font-weight-bold text-light nav-link">Jitume service</router-link></li>

                    <li class="font-weight-bold nav-item py-1 px-3 text-light"><router-link to="/applyShow" class="text-light nav-link">Apply for show
                    </router-link></li>
                </ul>
                 </div>
            </div>

    
    
    <div class="col-sm-3">
   

              <ul>
                    <li style="list-style-type: none;" class="float-right mt-3 nav-item py-1 px-3 text-light ">
                    </li>

                </ul>
                

        
        </div> 
       <div class="col-sm-1"> </div>

    </div> -->

    <!-- Layout -->

    <div class="row">

    <!-- yield('page') -->
    <router-view></router-view>

     </div>

    


    <div style="width:80%;" class="row mx-auto my-5">
        <div class="col-sm-6">
            <img src="images/logo_services.png" width="363px" height="110px">
        </div>

        <div class="col-sm-3">
            <ul>
                <li style="list-style-type:none;">
                    <a class="footer_txt" href="#"><i class="mr-2 fa fa-angle-right"></i>My Profile</a>
                </li>

                <li style="list-style-type:none;">
                    <a class="footer_txt" href="#"><i class="mr-2 fa fa-angle-right"></i>My Listings</a>
                </li>

                <li style="list-style-type:none;">
                    <a class="footer_txt" href="#"><i class="mr-2 fa fa-angle-right"></i>Bookmarks</a>
                </li>

                <li style="list-style-type:none;">
                    <a class="footer_txt" href="#"><i class="mr-2 fa fa-angle-right"></i>Add Business</a>
                </li>
            </ul>
        </div>

        <div class="col-sm-3">
             <ul>
                
                <h4 class="text-dark">Contact Us</h4>
               

                <li style="list-style-type:none;">
                    <a class="footer_txt" href="#">Phone: (123) 123-456</a>
                </li>

                <li style="list-style-type:none;">
                    <a class="footer_txt" href="#">E-Mail: info@thedtagency.com</a>
                </li>

                
            </ul>
        </div>
    </div>


        <div class=" border border-top-dark w-100">
        <footer class="w-100">
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

<script type="text/javascript">
    function suggest(search){  $("#result_list").html('');  
        var searchText=search;

$.ajax({
url:'get_suggest/'+searchText,
method:'get',
dataType:'json',
                success: function (response) {
                    console.log(response);
                
               for (i=0; i < 10; i++){ //console.log(response.data[i].name);
                    var name=response.data[i].name;
                    var city=response.data[i].city;
                    var country=response.data[i].country;
                    $("#result_list").show();

        $("#result_list").append(' <div onclick="address(\'' + name +','+ city +','+ country + '\');" style="" data-id="'+response.data[i].name+'" class="address  py-0 my-0 border broder-dark bg-light shadow single_comms">  <h6 class="font-weight-bold text-dark d-inline" ><i class="fa fa-map-marker text-success" aria-hidden="true"></i> '+name+'</h6> <p  class="d-inline text-dark"> Loc: <small>'+city+', '+country+'</small> </p> </div>');



                        }  
                    //document.getElementById('result_list').style.overflowY="scroll";   

     },
      error:function(error){  console.log(error);}

});

    }

  
</script>


    
<script type="text/javascript" src="js/app.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

       
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
 


<script type="text/javascript">
    function address(place){
        //var place = $(this).attr('data-id');
        document.getElementById('searchbox').value = place;
        //$("#result_list").html('');
       document.getElementById("result_list").style.display='none';

}

</script>
 
<!-- DATEPICKER -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <!-- DATEPICKER -->
  
  <script>
$( function() {
//DATE
$( "#datepicker" ).datepicker();
$( "#datepicker3" ).datepicker();
$( "#datepicker4" ).datepicker();
$( "#datepickerHome1" ).datepicker();
$( "#datepickerHome2" ).datepicker();

//Start
$( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});
var dateFormat = $( "#datepicker" ).datepicker( "option", "dateFormat" );
$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
//Min Date
$( "#datepicker" ).datepicker({
  minDate: new Date()
});
var minDate = $( "#datepicker" ).datepicker( "option", "minDate" );
$( "#datepicker" ).datepicker( "option", "minDate", new Date() );

//End
$( "#datepicker2" ).datepicker({dateFormat: "yy-mm-dd"});
var dateFormat = $( "#datepicker2" ).datepicker( "option", "dateFormat" );
$( "#datepicker2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
//Min Date
$( "#datepicker2" ).datepicker({
  minDate: new Date()
});
var minDate = $( "#datepicker2" ).datepicker( "option", "minDate" );
$( "#datepicker2" ).datepicker( "option", "minDate", new Date() );

  } );


 //if(currentDate !=null) console.log(currentDate);

  </script>

  <script type="text/javascript">
      //EndDate
$("#datepicker2").datepicker({
                onSelect: function (date, datepicker) {
                    var date_start = $('#datepicker').val();
                    if (date != "") {
                        if(date_start > date)
                            alert('End date cannot be earlier than start date!!')
                        const date1 = new Date(date_start);
                        const date2 = new Date(date);
                        const diffTime = Math.abs(date2 - date1);
                        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        diffDays = diffDays+1; 
                        $('#days').html(diffDays);

                        var per_day = $('#per_day').val();
                        var price = (per_day*diffDays);
                        var s_fee = 200; var total = price + s_fee;
                        $('#price').html('$'+price);
                        $('#total_price').html('$'+total);
                        $('#t_price').html('$'+total);
                        $('#due').html('$'+total);
                      
                    }
                }
            });
 //DATE
  </script>




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
                    <form method="POST" action="" enctype="multipart/form-data">
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="c_password" required autocomplete="new-password">

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
                 <!-- HIDDEN USER REG Card ends-->




                <!-- HIDDEN login-->
                <!-- HIDDEN login-->
                <!-- HIDDEN login-->

  <div class="card" id="all_logins">

 <div id="artist_log" class="card-body text-center py-0">

                          <form method="POST" class="" action="">
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
<div id="user_log" class="collapse card-body text-center py-0">

                    <form method="POST" class="d-inline form-inline" >
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

<script type="text/javascript">
    $('#login').css('border-bottom', '2px solid #72c537');
    $('#business_reg').hide();
    
    function login(){
    $('#register').css('border-bottom', 'none');    
    $('#login').css('border-bottom', '2px solid #72c537');

    $('#all_logins').show();
    $('#all_registers').hide();
    }

     function register(){ 
    $('#login').css('border-bottom', 'none');
    $('#register').css('border-bottom', '2px solid #72c537');

   $('#all_logins').hide();
    $('#all_registers').show();
    
    }


</script>


<script type="text/javascript">
    function user_log(){
    $('#art_log').removeClass('btn-success');
    $('#usr_log').removeClass('btn-light');
    $('#usr_log').addClass('btn-success');

    $('#user_log').show();
    $('#artist_log').hide();
    }

     function artist_log(){ 
    $('#usr_log').removeClass('btn-success');
    $('#art_log').removeClass('btn-light');
    $('#art_log').addClass('btn-success');

    $('#artist_log').show();
    $('#user_log').hide();
    
    }


</script>


<script type="text/javascript">

    function user(){

    $('#user').css({'background-color' : '#72c537'});
    $('#business').css({'background-color' : ''});

    $('#user_reg').show();
     $('#business_reg').hide();
    }

    

     function business(){
    $('#business').css({'background-color' : '#72c537'});
    $('#user').css({'background-color' : ''});

    $('#user_reg').hide();
    $('#business_reg').show();
    
    }



</script>



</body>
</html>
