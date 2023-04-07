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
                <img style="width:100%;height:450px" class="shadow card" 
                :src="form.image" alt="" />
                    
                <h3 class="mt-2 text-left text-dark font-weight-bold ">{{form.name}}</h3>
        
                    <div class="">
                        <p class="my-1"><i class="mr-2 fa fa-map-marker"></i>{{form.location}}</p>
                    <p><span class="mt-1 rounded"><i class="mr-2 fa fa-phone"></i>{{form.contact}}</span></p>

                        <p> <span class="font-weight-bold">Category:{{form.category}}</span></p>
                        
                    </div>
                    </div>

         </div> 

         <div class="col-sm-5 m-auto">
             <h3 class="d-block m-auto text-center">LOADING...</h3>
         </div>
        
        </div>   




        
        
        
        
        
        <!-- Body -->
        
        
    </div> 
   
</template>

<script> 
   
export default {
    
   data: () =>({
    form: new Form({
        name:'',
        details:'',
        location:'',
        contact:'',
        category:'',
        image:''
    }),
    details:[] 
    }),

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
    
    });
    
    },
    getPhoto(){
   
        return '../';

        }
  },
  

     mounted() { 
     this.getDetails();
    
      }

    

     

    }
</script>
