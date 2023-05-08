<template>
        <div class="main">
        <div class="container">


                         <!-- Layout -->
 
     <div class="row border_dark p-0" style="">
     <div class="col-sm-8">
      
     <div class="navbar navbar-expand-sm p-0 navy  ">
       <ul class="navbar-nav py-2 ">

        <li class="nav-item py-1 pl-3 pr-4">
            <a href="home"><img class="" src="images/logo_services.png" width="200px" height="65px" style="margin-left: 58px;"></a>
        </li>
        
         <li class="nav-item py-1 px-3"><router-link to="/home" class="text-secondary ">Home</router-link></li>

                    <li class="nav-item py-1 px-3 text-secondary"><router-link to="/services" class="text-secondary ">Jitume service</router-link></li>

                    <li class="font-weight-bold nav-item py-1 px-3"><router-link to="/applyShow" class=" text-secondary">Apply for show
                    </router-link></li>

                </ul>
                 </div>
            </div>

    
    
    <div class="col-sm-3">
  <ul>
        <li style="list-style-type: none;" class="float-right mt-3 nav-item py-1 px-3 text-light "> 

      <a v-if="auth_user" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="background: rgb(175 173 173 / 23%); cursor:pointer;" class=" text-dark d-inline px-3 py-2 d-inline-block text-center" ><b>Logout</b></a>
          
      <a v-else data-target="#loginModal" data-toggle="modal" style="background: rgb(175 173 173 / 23%);" class=" text-dark d-inline px-3 py-2 d-inline-block text-center" ><b>Sign In</b></a>

       </li>
                                    
    </ul>
        
        </div> 

       <div class="col-sm-1"> </div>

    </div> 
           

    <!-- Layout -->

             <div class="w-75 m-auto row my-4 text-center">
                <div class="col-sm-12">
                    <h4 class="font-weight-bold text-center pt-2">Let's get you started!</h4>
                    <h6>All plans start with a 7 days free trial.</h6>
                </div>

                 <div class="col-sm-12 my-3">
                    <input @change="type($event);" style="font-size:20px;" name="type" type="radio"  value="M" id="month"> <span class="mr-3">Monthly</span>
                     <input @change="type($event);" name="type" type="radio" value="Y" id="year">
                     <span class="">Annualy (Save 20%)</span> 
                </div>
     

            </div>


            <div class="w-75 m-auto row border border-dark my-4">
                <div class="col-sm-4 ">
                    <h5 class="text-center pt-2">Silver</h5>
                </div>

                <div class="col-sm-4 ">
                    <h5 class="text-center pt-2">Gold</h5>
                </div>

                <div class="col-sm-4">
                    <h5 class="text-center pt-2">Platinum</h5>
                </div>

            </div>


            <div id="monthly" class="row w-75 mx-auto">
                <div class="col-sm-4">
                    <div class=" card"  @click="select(9.99)" id="one" >
                        <p class="text-center font-weight-bold h5 pt-2">$9.99</p>
                    <p class="text-center">10 free "Start conversations" per month from any range.</p>
                </div> </div>

                <div class="col-sm-4 "    >
                    <div class=" card" @click="select(29.99)" id="two">
                        <p class="text-center font-weight-bold h5 pt-2">$29.99</p>
                    <p class="text-center">Silver + access to all data from one chosen range.</p>
                </div> </div>

                <div class="col-sm-4 "  >
                    <div class=" card"  @click="select(69.99)" id="three">
                        <p class="text-center font-weight-bold h5 pt-2">$69.99</p>
                    <p class="text-center">Sivler access + Gold access to all data.</p>
                </div> </div>

            </div>



            <div id="yearly" class=" row w-75 mx-auto mb-5" style="display:none;">
                <div class="col-sm-4">
                    <div class=" card"  @click="select(95.99)" id="four" >
                        <p class="text-center font-weight-bold h5 pt-2">$95.99</p>
                    <p class="text-center">10 free "Start conversations" per month from any range.</p>
                </div> </div>

                <div class="col-sm-4 ">
                    <div class=" card" @click="select(287.99)" id="five" >
                        <p class="text-center font-weight-bold h5 pt-2">$287.99</p>
                    <p class="text-center">Silver + access to all data from one chosen range.</p>
                </div> </div>

                <div class="col-sm-4 ">
                    <div class=" card" @click="select(671.99)" id="six" >
                        <p class="text-center font-weight-bold h5 pt-2">$671.99</p>
                    <p class="text-center">Sivler access + Gold access to all data.</p>
                </div> </div>

            </div>


            <div class="row w-50 mx-auto  my-4">
                
                <div class="w-50">
                     <h4>Turnover ranges:</h4>
                        <p class="font-weight-bold my-1"> <span class="font-weight-bold">-</span> $0-$10000</p>
                        <p class="font-weight-bold my-1"> <span class="font-weight-bold">-</span> $10000-$100000</p>                    
                        <p class="font-weight-bold my-1"> <span class="font-weight-bold">-</span> $100000-$25000</p>
                        <p class="font-weight-bold my-1"> <span class="font-weight-bold">-</span> $250000-$50000</p>
                        <p class="font-weight-bold my-1"> <span class="font-weight-bold">-</span> $500000+</p>   
                </div>

                <div class="w-50">
                <form action="stripe" method="get" class="float-right mt-5">
                 <input type="text" hidden id="price" name="price" value="one time">
                  <input type="number" hidden id="listing_id" name="listing_id" value="">
                <button @click="make_session(form.id);" type="submit" class="btn btn-primary px-3 font-weight-bold" >
          Checkout
        </button>
            </form>
                </div>

                </div>


               
                


       
        </div>
    </div>
</template>

<script>

    export default {
    props: ['auth_user'],    
    data: () => ({
    form: new Form({
        id:''
    }),
    empty:false
    }),

    created(){
         var id=this.$route.params.id;
         let t=this;
         t.form.id = id;
         document.getElementById('listing_id').value = id;

    },
    methods:{
    type(event){
        if(event.target.value == 'M'){
        $('#monthly').show();
        $('#yearly').hide();
    }
    else {
        $('#monthly').hide();
        $('#yearly').show();
    }

    },
    select(event){ 
        //alert(event)
    if(event == '9.99'){
    $('#one').css('background','#e0edd8');
    $('#two').css('background','');
    $('#three').css('background','');
  }

   if(event == '29.99'){
    $('#two').css('background','#e0edd8');
    $('#one').css('background','');
    $('#three').css('background','');
  }

   if(event == '69.99'){
    $('#three').css('background','#e0edd8');
    $('#two').css('background','');
    $('#one').css('background','');
  }

   if(event == '95.99'){
    $('#four').css('background','#e0edd8');
    $('#five').css('background','');
    $('#six').css('background','');
  }

  if(event == '287.99'){
    $('#five').css('background','#e0edd8');
    $('#four').css('background','');
    $('#six').css('background','');
  }

  if(event == '671.99'){
    $('#six').css('background','#e0edd8');
    $('#five').css('background','');
    $('#four').css('background','');
  }
    document.getElementById('price').value = event;
},
 make_session(id){
            sessionStorage.setItem('invest',id);
        },


}

}

</script>
