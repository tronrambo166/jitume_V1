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

      <a v-if="auth_user" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="background: rgb(175 173 173 / 23%); cursor:pointer;" class=" text-dark d-inline px-3 py-2 d-inline-block text-center" ><b>Logout</b></a>
          
      <a v-else data-target="#loginModal" data-toggle="modal" style="background: #ffffff8c;" class=" text-dark d-inline px-3 py-2 d-inline-block text-center" ><b>Sign In</b></a>

       </li>
                                    
    </ul>
        </div> 

       <div class="col-sm-1"> </div>

    </div> 
           

    <!-- Layout -->
    
    
        <div class="heading row w-75 mx-auto my-5"> 
       
<table class="eq table table-bordered " id="">
    <thead>
        <tr>
            <th>Service Name </th>
            <th>Category </th>
            <th>Price </th>
            <th>Quantity </th>  
            <th class="text-center"></th>        
        </tr>

    </thead>
    

    
    <tbody>

        <tr v-for="( equipment, index ) in equipments" :id="equipment.id">
            <td>{{equipment.name }}</td>
                <td>{{equipment.category }}</td>
                    <td>{{equipment.price }} x {{equipment.qty }}</td>
                        <td>{{equipment.qty }}</td>
   
            <td class="text-center">

          <!--   <a style="cursor:pointer;" id="invest" v-if="equipment.status == 'active'" @click="Invest(equipment.listing_id,equipment.id,equipment.value,equipment.amount)" class="text-light buttonEq my-2">Invest</a> -->

          <a @click="removeCart(equipment.id)" style="cursor:pointer;"  class="text-light buttonEq my-2">X</a> 

        

            </td>

            

        </tr>
        <td v-if="empty" > No data found! </td>
    
    </tbody> 
    
    
</table>

<div class="shopping float-right">
    <div class="float-left">
        <h3>TOTAL: <span id="total" class="text-warning font-weight-bold"></span> Kshs</h3> 
    </div>
                    <div class="float-right"> 
                        <a href="cartStripe/"> <img class="rounded" width="150px" src="images/check.jpg" alt="" /></a>
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
    }),
    equipments:[],
    empty:false
    }),

    methods:{

     cart(){
           var t = this;
           axios.get('cart').then( (data) =>{
            t.equipments = data.data.data;
            if(data.data.cartCount == 0)
                t.expty = true;
             console.log(data.data.total)
             document.getElementById('total').innerHTML = data.data.total;
        
    });
    },

    removeCart(id){
    var t=this;
     axios.get('removeCart/'+id).then( (data) =>{
         $('#'+id).css('display','none');
         toastr.success(data.data.data) 
         document.getElementById('total').innerHTML = data.data.total;      
    });

    },

    select(){ 
    $('.single').css('background','#72c537');
    $('.multiple').css('background','');},
        
    select2(){ 
    $('.single').css('background','');
    $('.multiple').css('background','#72c537');},

    price(ev){ alert(ev.target.value);
    document.getElementById('price').value = btoa(ev.target.value);
    },

    getPhoto(){
    return '../';
}
  },
  

     mounted() { 
     this.cart(); 
      }

    }
</script>

