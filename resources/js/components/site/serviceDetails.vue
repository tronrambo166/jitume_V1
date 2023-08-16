<template>
    <div class="container">
        
              
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    
        <div class="heading row mx-auto my-3"> 
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                    
                        <div class="grid images_3_of_2 rounded listing px-3">
                <img style="width:100%;height:280px" class="shadow card" 
                :src="form.image" alt="" />
                    
                                          

                    </div>

                    <div class="pl-4 row mt-4">
                    <div class="col-sm-6">
                    <h5 class="text-left text-dark font-weight-bold ">{{form.name}}</h5>
        
                        <p class="font-weight-bold my-1 small">${{form.price}} </p>
                        </div>

                    <div class="col-sm-6 text-center">
                    <p class="font-weight-bold small text-left">{{form.location}}</p>
        
                        <div class="] d-inline-block" id="staticRating">
                            <img src="rating/images/g-star.svg" style="height: 15px;color:green" class="">
                            <img src="rating/images/g-star.svg" style="height: 15px;" class="">
                            <img src="rating/images/g-star.svg" style="height: 15px;" class="">
                            <img src="rating/images/g-star.svg" style="height: 15px;" class="">
                            <img src="rating/images/black-star.png" style="height: 15px;" class="">
                        </div>
                        </div>

                        </div>

                        <div class="row my-5">
                            <div class="col-sm-12">
                            <a class="btn border border-bottom-success">Overview</a>
                            <a class="btn border border-bottom-success">Add review</a>

                            <hr>
                            <!-- <p> <span class="ml-2 font-weight-bold">Details:{{form.details}}</span></p> -->

                            </div>
                            </div>  
                            

                </div>

                <div class="col-sm-5">

                      
                   <div class="Overview" id="Overview">
                    <h4 class="text-center font-weight-bold">About</h4>
                    <p class="font-weight-bold small text-left">{{form.details}}</p>

                    <div class="cart text-center">
                        <form>
                           <!--  <input id="qty" min="1" class="w-25 form-control d-inline" type="number" name="qty" value="1"> -->
                           
                            <a  v-if="auth_user" @click="service_milestones(form.id)" class="text-light font-weight-bold w-75 text-center buttonEq2">Purchase by Milestones</a>

                            <!--
                            <a  v-if="auth_user" @click="addToCart(form.id)" class="text-light font-weight-bold btn buttonEq2">Add to cart</a>
                            <a v-else @click="make_session()" class="text-light font-weight-bold btn buttonEq2" data-target="#loginModal" data-toggle="modal">Add to cart</a> -->

                            <a v-else @click="make_session()" class="text-light font-weight-bold w-75 text-center buttonEq2" data-target="#loginModal" data-toggle="modal">Purchase by Milestones</a>

                        </form>
                    </div>
                    <p><span class="mt-1 rounded"><i class="mr-2 fa fa-category"></i>Category: {{form.category}}</span></p>
                    </div>

                      
                                 
                </div>

                 <div class="col-sm-3" style="background:black;">
                    <div class="py-2">
                    <div class="row">
                    <button class="ml-auto my-3 w-50 btn header_buttons text-light float-right">Message</button>
                     </div>
                    <div class="row">
                        <p class="d-inline w-50 text-left text-light">Desired start date: </p> 
                        <span class="d-inline w-50"><input type="date" name="book-date"></span>
                    </div>

                    <div class="row">
                        <p class="text-right text-light">Enter additional notes </p> 
                        <span class="text-center"><textarea name="notes" cols="30" rows="10"></textarea></span>
                    </div>

                    <button class="my-3 py-1 btn-success w-50 btn header_buttons text-light float-right">Book</button>

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
    axios.get('ServiceResults/'+id).then( (data) =>{console.log(data);
    //t.details = data.data.data;
    t.form.price = data.data.data[0].price;
    t.form.name = data.data.data[0].name;
    t.form.details = data.data.data[0].details;
    t.form.location = data.data.data[0].location;
    //t.form.contact = data.data.data[0].contact;
    t.form.image = data.data.data[0].image;
    t.form.category = data.data.data[0].category;
    t.form.shop_id = data.data.data[0].shop_id;
    
    });
    
    },

    addToCart(id){
        var qty = $('#qty').val();
        var id=this.$route.params.id; var t=this;
    axios.get('addToCart/'+id+'-'+qty).then( (data) =>{console.log(data);
         toastr.success(data.data.response) 
         this.$router.push('/cart')
    });
    },

    service_milestones(id){
        var id=this.$route.params.id;
        var t=this; 
         this.$router.push('/service-milestone/'+id);
    },

    getPhoto(){
   
        return '../';

        },

  
  make_session(){ 
            var id=this.$route.params.id;
            sessionStorage.setItem('serviceDetails',id);
            document.getElementById('c_to_action').value = 'loginFromService';
            document.getElementById('c_to_action_login').value = 'loginFromService';
        },
        cart(){
           axios.get('cart').then( (data) =>{
            document.getElementById('cart').innerHTML = data.data.cart;
        
    });
    },

    replaceText(){
    $('#call_to').html('');
    $('#call_to').html('<a onclick="c_to_actionS();" data-target="#loginModal" data-toggle="modal" style="background: #72c537; border-radius: 15px;cursor: pointer;font-size: 11px; " class="text-light px-sm-3 my-1 px-1 py-1 ml-5 d-inline-block small text-center" ><span style="font-weight:bolder;" id="c_to_ac">Add Your Service</span></a> ');
    }

        },
  

     mounted() { 
     this.replaceText();
     this.getDetails();
     this.cart();
    
      }

    

     

    }
</script>
