@extends('business.layout')

@section('page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container" id="" style="background:white;">
        
        
        <div class="row pt-4  m-auto">

            
     <table class="eq table table-bordered " id="">
    <thead>
        <tr>
            <th>Name </th>
            <th>Category </th>
            <th>Value Needed</th>
            <th>Details </th>  
            <th>Contact </th> 
            <th>Share Nemaining </th> 
            <th>Image </th> 
            <th width="20%" class="text-center">Action</th>        
        </tr>

    </thead>
    

    
    <tbody>
        @foreach($milestones as $ev)
        <tr >
            <td>{{$ev->name }}</td>
                <td>{{$ev->category }}</td>
                    <td>{{$ev->investment_needed }}</td>
                        <td>{{$ev->details }}</td>
                        <td>{{$ev->contact }}</td>
                        <td>{{$ev->share }}</td>
                        <td><img width="100px" height="60px" src="../{{$ev->image}}"></td>
   
            <td class="text-center">
            <button data-target="#add{{$ev->id}}" data-toggle="modal" style="cursor:pointer;" id="invest" class="rounded text-light buttonEq2 my-1"><i class="fa fa-plus"></i>Resource</button>

            <button data-target="#edit{{$ev->id}}" data-toggle="modal" style="cursor:pointer;" id="invest" class="rounded text-light buttonEq2 my-1">Edit</button>
                
            <button class="rounded text-danger buttonEq2 my-1">Delete</button>
            

            </td>
        </tr>



<!-- ADD MODAL -->
  <div  class="modal fade" id="add{{$ev->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <div class="card-header w-100">
           <h3>Add Equipment</h3>
        </div>       

        <button type="button" class="m-0 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
    
      <div class="modal-body">
        <form action="{{route('add_eqp')}}"  method="post" enctype="multipart/form-data">
                                @csrf
                                        <input  name="id" type="number" hidden value="{{$ev->id}}" class="form-control">

                                <div class="row ">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input required="" name="eq_name" type="text"  class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Value</label>
                                            <input required=""  type="text" name="value"  class="form-control" >
                                        </div>
                                    </div>



                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input required=""  type="number" name="amount" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label>Details</label>
                                            <input required=""  type="text" name="details"class="form-control" >
                                        </div>
                                    </div>
                           
                                </div>
                                <input type="submit" class="my-4 btn btn-primary btn-block" value="Save" />
                            </form>

    </div>
    </div>
    </div>
    </div>
      <!-- ADD MODAL -->


      <!-- Edit MODAL -->
  <div  class="modal fade" id="edit{{$ev->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <div class="card-header w-100">
           <h3>Edit</h3>
        </div>       

        <button type="button" class="m-0 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
    
      <div class="modal-body">
      <form action="{{route('up_listing')}}"  method="post" enctype="multipart/form-data">
            @csrf   
               <input  name="id" type="number" hidden value="{{$ev->id}}" class="form-control">

                <div class="row form-group">
                    
                    <div class="col-sm-6"> 
                        <div class="row">
                        
                    <div class="col-sm-12"> 
                    <input required=""  class=" form-control border border-none rounded form-group" type="text" name="title" id="title" value="{{$ev->name}}"  /> 
                    </div>
                        </div>
                    </div>

                    <div class="col-sm-6"> 
                        <div class="row">
                            
                    
                    <div class="col-sm-12"> 
                    <input required="" type="text" class="form-control" value="{{$ev->contact}}" name="contact" value="">                     
                    </div>
                        </div>
                    </div>
                    
                </div>


                   <div class="row form-group"> 
                        <div class="row">
                                        
           <div class="col-sm-6">
           <select hidden name="category" class="border-none form-control">
           <option class="form-control" >Select Category</option>
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

                 <div class="col-sm-6"> 
                    <textarea rows="1" required=""  class=" form-control border border-none rounded form-group"  name="details" id="title"  > {{$ev->details}}</textarea>
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
                      <input type="file" name="image" />
                    </div>
                    </div>

                    <div class="col-sm-6"> 
                    <input id="searchbox" required="" onkeyup="suggest(this.value);" style="height: 42px;" class=" form-control d-inline" type="text" name="location" value="{{$ev->location}}">
                    </div>

                         <div class="row" style="">
                                <div id="result_list" class="" style="display: none;left: 340px;width:41%; z-index: 1000;height: 600px;position: absolute;">
                                    
                                </div>
                            </div>

                        </div>
                    </div> 
                </div>

                <div class="row form-group">
                    
                    <div class="col-sm-6"> 
                        <div class="row">
                    
                    <div class="col-sm-12"> 
                    <input required=""  class=" form-control border border-none rounded form-group" type="number" name="investment_needed" id="title" value="{{$ev->investment_needed}}"  /> 
                    </div>
                        </div>
                    </div>

                    <div class="col-sm-6"> 
                        <div class="row">
                           
                    
                    <div class="col-sm-12"> 
                    <input required="" max="100" type="number" class="form-control" value="{{$ev->share}}" name="share" value="">                     
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
    </div>
      <!-- Edit MODAL -->


         @endforeach
         @if(count($milestones)==0))
         <td  > No data found! </td>
         @endif
    
    </tbody> 
    
    
</table>
               

                </div>

                </div>

               

            </div>


            <div class="clear"></div>
            <div class="clearfix py-5"></div>

        </div>


@endsection



