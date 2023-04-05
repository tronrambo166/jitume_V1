<template>
    <div class="container">
        
    
            <div class="heading"> 
            <h5 class="mb-5 text-secondary bg-light text-center">Preview Product </h5>
            </div>

            <h3 class="text-center font-weight-bold bg-light"><b class="h5 text-success" > Details</b> </h3>
            <div class="clear"></div>
        
         

        <div class="">
            <h3 class=" text-left text-dark font-weight-bold ">{{form.pro_name}}</h3>
        
         <div  class="section group ">
                
            <div class="cont-desc span_1_of_2">             
                    <div class="grid images_3_of_2 ">
                        <img style="width:220px;height:150px" 
                :src="form.image" alt="" />
                    </div>
                <div class="desc span_3_of_2">
                    <h2 class="text-dark font-weight-bold mb-3"> </h2>
                    <div class="">
                        <p class="">Price: <span class="bg-dark px-4 py-2 text-light font-weight-bold rounded"> ${{form.price}}.00</span></p>

                        <p>Category: <span class="font-weight-bold">{{form.cat_id}}</span></p>
                        <p>Brand:<span class="font-weight-bold"> {{form.brand_id}}</span></p>
                    </div>
                <div class="add-cart">
                
                    <form class="d-inline-block" action="" method="post"> 
                        Quantity: <input type="number" max="10" min="0" class="buyfield" name="quantity" value="1"/>
                        
                        <input type="submit" class="btn btn-info my-2 d-inline" name="add_cart" value="Add To Cart"/> </form>
                        
          
            <a type="button" href="" onclick=";" class="buysubmit my-2 btn btn-warning d-inline" name="savelist" value="">Add To Savelist</a>

                    <form class="d-inline-block" action="" method="post"> 
                        
                        <input type="submit" class="btn btn-warning my-2 d-inline" name="add_cart" value="Add To Savelist"/> 
                
                    </form> 
                    
                </div>
            </div>

            
                
    </div>              
                
            </div>
        
        
        
        
        
        </div>      

        <div class="my-5 w-100">
            <h2 class="bg-light text-center ">Product Description</h2>
               <p class="text-center"> {{form.desc}} </p>
            </div>

        
        
        
        
        
        <!-- Body -->
        
        
    </div> 
   
</template>

<script> 
   
export default {
    
   data: () =>({
    form: new Form({
    pro_name:'',
    desc:'',
    cat_id:'',
    brand_id:'',
    price:'',
    qty:'',
    image:'',
    showImage:null,
    status:0
    })
    
    }),

    methods:{

 showPro(){ console.log('hsdf')
    var id=this.$route.params.id; var t=this;
    axios.get('http://localhost/laravel_projects/Vue_eCommerce/public/details/'+id).then( function(response) {
    t.form.pro_name = response.data.editpro[0].pro_name;
    t.form.desc = response.data.editpro[0].description;
    t.form.cat_id = response.data.cat[0].cat_name;
    t.form.brand_id = response.data.brand[0].brand_name;
    t.form.price = response.data.editpro[0].price;
    t.form.qty = response.data.editpro[0].r_quantity;
    t.form.status = response.data.editpro[0].status;
    t.form.image = response.data.images[0].image_name;
    console.log(response.data);
    });
    
    }
  },
  

     mounted() { 
     this.showPro();
    
      }

    

     

    }
</script>
