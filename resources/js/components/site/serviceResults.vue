<template>
    <div class="container bg-white" id="">

             

    
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
            axios.get('ServiceResults/'+t.ids).then( (data) =>{
                t.results = data.data.data;
                console.log(data);
              }).catch( (error) =>{})
        },

        getPhoto(){
   
        return '../';

        },
        cart(){
           axios.get('cart').then( (data) =>{
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
