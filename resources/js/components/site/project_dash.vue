<template>
        <div class="main">
        <div class="container">

           

 <div class="root py-5 mb-5 ml-4">
     <div class="progressbar-wrapper">
      <ul class="progressbar">
        
        <li v-for="( result, index ) in results" :class="result.status=='In Progress' || result.status=='Done'?'active':'' " > Step </li>
          
      </ul>
</div>
  </div>


        <div v-for="result in results" class="w-75 m-auto row mt-4 text-center">

                <!--Active Download form -->
         <div v-if="result.status=='In Progress'" class="modal-body">
        <form action="milestoneStripe"  method="get" enctype="multipart/form-data" class="vueform form-group form">
                                
                                

                                <div class="row pt-2" width="90%">
                                    <div class="col-sm-2 px-1">
                                        <div class=" ">
                                            <input readonly required="" name="title" type="text" v-model="result.title"   class="placeH placeH_active w-100 py-1 border border-dark ">
                                        </div>
                                    </div>


                                    <div class="col-sm-2 px-0 ">
                                        <div class="">
                                         
                                            <input readonly required=""  type="number"v-model="result.amount"   name="amount" class="placeH placeH_active w-100 py-1 border border-dark " >
                                        </div>
                                    </div>

                                <div class="col-sm-3 px-1">
                                <div class="upload-btn-wrapper w-100">
                                  <a @click="download_milestone_doc(result.id)" class="text-white  placeH btnUp3 w-100">Download Milestone Documentaion <i class="ml-2 fa fa-arrow-down"></i></a>
                                  
                                </div>
                                    </div>


                                    <div v-if="result.access && result.time_left != 'L A T E !'" class="col-1 px-1">
                                        <div class="form-group">

                                        <button @click="make_session(form.id);" type="submit" class="placeH_active text-center border border-dark px-2 py-1 btn btn-light btn-block" >PAY</button>                                    </div>
                                </div>

                                <input type="number" hidden="" name="lisitng_id" v-model="form.id">
                                <input type="number" hidden name="milestone_id" v-model="result.id">

                                <div class="col-1 px-1">
                                        <div class="form-group">
                                        <span  class="placeH_active status text-center border border-dark px-0 py-1 btn btn-success btn-block" >In Progress</span>                                    </div>
                                </div>

                                <div class="col-sm-3 px-1">
                                        <div class=" border border-dark px-2 d-inline-block">
                                            <p style="font-size:12px;" class="placeH_active text-success due small d-inline">Due in: </p>

                                            <p v-if="result.time_left == 'L A T E !' " style="color:red;" class="placeH_active due d-inline"> {{result.time_left}} </p>
                                            <p v-else class="placeH_active small due d-inline">{{result.time_left}}</p>
                                        </div>
                                    </div>


                           
                                </div>
                                
                            </form>

    </div>

    <!--Active Download form -->



<!--Done Download form -->
         <div v-else-if="result.status=='Done'" class="modal-body">
        <form action=""  method="post" enctype="multipart/form-data" class="vueform form-group form">
                                
                                

                                <div class="row pt-2" width="85%">
                                    <div class="col-sm-3 px-1">
                                        <div class=" ">
                                            <input readonly required="" name="title" type="text" v-model="result.title"   class="placeH_done placeH_active w-100 py-1 border border-dark">
                                        </div>
                                    </div>


                                    <div class="col-sm-2 px-0 ">
                                        <div class="">
                                         
                                            <input readonly required=""  type="number"v-model="result.amount"  name="amount" class="placeH_done placeH_active w-100 py-1 border border-dark " >
                                        </div>
                                    </div>

                                <div class="col-sm-3 px-1">
                                <div class="upload-btn-wrapper w-100">
                                  <a class="text-white disabled placeH_done btnUp_done w-100">Download Milestone Documentaion <i class="ml-2 fa fa-arrow-down"></i></a>
                                  
                                </div>
                                    </div>


                                    <div class="col-1 px-1">
                                        <div class="form-group">
                                        <a disabled class="placeH_active text-center border border-dark px-2 py-1 btn btn-light btn-block" >PAID</a>                                    </div>
                                </div>

                                <div class="col-1 px-1">
                                        <div class="form-group">
                                        <span style="background:black;" class="placeH_active status text-center border text-light border-dark px-2 py-1 btn-block" >Done!</span>                                    </div>
                                </div>

                           
                                </div>
                                
                            </form>

    </div>


<!-- Done Layout -->




        <!--IN Active Download form -->
         <div v-else class="modal-body">
        <form action=""  method="post" enctype="multipart/form-data" class="vueform form-group form">
                                
                                

                                <div class="row pt-2" width="85%">
                                    <div class="col-sm-3 px-1">
                                        <div class=" ">
                                            <input readonly required="" name="title" type="text" v-model="result.title"   class="placeH_inactive w-100 py-1 border border-dark ">
                                        </div>
                                    </div>


                                    <div class="col-sm-2 px-0 ">
                                        <div class="">
                                         
                                            <input readonly required=""  type="number"v-model="result.amount"  name="amount" class="placeH_inactive w-100 py-1 border border-dark " >
                                        </div>
                                    </div>

                                <div class="col-sm-3 px-1">
                                <div class="upload-btn-wrapper w-100">
                                  <a class="pl-4 disabled placeH_inactive btnUp4 w-100">Download Milestone Documentaion <i class="ml-2 fa fa-arrow-down"></i></a>
                                  
                                </div>
                                    </div>

                                <div class="col-1 px-1">
                                        <div class="form-group">
                                        <span  class="status text-center border border-dark px-2 py-1 btn-light placeH_inactive btn-block" >To Do</span>                                    </div>
                                </div>

                           
                                </div>
                                
                            </form>

    </div>


<!-- IN Active Layout -->



               
                


       
        </div>
    </div>
    </div>
</template>

<script>

    export default {
    props: ['auth_user'],    
    data: () => ({
    form: new Form({
        id:''
    }),
    results:[],
    status:false
    }),

    created(){
    if(sessionStorage.getItem('milestone')!=null)
    sessionStorage.clear();

         var id=this.$route.params.id;
         let t=this;
         t.form.id = id;
 

    },
methods:{

getMilestones:function(){ 
    var id=this.$route.params.id; var t=this;

    axios.get('getMilestones/'+id).then( (data) =>{
        console.log(data);
        t.results = data.data.data;
    
    });
    
    },

 make_session(id){
            sessionStorage.setItem('milestone',id);
        },

    download_milestone_doc(mile_id){
    var id=this.$route.params.id; var t=this;
    axios.get('download_milestoneDoc/'+id+'/'+mile_id).then( (data) =>{console.log(data);
    
    });
        }


},

 mounted() { 
     this.getMilestones();
    
      }


}

</script>