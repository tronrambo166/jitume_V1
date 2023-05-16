<template>
        <div class="main">
        <div class="container">



             <div class="w-75 m-auto row my-4 text-center">
                <div class="col-sm-12">
                    <h4 class="font-weight-bold text-center pt-2">Let's get you started!</h4>
                    <h6>All plans start with a 7 days free trial.</h6>
                </div>

                 <div class="col-sm-12 my-3">
                    <input @change="type($event);" style="font-size:20px;" name="type" type="radio"  value="M" id="month"> <span class="mr-3">Monthly</span>
                     <input @change="type($event);" name="type" type="radio" value="Y" id="year">
                     <span class="">Annualy (Save 20%)</span> 
                </div>
     

            </div>


            <div class="w-75 m-auto row border border-dark my-4">
                <div class="col-sm-4 ">
                    <h5 class="text-center pt-2">Silver</h5>
                </div>

                <div class="col-sm-4 ">
                    <h5 class="text-center pt-2">Gold</h5>
                </div>

                <div class="col-sm-4">
                    <h5 class="text-center pt-2">Platinum</h5>
                </div>

            </div>


            <div id="monthly" class="row w-75 mx-auto">
                <div class="col-sm-4">
                    <div class=" card"  @click="select(9.99)" id="one" >
                        <p class="text-center font-weight-bold h5 pt-2">$9.99</p>
                    <p class="text-center">10 free "Start conversations" per month from any range.</p>
                </div> </div>

                <div class="col-sm-4 "    >
                    <div class=" card" @click="select(29.99)" id="two">
                        <p class="text-center font-weight-bold h5 pt-2">$29.99</p>
                    <p class="text-center">Silver + access to all data from one chosen range.</p>
                </div> </div>

                <div class="col-sm-4 "  >
                    <div class=" card"  @click="select(69.99)" id="three">
                        <p class="text-center font-weight-bold h5 pt-2">$69.99</p>
                    <p class="text-center">Sivler access + Gold access to all data.</p>
                </div> </div>

            </div>



            <div id="yearly" class=" row w-75 mx-auto mb-5" style="display:none;">
                <div class="col-sm-4">
                    <div class=" card"  @click="select(95.99)" id="four" >
                        <p class="text-center font-weight-bold h5 pt-2">$95.99</p>
                    <p class="text-center">10 free "Start conversations" per month from any range.</p>
                </div> </div>

                <div class="col-sm-4 ">
                    <div class=" card" @click="select(287.99)" id="five" >
                        <p class="text-center font-weight-bold h5 pt-2">$287.99</p>
                    <p class="text-center">Silver + access to all data from one chosen range.</p>
                </div> </div>

                <div class="col-sm-4 ">
                    <div class=" card" @click="select(671.99)" id="six" >
                        <p class="text-center font-weight-bold h5 pt-2">$671.99</p>
                    <p class="text-center">Sivler access + Gold access to all data.</p>
                </div> </div>

            </div>


            <div class="row w-50 mx-auto  my-4">
                
                <div class="w-50">
                     <h4>Turnover ranges:</h4>
                        <p class="font-weight-bold my-1"> <span class="font-weight-bold">-</span> $0-$10000</p>
                        <p class="font-weight-bold my-1"> <span class="font-weight-bold">-</span> $10000-$100000</p>                    
                        <p class="font-weight-bold my-1"> <span class="font-weight-bold">-</span> $100000-$25000</p>
                        <p class="font-weight-bold my-1"> <span class="font-weight-bold">-</span> $250000-$50000</p>
                        <p class="font-weight-bold my-1"> <span class="font-weight-bold">-</span> $500000+</p>   
                </div>

                <div class="w-50">
                <form action="stripe" method="get" class="float-right mt-5">
                    <input type="text" hidden id="package" name="package" value="">
                 <input type="text" hidden id="price" name="price" value="">
                  <input type="number" hidden id="listing_id" name="listing_id" value="">
         
         <button v-if="form.select" @click="make_session(form.id);" type="submit" class="btn btn-primary px-3 font-weight-bold" >
          Checkout
        </button>

        <button v-else onclick="alert('Please select a package!');" type="button" class="btn btn-primary px-3 font-weight-bold" >
          Checkout
        </button>

            </form>
                </div>

                </div>


               
                


       
        </div>
    </div>
</template>

<script>

    export default {
    props: ['auth_user'],    
    data: () => ({
    form: new Form({
        id:'',
        select:false
    }),
    empty:false
    }),

    created(){
         var id=this.$route.params.id;
         let t=this;
         t.form.id = id;
         document.getElementById('listing_id').value = id;

    },
    methods:{
    type(event){
        if(event.target.value == 'M'){
        $('#monthly').show();
        $('#yearly').hide();
    }
    else {
        $('#monthly').hide();
        $('#yearly').show();
    }

    },
    select(event){ 
    this.form.select = true;

    if(event == '9.99'){
        var pacage = 'silver-month';
    $('#one').css('background','#e0edd8');
    $('#two').css('background','');
    $('#three').css('background','');
  }

   if(event == '29.99'){
    var pacage = 'gold-month';
    $('#two').css('background','#e0edd8');
    $('#one').css('background','');
    $('#three').css('background','');
  }

   if(event == '69.99'){
    var pacage = 'platinum-month';
    $('#three').css('background','#e0edd8');
    $('#two').css('background','');
    $('#one').css('background','');
  }

   if(event == '95.99'){
    var pacage = 'silver-year';
    $('#four').css('background','#e0edd8');
    $('#five').css('background','');
    $('#six').css('background','');
  }

  if(event == '287.99'){
    var pacage = 'gold-year';
    $('#five').css('background','#e0edd8');
    $('#four').css('background','');
    $('#six').css('background','');
  }

  if(event == '671.99'){
    var pacage = 'platinum-year';
    $('#six').css('background','#e0edd8');
    $('#five').css('background','');
    $('#four').css('background','');
  }
    document.getElementById('price').value = event;
    document.getElementById('listing_id').value = this.form.id;
    document.getElementById('package').value = pacage;
},
 make_session(id){
            sessionStorage.setItem('invest',id);
        },


}

}

</script>
