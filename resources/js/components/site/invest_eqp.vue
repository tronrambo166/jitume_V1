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
    
    
        <div class="heading row w-75 mx-auto my-5"> 
       
<table class="eq table table-bordered " id="">
    <thead>
        <tr>
            <th>Equipment </th>
            <th>Amount </th>
            <th>Value </th>
            <th>Details </th>  
            <th class="text-center"></th>        
        </tr>

    </thead>
    

    
    <tbody>

        <tr v-for="( equipment, index ) in equipments" >
            <td>{{equipment.eq_name }}</td>
                <td>{{equipment.amount }}</td>
                    <td>{{equipment.value }}</td>
                        <td>{{equipment.details }}</td>
   
            <td class="text-center">

            <a v-if="equipment.status == 'active'" @click="Invest(equipment.listing_id,equipment.id,equipment.amount)" class="text-light buttonEq my-2">Invest</a>
            <button v-else  disabled class="text-secondary buttonEq my-2">Invest</button>

            </td>
        </tr>
        <td v-if="empty" > No data found! </td>
    
    </tbody> 
    
    
</table>

        
        </div>   




        
        
        
        
        
        <!-- Body -->
        
        
    </div> 
   
</template>

<script> 
   
export default {
    
   data: () =>({
    form: new Form({
    }),
    equipments:[],
    empty:false
    }),

    methods:{

    getEquipment:function(){ 
    var id=this.$route.params.id; var t=this;
    axios.get('http://localhost/laravel_projects/jitume/public/equipments/'+id).then( (data) =>{console.log(data);
    t.equipments = data.data.data;
    if (t.equipments == null ) t.empty = true; 
    });
    
    },

    Invest(listing_id,id,amount){
    var t=this;
     axios.get('http://localhost/laravel_projects/jitume/public/invest/'+listing_id+'/'+id+'/'+amount).then( (data) =>{console.log(data);
    //t.equipments = data.data.data; 
    });

    },
    getPhoto(){
   return '../';
}
  },
  

     mounted() { 
     this.getEquipment(); 
      }

    }
</script>
