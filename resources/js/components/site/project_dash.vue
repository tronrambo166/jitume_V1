<template>
        <div class="main">
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
          
      <a v-else data-target="#loginModal" data-toggle="modal" style="background: rgb(175 173 173 / 23%);" class=" text-dark d-inline px-3 py-2 d-inline-block text-center" ><b>Sign In</b></a>

       </li>
                                    
    </ul>
        
        </div> 

       <div class="col-sm-1"> </div>

    </div> 
           

 <div class="root py-5 mb-5 ml-4">
     <div class="progressbar-wrapper">
      <ul class="progressbar">
        
        <li v-for="( result, index ) in results" :class="result.status=='In Progress' || result.status=='Done'?'active':'' " > Step </li>
          
      </ul>
</div>
  </div>



    <!--  Layout -->

        <div v-for="result in results" class="w-75 m-auto row mt-4 text-center">

                <!--Active Download form -->
         <div v-if="result.status=='In Progress'" class="modal-body">
        <form action="milestoneStripe"  method="get" enctype="multipart/form-data" class="vueform form-group form">
                                
                                

                                <div class="row pt-2" width="85%">
                                    <div class="col-sm-3 px-1">
                                        <div class=" ">
                                            <input readonly required="" name="title" type="text" v-model="result.title"   class="placeH w-100 rounded border border-dark ">
                                        </div>
                                    </div>


                                    <div class="col-sm-2 px-0 ">
                                        <div class="">
                                         
                                            <input readonly required=""  type="number"v-model="result.amount"   name="amount" class="placeH w-100 rounded border border-dark " >
                                        </div>
                                    </div>

                                <div class="col-sm-3 px-1">
                                <div class="upload-btn-wrapper w-100">
                                  <a @click="download_milestone_doc()" class="text-white  placeH btnUp3 w-100">Download Milestone Documentaion <i class="ml-2 fa fa-arrow-down"></i></a>
                                  
                                </div>
                                    </div>


                                    <div class="col-1 px-1">
                                        <div class="form-group">
                                        <button type="submit" class="text-center border border-dark p-0 btn btn-light btn-block" >PAY</button>                                    </div>
                                </div>

                                <input type="number" hidden="" name="lisitng_id" v-model="form.id">
                                <input type="number" hidden name="milestone_id" v-model="result.id">

                                <div class="col-2 px-1">
                                        <div class="form-group">
                                        <span  class="text-center border border-dark p-0 btn btn-success btn-block" >In Progress</span>                                    </div>
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
                                            <input readonly required="" name="title" type="text" v-model="result.title"   class="placeH_inactive w-100 rounded border border-dark ">
                                        </div>
                                    </div>


                                    <div class="col-sm-2 px-0 ">
                                        <div class="">
                                         
                                            <input readonly required=""  type="number"v-model="result.amount"  name="amount" class="placeH_inactive w-100 rounded border border-dark " >
                                        </div>
                                    </div>

                                <div class="col-sm-3 px-1">
                                <div class="upload-btn-wrapper w-100">
                                  <a class="text-white disabled placeH_inactive btnUp4 w-100">Download Milestone Documentaion <i class="ml-2 fa fa-arrow-down"></i></a>
                                  
                                </div>
                                    </div>


                                    <div class="col-1 px-1">
                                        <div class="form-group">
                                        <a disabled class="text-center border border-dark p-0 btn btn-light btn-block" >PAY</a>                                    </div>
                                </div>

                                <div class="col-2 px-1">
                                        <div class="form-group">
                                        <span  class="text-center border border-dark p-0 btn btn-light btn-block" >Done!</span>                                    </div>
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
                                            <input readonly required="" name="title" type="text" v-model="result.title"   class="placeH_inactive w-100 rounded border border-dark ">
                                        </div>
                                    </div>


                                    <div class="col-sm-2 px-0 ">
                                        <div class="">
                                         
                                            <input readonly required=""  type="number"v-model="result.amount"  name="amount" class="placeH_inactive w-100 rounded border border-dark " >
                                        </div>
                                    </div>

                                <div class="col-sm-3 px-1">
                                <div class="upload-btn-wrapper w-100">
                                  <a class="text-white disabled placeH_inactive btnUp4 w-100">Download Milestone Documentaion <i class="ml-2 fa fa-arrow-down"></i></a>
                                  
                                </div>
                                    </div>


                                    <div class="col-1 px-1">
                                        <div class="form-group">
                                        <a disabled class="text-center border border-dark p-0 btn btn-light btn-block" >PAY</a>                                    </div>
                                </div>

                                <div class="col-2 px-1">
                                        <div class="form-group">
                                        <span  class="text-center border border-dark p-0 btn btn-light btn-block" >On Hold</span>                                    </div>
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
            sessionStorage.setItem('invest',id);
        },

    download_milestone_doc(){
    var id=this.$route.params.id; var t=this;
    axios.get('download_milestoneDoc/'+id).then( (data) =>{console.log(data);
    
    });
        }


},

 mounted() { 
     this.getMilestones();
    
      }


}

</script>
