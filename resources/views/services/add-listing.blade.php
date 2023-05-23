@extends('services.layout')

@section('page')
    <div class="container" id="">
        
         @if(Session::has('success'))
        <div class="w-50 m-auto alert font-weight-bold text-danger alert-warning alert-dismissible fade show" role="alert">
          <p class="font-weight-bold">{{Session::get('success')}}   @php Session::forget('success'); @endphp </p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>  @endif

        @if(Session::has('error'))
        <div class="w-50 m-auto alert font-weight-bold text-danger alert-warning alert-dismissible fade show" role="alert">
          <p class="font-weight-bold">{{Session::get('error')}}   @php Session::forget('error'); @endphp </p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>  @endif

        
        <div class="row pt-4 w-75 m-auto">
           
                <div class="col-sm-12">
                  

            <form action="{{route('create-service')}}"  method="post" enctype="multipart/form-data">
            @csrf   
               
                <div class="row form-group">
                    
                    <div class="col-sm-6"> 
                        <div class="row">
                        
                    <div class="col-sm-12">
                    <input required=""  class=" form-control border border-none rounded form-group" type="text" name="title" id="title" placeholder="Service Title"  /> 
                    </div>
                        </div>
                    </div>

                    <div class="col-sm-6"> 
                        <div class="row">
                            
                    
                    <div class="col-sm-12"> 
                    <input required="" type="number" class="form-control" placeholder="Price" name="price" value="">                     
                    </div>
                        </div>
                    </div>
                    
                </div>


            <div class="row form-group"> 
                                        
            <div class="col-sm-6">
            <select name="category" class="border-none form-control"><option hidden="hidden" class="form-control">Services</option> <option value="Business Planning" class="form-control">Business Planning</option> <option value="IT">IT</option> <option value="Legal Project Management">Legal Project Management</option> <option value="Branding and Design">Branding and Design </option> <option value="Auto">Auto</option> <option value="Finance, Accounting &amp; 
                Tax Marketing">Finance, Accounting &amp; 
                Tax Marketing</option> <option value="Tax Marketing">Tax Marketing</option> <option value="Public Relations">Public Relations</option> <option value="Other">Other</option></select>
  </div>

                 <div class="col-sm-6"> 
                    <textarea class="form-control" required="" name="details" rows="1" cols="30" placeholder="Details"></textarea>
                    </div>
                       
                    </div>

                   <div class="row my-3 row form-group">

                    <div class="col-sm-12"> 
                        <div class="row">
                           <div class="col-sm-2"><label class="h4" for="name">
                                <strong>Cover</strong></label>
                               </div>
                    
                    <div class="col-sm-4"> 
                    <div class="upload-btn-wrapper">
                      <button class="btnUp2">Upload <i class="ml-2 fa fa-arrow-up"></i></button>
                      <input required="" type="file" name="image" />
                    </div>
                    </div>

                    <div class="col-sm-6"> 
                    <input id="searchbox" required="" onkeyup="suggest(this.value);" style="height: 32px;" class=" form-control d-inline" type="text" name="location" value="" placeholder="Enter a location...">
                    </div>

                         <div class="row" style="">
                                <div id="result_list" class="" style="display: none;left: 340px;width:41%; z-index: 1000;height: 600px;position: absolute;">
                                    
                                </div>
                            </div>

                        </div>
                    </div> 
                </div>

                
 <div class="row my-5 row form-group">

                    <div class="col-sm-12"> 
                        <div class="row">
                           <div class="col-sm-12"><label class="h5" for="name">
                                <p>Upload mandatory documents below to feature on the platform</p></label>
                               </div>
                               </div> 
                               </div>
                    
                    <div class="col-sm-5"> 

                    <div class="upload-btn-wrapper">
                      <button class="btnUp_listing"> Upload Company/Individual Pin *
                      <img src="../images/up.svg" width="30px"> </button>
                      <input required="" type="file" name="pin" />
                    </div>

                    </div>


                    <div class="col-sm-7"> 

                    <div class="upload-btn-wrapper">
                      <button class="btnUp_listing"> Upload Directors Identification(Id/Passport)*
                      <img src="../images/up.svg" width="30px"> </button>
                      <input required="" type="file" name="identification" />
                    </div>

                    </div>


                </div>



        <div class="row my-4 form-group">

            <div class="col-sm-12 mx-auto"> 

                    <div class="upload-btn-wrapper w-75  d-block">
                      <button class="btnUp_listing w-100"> Upload Supporting Business Documentation*
                      <img src="../images/up.svg" width="30px"> </button>
                      <input required="" type="file" name="document" />
                    </div>

                    </div>


                    <div class="col-sm-12 mt-3"> 

                    <div class="upload-btn-wrapper w-75  d-block">
                      <button class="btnUp_listing bg-info w-100"> Upload supportive video*
                      <img src="../images/up.svg" width="30px"> </button>
                      <input type="file" name="video" />
                    </div>

                    </div>

            <div class="col-sm-12 w-75  d-block"> <span class="my-3 d-block font-weight-bold text-center m-auto"> OR </span>

          
           <input class="w-100 d-blocks d-inline form-control" placeholder="Embed video link" name="link" /> 

        </div>
          </div>




                <div class="row my-5"> 
                    <button style="width: 40%;background:green;border-radius: 2px;" class="m-auto btn text-white font-weight-bold">SAVE</button></div>


            </form>


                    </div>
                  
                    
                </div>
                

            </div>


            <div class="clear"></div>

  <script type="text/javascript">
  
    function bookForm(shift) {
      $('#choose').hide();
      $('#booking').show();
    }

    function paid_price() {
      $('#paid_price').show();  
    }
     function free_price() {
      $('#paid_price').hide(); 
    }
  </script>

@endsection



