@extends('business.layout')

@section('page')
    <div class="container" id="">
        
        <h3 class="text-center font-weight-bold bg-light"><b class="h5 text-success" > {{ Session:: get('success') }}</b> </h3>
        <div class="row pt-4 w-75 m-auto">
           
                <div class="col-sm-12">
                  

            <form action="{{route('create-listing')}}"  method="post" enctype="multipart/form-data">
            @csrf   
               
                <div class="row form-group">
                    
                    <div class="col-sm-6"> 
                        <div class="row">
                        
                    <div class="col-sm-12"> 
                    <input required=""  class=" form-control border border-none rounded form-group" type="text" name="title" id="title" placeholder="Business Title"  /> 
                    </div>
                        </div>
                    </div>

                    <div class="col-sm-6"> 
                        <div class="row">
                            
                    
                    <div class="col-sm-12"> 
                    <input required="" type="text" class="form-control" placeholder="Contact/Phone" name="contact" value="">                     
                    </div>
                        </div>
                    </div>
                    
                </div>


                   <div class="row form-group"> 
                        <div class="row">
                                        
            <div class="col-sm-4">
            <select  name="category" class="border-none form-control">
            <option hidden class="form-control" >Select Category</option>

            <option class="form-control" value="Agriculture" >Agriculture</option>
           <option value="Sports/Gaming" >Sports/Gaming</option>
           <option value="Real State" >Real State</option>
           <option value="Entertainment" >Entertainment </option>
           <option value="Auto" >Auto</option>
           <option value="Finance/Accounting Security" >Finance/Accounting Security</option>
           <option value="Domestic Help">Pets</option>
           <option value="Domestic Help">Domestic Help</option>
           <option value="Other" >Other</option> 

           </select>
  </div>

                 <div class="col-sm-4"> 
                    <textarea rows="1" required=""  class=" form-control border border-none rounded form-group"  name="details" id="title"  > Details... </textarea>
                    </div>

                     <div class="col-sm-4"> 
                    <select required name="y_turnover" class="form-control">
                        <option hidden >Choose Yearly Turnover</option>

                        <option value="0-10000">$0-$10000</option>
                        <option value="10000-100000">$10000-$100000</option>
                        <option value="100000-250000">$100000-$250000</option>
                        <option value="250000-500000">$250000-$500000</option>
                        <option value="500000-">$500000+</option>
                    </select>
                    </div>

            
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
                    <input id="searchbox" required="" onkeyup="suggest(this.value);" style="height: 42px;" class=" form-control d-inline" type="text" name="location" value="" placeholder="Enter a location...">
                    </div>

                         <div class="row" style="">
                                <div id="result_list" class="" style="display: none;left: 340px;width:41%; z-index: 1000;height: 600px;position: absolute;">
                                    
                                </div>
                            </div>

                        </div>
                    </div> 
                </div>

                <div class="row form-group">
                    
                    <div class="col-sm-4"> 
                        <div class="row">
                    
                    <div class="col-sm-12"> 
                    <input required=""  class=" form-control border border-none rounded form-group" type="number" name="investment_needed" id="title" placeholder="Investment Needed"  /> 
                    </div>
                        </div>
                    </div>

                    <div class="col-sm-4"> 
                        <div class="row">
                           
                    
                    <div class="col-sm-12"> 
                    <input required="" max="100" type="number" class="form-control" placeholder="Share (ex:0-100)" name="share" value="">                     
                    </div>
                        </div>
                    </div>

                    <div class="col-sm-4 "> 
                        <div class="row px-0">
                           
                    
                    <div class="col-sm-12 px-0"> 
                    <input type="text" class="form-control" placeholder="Contact mail (optional)" name="contact_mail" value="">                     
                    </div>
                        </div>
                    </div>
                    
                </div>



                 <div class="row my-4"> 
                    <button style="background:#0eaf5d;" class="w-25 m-3 btn text-white font-weight-bold">SAVE</button></div>


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



