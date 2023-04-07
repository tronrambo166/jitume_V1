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

    
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
                <h3 class="text-center font-weight-bold"><b class="h5 text-success" > </b> </h3>
       

            <div class="clear"></div>
      


       
         <div class="clear"></div>
    

  
            


            <div class="content_bottom">
                <div class="heading">
                     <h3 class="my-5 bg-light text-center text-secondary">Listings</h3>
                </div>
                <div class="clear"></div>
            </div>

             
         <div class="row mt-5">

             
                <div v-for="( result, index ) in results" class="listing col-sm-4 my-5">
                    <router-link :to="`/listingDetails/${result.id}`" class="shadow card border"> <img style="width:332px; height:230px" :src="result.image"   alt=""  /> 

                    <h4 class="mt-3 mb-0">{{result.name}} </h4>
                    <p class="my-1"><i class="mr-2 fa fa-map-marker"></i>{{result.location}}</p>
                    <p><span class="mt-1 rounded"><i class="mr-2 fa fa-phone"></i>{{result.contact}}</span></p>
                    </router-link>
                    
              </div>
                </div>
                
               
            </div>
           </div>
               </div>
   
</template>

<script>
   
export default {
    
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
            axios.get('http://localhost/laravel_projects/jitume/public/searchResults/'+t.ids).then( (data) =>{
                t.results = data.data.data;
                console.log(data);
              }).catch( (error) =>{})
        },

        getPhoto(){
   
        return '../';

        }
  
  },
  
   mounted() { 
   this.setRes()
     //return this.$store.dispatch("fetchpro")
      } 

    }
</script>
