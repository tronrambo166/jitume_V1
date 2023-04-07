<template>
    <div class="container" id="">
      <!-- Layout -->
 
     <div class="row border_dark p-0" style="">
     <div class="col-sm-8">
      
     <div class="navbar navbar-expand-sm p-0 navy  ">
       <ul class="navbar-nav py-2 "> 

        <li class="nav-item py-1 pl-3 pr-4">
            <a href="home"><img class="" src="images/logo_services.png" width="200px" height="65px" style="margin-left: 58px;"></a>
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
<div class="my-5 row service_img mx-auto text-center" style="min-height:500px">
  
   <div class=" col-sm-12 text-center" style="">

         <div class="py-5"></div>
         <div class="mt-5 mb-4 w-50 mx-auto text-center">   
         <h2 style="font-size:42px; font-weight: 500px;" class="text-light ">Looking for...
       </h2> 
     </div>

                        <form action="search" method="get" class=" w-100">
                            <div style="width:85%;" class=" mx-auto text-center row py-4 rounded text-center">

                            <div style="border-radius: 35px 0 0 35px;" class="py-2 col-sm-3 bg-white">
                              <input  required=""  style="border: none;height: 42px;" class="bar bg-white form-control d-inline" type="text" name="search" value="" placeholder="What are you looking for?"></div>

                              <div style="" class="py-2 col-sm-3 bg-white">
                              <input id="searchbox" required="" onkeyup="suggest(this.value);" style="border: none;height: 42px;" class="bar bg-white form-control d-inline" type="text" name="search" value="" placeholder="Location"></div>

                          <div class="py-2 col-sm-3 bg-white">
                          <div class="dropdown">

            <select class="border-none form-control">
            <option class="form-control" value="Business Planning" >Category</option>

           <option class="form-control" value="Business Planning" >Business Planning</option>
           <option value="Legal " >Project Management</option>
           <option value="Business Planning" >Business Planning</option>
           <option value="IT " >IT </option>
           <option value="Finance, Accounting & Tax Marketing" >Finance, Accounting & Tax Marketing</option>
           <option value="Public Relations" >Public Relations</option>
           <option value="Other" >Other</option>

           </select>

                        </div>
                        </div>

                            <div style="border-radius: 0 35px 35px 0;" class="bg-white col-sm-3 py-2 ">
                                <button  class="searchListing  float-right" type="submit">Search</button>
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
