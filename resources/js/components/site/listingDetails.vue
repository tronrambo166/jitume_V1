<template>
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
     <router-link style="background: rgb(221 221 221 / 55%);" class=" text-secondary rounded d-inline px-3 py-2 d-inline-block text-center" to="login" ><b>Sign In</b></router-link>
       </li>
    </ul>
        
        </div> 

       <div class="col-sm-1"> </div>

    </div> 
           

    <!-- Layout -->
    
    
        <div class="heading row"> 
        <div class="col-sm-7">
             <div class="grid images_3_of_2 rounded listing px-3">
                <img style="width:100%;height:405px" class="shadow card" 
                :src="form.image" alt="" />
                    
                 <div class="pl-2">
                    <h3 class="mt-2 text-left text-dark font-weight-bold ">{{form.name}}</h3>
        
                        <p class="my-1"><i class="mr-2 fa fa-map-marker"></i>{{form.location}}</p>
                        </div>

                        <div class="row my-4">
                            <div class="col-sm-12">
                            <a class="btn border border-bottom-success">Overview</a>
                            <a class="btn border border-bottom-success">Add review</a>

                            <hr>
                            </div>
                            
                      
                   <div class="Overview" id="Overview">
                    <p> <span class="font-weight-bold">Details:{{form.details}}</span></p>
                    <p><span class="mt-1 rounded"><i class="mr-2 fa fa-phone"></i>{{form.contact}}</span></p>
                    </div>

                      
                          </div>                                  

                    </div>

         </div> 

         <div class="col-sm-5">
            <div class="card bg-light w-75 mx-auto py-3">
             <h5 class="mx-4 text-secondary shadow border border-light py-2 d-block text-center">Seed investors spot open
                <i class="ml-1 fa fa-angle-up"></i></h5>
                <button class="buttonListing my-3">Login to book</button>
                <hr>

                <h5 class="border border-light py-2 d-block text-center">Commitment to invest fee <p class="d-inline text-success">2000</p>
                </h5>

                <div v-if="auth_user" class="eqp-invest">
                <router-link :to="`/invest_eqp/${form.listing_id}`" class="text-light buttonListing my-3">Invest with Equipment/Supplies</router-link>
                <router-link :to="`/donate_eqp/${form.listing_id}`" class="text-light buttonListing my-3">Donate with Equipment/Supplies</router-link>
                </div>

                <div v-else="auth_user" class="eqp-invest">
                <a @click="make_session(form.listing_id);" href="" data-target="#loginModal" data-toggle="modal" class="text-light buttonEq my-3">Invest with Equipment/Supplies</a>
                <a href="" data-target="#loginModal" data-toggle="modal" class="text-light buttonListing my-3">Donate with Equipment/Supplies</a>
                </div>

         </div>
         </div>
        
        </div>   




        
        
        
        
        
        <!-- Body -->
        
        
    </div> 
   
</template>

<script> 
   
export default {
    
   props: ['auth_user'],
   data: () =>({
    form: new Form({
        name:'',
        listing_id:'',
        details:'',
        location:'',
        contact:'',
        category:'',
        image:''
    }),
    details:[] 
    }),

created(){
if(sessionStorage.getItem('invest')!=null)
    sessionStorage.setItem('invest','');
},
    methods:{

   getDetails:function(){ 
    var id=this.$route.params.id; var t=this;
    axios.get('http://localhost/laravel_projects/jitume/public/searchResults/'+id).then( (data) =>{console.log(data);
    //t.details = data.data.data;
    t.form.name = data.data.data[0].name;
    t.form.details = data.data.data[0].details;
    t.form.location = data.data.data[0].location;
    t.form.contact = data.data.data[0].contact;
    t.form.image = data.data.data[0].image;
    t.form.category = data.data.data[0].category;
    t.form.listing_id = data.data.data[0].id;
    
    });
    
    },
    getPhoto(){
   
        return '../';

        },

  
  make_session(id){
            sessionStorage.setItem('invest',id);
        }
        },
  

     mounted() { 
     this.getDetails();
    
      }

    

     

    }
</script>
