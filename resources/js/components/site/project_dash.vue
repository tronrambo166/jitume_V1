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

                <!-- Download form -->
  
         <div class="modal-body">
        <form action=""  method="post" enctype="multipart/form-data" class="form-group form">
                                
                                

                                <div class="row pt-2" width="85%">
                                    <div class="col-sm-3 px-1">
                                        <div class=" ">
                                            <input required="" name="title" type="text" placeholder="Milestone Name"  class="w-100 rounded border border-dark ">
                                        </div>
                                    </div>


                                    <div class="col-sm-2 px-1 ">
                                        <div class="">
                                         
                                            <input required=""  type="number"placeholder="Amount"  name="amount" class="w-100 rounded border border-dark " >
                                        </div>
                                    </div>

                                <div class="col-sm-3 px-1">
                                <div class="upload-btn-wrapper w-100">
                                  <button class="btnUp3 w-100">Download Milestone Documentaion <i class="ml-2 fa fa-arrow-up"></i></button>
                                  <input type="file" name="file" />
                                </div>
                                    </div>



            <div class="col-sm-3 px-1">
                <div class="form-group ">
          <select required=""  name="business_id" class="w-100 rounded border border-dark p-1 ">
            <option hidden class="form-control" >Select Business</option>

            
            
           </select> 
                                        </div>
                                    </div>


                                    <div class="col-1 px-1">
                                        <div class="form-group">
                                        <input type="submit" class="text-center p-0 btn btn-warning btn-block" value="ADD" />
                                    </div>
                                </div>
                           
                                </div>
                                
                            </form>

    </div>


      <!-- ADD MODAL -->


             </div>


               
                


       
        </div>
    </div>
</template>

<script>

    export default {
    props: ['auth_user'],    
    data: () => ({
    form: new Form({
        id:'',
        select:false
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
    this.form.select = true;

    if(event == '9.99'){
        var pacage = 'silver-month';
    $('#one').css('background','#e0edd8');
    $('#two').css('background','');
    $('#three').css('background','');
  }

   if(event == '29.99'){
    var pacage = 'gold-month';
    $('#two').css('background','#e0edd8');
    $('#one').css('background','');
    $('#three').css('background','');
  }

   if(event == '69.99'){
    var pacage = 'platinum-month';
    $('#three').css('background','#e0edd8');
    $('#two').css('background','');
    $('#one').css('background','');
  }

   if(event == '95.99'){
    var pacage = 'silver-year';
    $('#four').css('background','#e0edd8');
    $('#five').css('background','');
    $('#six').css('background','');
  }

  if(event == '287.99'){
    var pacage = 'gold-year';
    $('#five').css('background','#e0edd8');
    $('#four').css('background','');
    $('#six').css('background','');
  }

  if(event == '671.99'){
    var pacage = 'platinum-year';
    $('#six').css('background','#e0edd8');
    $('#five').css('background','');
    $('#four').css('background','');
  }
    document.getElementById('price').value = event;
    document.getElementById('listing_id').value = this.form.id;
    document.getElementById('package').value = pacage;
},
 make_session(id){
            sessionStorage.setItem('invest',id);
        },


}

}

</script>
