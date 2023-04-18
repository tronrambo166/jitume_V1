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

                    <li class="font-weight-bold nav-item py-1 px-3"><router-link to="/cart" class=" text-secondary"><i class="fa fa-shopping-cart"></i><span id="cart" class="rounded-circle px-2 text-light bg-warning"></span>
                    </router-link></li>

                </ul>
                 </div>
            </div>

    
    
    <div class="col-sm-3">
  <ul>
        <li style="list-style-type: none;" class="float-right mt-3 nav-item py-1 px-3 text-light "> 

      <a v-if="auth_user" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="background: rgb(175 173 173 / 23%);" class=" text-dark d-inline px-3 py-2 d-inline-block text-center" ><b>Logout</b></a>
          
      <a v-else data-target="#loginModal" data-toggle="modal" style="background: rgb(175 173 173 / 23%);" class=" text-dark d-inline px-3 py-2 d-inline-block text-center" ><b>Sign In</b></a>

       </li>
                                    
    </ul>
        
        </div> 

       <div class="col-sm-1"> </div>

    </div> 
           

    <!-- Layout -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    
        <div class="heading row w-75 mx-auto"> 
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-7">
                    
                        <div class="grid images_3_of_2 rounded listing px-3">
                <img style="width:100%;height:280px" class="shadow card" 
                :src="form.image" alt="" />
                    
                                          

                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="pl-2">
                    <h3 class="mt-2 text-left text-dark font-weight-bold ">{{form.name}}</h3>
        
                        <p class="font-weight-bold my-1"><i class="mr-1 fa fa-dollar"></i>{{form.price}} Kshs</p>
                        </div>

                        <div class="row my-5">
                            <div class="col-sm-12">
                            <a class="btn border border-bottom-success">Overview</a>
                            <a class="btn border border-bottom-success">Add review</a>

                            <hr>
                            </div>
                            
                      
                   <div class="Overview" id="Overview">
                    <p> <span class="ml-2 font-weight-bold">Details:{{form.details}}</span></p>

                    <div class="cart">
                        <form>
                            <input id="qty" min="1" class="w-25 form-control d-inline" type="number" name="qty" value="1">
                           
                            <a  v-if="auth_user" @click="addToCart(form.id)" class="text-light font-weight-bold btn buttonEq2">Add to cart</a>

                            <a v-else @click="make_session()" class="text-light font-weight-bold btn buttonEq2" data-target="#loginModal" data-toggle="modal">Add to cart</a>

                        </form>
                    </div>
                    <p><span class="mt-1 rounded"><i class="mr-2 fa fa-category"></i>Category: {{form.category}}</span></p>
                    </div>

                      
                          </div>         
                </div>
            </div>


            <div class="row my-5 card shadow p-3">
                <h3>Reviews</h3>
                <p class="text-secondary my-3">There are no reviews yet.</p>

                <button class="w-50 searchListing">Add Review</button>
            </div>

         

         </div> 

         <div class="col-sm-5">
           <!--  <div class="card bg-light w-75 mx-auto py-3">
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
                <a @click="make_session(form.listing_id);" href="" data-target="#loginModal" data-toggle="modal" class="py-2 text-light buttonListing my-3">Invest with Equipment/Supplies</a>
                <a href="" data-target="#loginModal" data-toggle="modal" class="py-2 text-light buttonListing my-3">Donate with Equipment/Supplies</a>
                </div>

         </div> -->
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
        shop_id:'',
        details:'',
        price:'',
        contact:'',
        category:'',
        image:''
    }),
    details:[] 
    }),

created(){
if(sessionStorage.getItem('serviceDetails')!=null)
    sessionStorage.clear();
},
    methods:{

   getDetails:function(){ 
    var id=this.$route.params.id; var t=this;
    axios.get('http://localhost/laravel_projects/jitume/public/ServiceResults/'+id).then( (data) =>{console.log(data);
    //t.details = data.data.data;
    t.form.price = data.data.data[0].price;
    t.form.name = data.data.data[0].name;
    t.form.details = data.data.data[0].details;
    //t.form.location = data.data.data[0].location;
    //t.form.contact = data.data.data[0].contact;
    t.form.image = data.data.data[0].image;
    t.form.category = data.data.data[0].category;
    t.form.shop_id = data.data.data[0].shop_id;
    
    });
    
    },

    addToCart(id){
        var qty = $('#qty').val();
        var id=this.$route.params.id; var t=this;
    axios.get('http://localhost/laravel_projects/jitume/public/addToCart/'+id+'-'+qty).then( (data) =>{console.log(data);
         toastr.success(data.data.response) 
         this.$router.push('/cart')
    });
    },

    getPhoto(){
   
        return '../';

        },

  
  make_session(){ 
            var id=this.$route.params.id;
            sessionStorage.setItem('serviceDetails',id);
        },
        cart(){
           axios.get('http://localhost/laravel_projects/jitume/public/cart').then( (data) =>{
            document.getElementById('cart').innerHTML = data.data.cart;
        
    });
    }
        },
  

     mounted() { 
     this.getDetails();
     this.cart();
    
      }

    

     

    }
</script>
