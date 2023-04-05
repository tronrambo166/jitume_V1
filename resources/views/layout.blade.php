

<!DOCTYPE HTML>
<head>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <title>JITUME</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
   
    
    
    
    
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

   <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('/css/style.css') }}" rel="stylesheet"/>

    
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
  {{-- Vue files 
 <script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>  
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.23.0/axios.min.js"></script>

<script type="text/javascript" src="js/vue-router.js"></script>
<script type="text/javascript" src="js/routerCode.js"></script>
 Vue files --}} 


<script type="text/javascript">
    function address(place){
        //var place = $(this).attr('data-id');
        document.getElementById('searchbox').value = place;
        //$("#result_list").html('');
       document.getElementById("result_list").style.display='none';

}

</script>
 

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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


  <script>
   
export default {
    
    data: () => ({
    home:true
    })
      
    }
</script>


</body>
</html>
