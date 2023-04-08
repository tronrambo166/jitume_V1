<template>
    <div class="container" id="">
      <!-- Layout -->
 
     <div class="row border_dark p-0" style="">
     <div class="col-sm-8">
      
     <div class="navbar navbar-expand-sm p-0 navy  ">
       <ul class="navbar-nav py-2 "> 

        <li class="nav-item py-1 pl-3 pr-4">
            <a href="home"><img class="" src="images/logo_services.png" width="150px" height="35px" style="margin-left: 58px;"></a>
        </li>
        
         <li class="nav-item py-1 px-3">

                    <li class="nav-item py-1 px-3 text-secondary"><router-link to="/looking_investor" class="text-secondary ">Looking for investors</router-link></li>

                    <li class="font-weight-bold nav-item py-1 px-3"><router-link to="/become_provider" class=" text-secondary">Become a provider
                    </router-link></li>

                </ul>
                 </div>
            </div>

    
    
    <div class="col-sm-3">
  <ul>
        <li style="list-style-type: none;" class="float-right mt-3 nav-item py-1 px-3 text-light ">
     <router-link style="background: rgb(221 221 221 / 55%);" class=" text-secondary rounded d-inline px-3 py-2 d-inline-block text-center" to="login" ><b>Sign In</b></router-link>
       </li>
    </ul>
        
        </div> 

       <div class="col-sm-1"> </div>

    </div> 
           

    <!-- Layout -->



<!-- PAGE CONTENT -->
<div class="mb-5 row service_img mx-auto text-center" style="min-height:500px">
  
   <div class=" col-sm-12 text-center" style="">

         <div class="py-5"></div>
         <div class="mt-5 mb-4 w-50 mx-auto text-center">   
         <h2 style="font-size: 60px;
    font-weight: bold;
    font-style: normal;text-shadow: 3px 3px #2a2a2c ; " class="text-light ">Looking for...
       </h2> 
     </div>

                        <form action="search" method="get" class=" w-100">
                            <div style="width:85%;" class=" mx-auto text-center row py-4 rounded text-center">

                              <div style="" class="py-2 col-sm-9 bg-white">
                              <input id="searchbox" required="" onkeyup="suggest(this.value);" style="border: none;" class=" bg-white form-control d-inline" type="text" name="search" value="" placeholder="Search"></div>


                            <div style="border-radius: 0 35px 35px 0;" class="bg-white col-sm-3 py-2 ">
                                <button  class="btn btn-light  float-right" type="submit"><i class="fa fa-search"></i></button>
                            </div>

                               </div>               

                            <div class="row" style="">
                                <div id="result_list" class="text-left" style="display: none;width:32%; z-index: 1000;height: 600px;position: absolute; margin-left: 378px;top: 308px;">
                                    
                                </div>
                            </div>
  
                        </form>
                        </div>

</div>

<!-- PAGE CONTENT -->

    

               </div>
   
</template>

<script>
   
export default {
    
    data: () => ({
    res:[],
    emptyCat:false
    }),
    methods:{
    setRes:function () {
            this.res = this.$route.query.result.results;
            console.log(this.res);
        },

  
  removePro(id){
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
  axios.get('http://localhost/laravel_projects/Vue_eCommerce/public/delpro/'+id).then( (data) =>{
  console.log(data)
   toastr.success(data.data.message)
              }).catch( (error) =>{})
   //this.$store.dispatch("fetchpro")
  }
})
  }

  },
  
mounted() { 
this.setRes()
     //return this.$store.dispatch("fetchpro")
      } 

    }
</script>
