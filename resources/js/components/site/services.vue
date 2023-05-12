<template>
    <div class="container" id="">
      <!-- Layout -->
 
     <div class="row border_dark p-0" style="">
     <div class="col-sm-8">
      
     <div class="navbar navbar-expand-sm p-0 navy  ">
       <ul class="navbar-nav py-2 "> 

        <li class="nav-item py-1 pl-1 pr-2">
            <a href="home"><img class="" src="images/logo_services.png" width="170px" height="45px" style="margin-left: 58px;"></a>
        </li>
        

                    <li class="nav-item py-1 px-3 text-secondary"><router-link to="/" class="bg-white text-dark ">Looking for investors</router-link></li>

                    <li class="font-weight-bold nav-item py-1 px-3"><a href="#" data-target="#loginModal" data-toggle="modal" class=" text-dark">Become a provider
                    </a></li>


                    <li class="font-weight-bold nav-item py-1 px-3"><router-link to="/cart" class=" text-secondary"><i class="fa fa-shopping-cart"></i><span id="cart" class="rounded-circle px-2 text-light bg-warning"></span>
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

                             <form id="form" @submit.prevent ="search();" class=" w-100" method="post">
                            <div style="width:85%;" class=" mx-auto text-center row py-4 rounded text-center">

                            <div style="border-radius: 35px 0 0 35px;" class="py-2 col-sm-3 bg-white">
                              <input  required=""  style="border: none;height: 42px;" class="bar bg-white form-control d-inline" type="text" name="listing_name" placeholder="What are you looking for?"></div>

                              <div style="" class="py-2 col-sm-3 bg-white">
                              <input id="searchbox" required="" onkeyup="suggest(this.value);" style="border: none;height: 42px;" class="bar bg-white form-control d-inline" type="text" name="search" value=""placeholder="Location">

                          </div>

                          <div class="py-2 col-sm-3 bg-white">
                          <div class="dropdown">

           <select  name="category" class="mt-2 border-none form-control">    
           <option hidden class="form-control" >Services</option>
           <option class="form-control" value="Business Planning" >Business Planning</option>
           <option value="IT" >IT</option>
           <option value="Legal Project Management" >Legal Project Management</option>
           <option value="Branding and Design" >Branding and Design </option>
           <option value="Auto" >Auto</option>
           <option value="Finance, Accounting & 
                Tax Marketing" >Finance, Accounting & 
                Tax Marketing</option>
           <option value="Tax Marketing">Tax Marketing</option>
           <option value="Public Relations">Public Relations</option>
           <option value="Other" >Other</option> 

           </select>

                        </div>
                        </div>

                            <div style="border-radius: 0 35px 35px 0;" class="bg-white col-sm-3 py-2 ">
                                <button  class="searchListing  float-right" type="submit">Search</button>
                            </div>

                               </div>               

                            <div class="row" style="">
                                <div id="result_list" class="text-left" style="display: none;width:32%; z-index: 1000;height: 600px;position: absolute; margin-left: 378px;top: 330px;">
                                    
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
    props: ['auth_user'],
    data: () => ({
    res:[],
    emptyCat:false
    }),
    methods:{
    
    search(){
    const form = $('#form');
    var thiss = this;
    var ids='';

    $.ajax({
    url:'searchService',
    method:'POST',
    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    dataType:'json',
    data:form.serialize(),
    success: function (response) {
    console.log(response);

    Object.entries(response.results).forEach(entry => {
    const [index, row] = entry; 
    ids = ids+row.id+',';      
    });//console.log(ids);

    //thiss.$router.push({ path: '/listingResults', query: { result: response } })
    thiss.$router.push({ name: 'serviceResults', params: { results: ids}})
    },
    error: function (response) {
    console.log(response);
    }
    });
    },

    cart(){
           axios.get('cart').then( (data) =>{
            document.getElementById('cart').innerHTML = data.data.cart;
        
    });
    }

  },
  
mounted() { 
    this.cart();
     //return this.$store.dispatch("fetchpro")
      } 

    }
</script>
