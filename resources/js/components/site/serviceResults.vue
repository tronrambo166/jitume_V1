<template>
    <div class="container bg-white" id="">

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

    
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
                <h3 class="text-center font-weight-bold"><b class="h5 text-success" > </b> </h3>
       

            <div class="clear"></div>
      


       
         <div class="clear"></div>
    

  
            


            <div class="content_bottom">
                <div class="heading">
                     <h3 class="my-5 bg-light text-center text-secondary">Services</h3>
                </div>
                <div class="clear"></div>
            </div>

             
         <div class="row mt-5">

             
                <div v-for="( result, index ) in results" class="listing col-sm-4 my-5">
                    <router-link :to="`/serviceDetails/${result.id}`" class="shadow card border px-5"> <img style="width:332px; height:230px" :src="result.image"   alt=""  /> 

                    <h4 class="mt-3 mb-0">{{result.name}} </h4>
                    <p class="my-1"><i class="mr-2 fa fa-dollar"></i>{{result.price}} Kshs</p>
                    <p><span class="mt-1 rounded"><i class="mr-2 fa fa-category"></i>Category: {{result.category}}</span></p>
                    </router-link>
                    
              </div>
                </div>
                
               
            </div>
           </div>
               </div>
   
</template>

<script>
   
export default {
    props: ['auth_user'],
    data: () => ({
    results:[],
    ids:'',
    empty:false
    }),
    methods:{
    setRes:function () {
            let t = this;
            this.ids = this.$route.params.results;
             //this.results = this.ids.split(",");
            axios.get('https://test.jitume.com/ServiceResults/'+t.ids).then( (data) =>{
                t.results = data.data.data;
                console.log(data);
              }).catch( (error) =>{})
        },

        getPhoto(){
   
        return '../';

        },
        cart(){
           axios.get('https://test.jitume.com/cart').then( (data) =>{
            document.getElementById('cart').innerHTML = data.data.cart;
        
    });
    }
  
  },
  
   mounted() { 
   this.setRes()
   this.cart()
     //return this.$store.dispatch("fetchpro")
      } 

    }
</script>
