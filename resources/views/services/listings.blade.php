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
            <th>Price </th>  
            <th>Details </th> 
            <th>Location </th> 
            <th>Image </th> 
            <th width="20%" class="text-center">Action</th>        
        </tr>

    </thead>
    

    
    <tbody>
        @foreach($listings as $ev)
        <tr >
            <td>{{$ev->name }}</td>
                <td>{{$ev->category }}</td>
                    <td>{{$ev->price }}</td>
                        <td>{{$ev->details }}</td>
                        <td>{{$ev->location }}</td>
                        <td><img width="100px" height="60px" src="../{{$ev->image}}"></td>
   
            <td class="text-center">

            <button data-target="#edit{{$ev->id}}" data-toggle="modal" style="cursor:pointer;" id="invest" class="rounded text-light buttonEq2 my-1">Edit</button>
                
            <a onclick="return confirm('Are you sure?');" href="{{route('delete_service',$ev->id)}}" class="rounded text-danger buttonEq2 my-1 d-inline-block py-0">Delete</a >
            

            </td>
        </tr>




      <!-- Edit MODAL -->
  <div  class="modal fade" id="edit{{$ev->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:125%;">
      <div class="modal-header">
         <div class="card-header w-100">
           <h3>Edit</h3>
        </div>       

        <button type="button" class="m-0 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
    
      <div class="modal-body">
      <form action="{{route('up_service')}}"  method="post" enctype="multipart/form-data">
            @csrf   
               <input  name="id" type="number" hidden value="{{$ev->id}}" class="form-control">

                <div class="row form-group">
                    
                    <div class="col-sm-6"> 
                        <div class="row">
                        
                    <div class="col-sm-12"> 
                    <label class="labels font-weight-bold">Title</label>
                    <input required=""  class=" form-control border border-none rounded form-group" type="text" name="name" id="name" value="{{$ev->name}}"  /> 
                    </div>
                        </div>
                    </div>

                    <div class="col-sm-6"> 
                        <div class="row">
                            
                    
                    <div class="col-sm-12"> 
                    <label class="labels font-weight-bold">Price</label>
                    <input required="" type="number" class="form-control" value="{{$ev->price}}" name="price" value="">                     
                    </div>
                        </div>
                    </div>
                    
                </div>


                   <div class="row form-group"> 
                        <div class="row">
                                        
           <div class="col-sm-6">
            <label class="labels font-weight-bold">Category</label>
           <select name="category" class="border-none form-control">
             <option value="{{$ev->category}}" selected class="form-control">{{$ev->category}}</option>

            <option value="Business Planning" class="form-control">Business Planning</option> <option value="IT">IT</option> <option value="Legal Project Management">Legal Project Management</option> <option value="Branding and Design">Branding and Design </option> <option value="Auto">Auto</option> <option value="Finance, Accounting &amp; 
                Tax Marketing">Finance, Accounting &amp; 
                Tax Marketing</option> <option value="Tax Marketing">Tax Marketing</option> <option value="Public Relations">Public Relations</option> <option value="Other">Other</option></select>
  </div>

                 <div class="col-sm-6"> 
                    <label class="labels font-weight-bold">Details</label>
                    <textarea rows="1" required=""  class=" form-control border border-none rounded form-group"  name="details" id="title"  > {{$ev->details}}</textarea>
                    </div>

            
 </div>
                       
                    </div>

                   <div class="row my-3 row form-group">

                    <div class="col-sm-12"> 
                        <div class="row">
                           <div class="col-sm-2 mt-3"><label class="h4" for="name">
                                <strong>Cover</strong></label>
                               </div>
                    
                    <div class="col-sm-4 mt-3"> 
                    <div class="upload-btn-wrapper">
                      <button class="btnUp2">Change <i class="ml-2 fa fa-arrow-up"></i></button>
                      <input type="file" name="image" />
                    </div>
                    </div>

                    <div class="col-sm-6"> 
                    <label class="labels font-weight-bold">Location</label>
                    <input id="searchbox" required="" onkeyup="suggest(this.value);" style="height: 42px;" class=" form-control d-inline" type="text" name="location" value="{{$ev->location}}">
                    </div>

                         <div class="row" style="">
                                <div id="result_list" class="" style="display: none;left: 312px;width:49%; z-index: 1000;height: 600px;position: absolute;">
                                    
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
                      <button class="btnUp_listing"> Change Company/Individual Pin *
                      <img src="../images/up.svg" width="30px"> </button>
                      <input type="file" name="pin" />
                    </div>

                    </div>


                    <div class="col-sm-7"> 

                    <div class="upload-btn-wrapper">
                      <button class="btnUp_listing"> Change Directors Identification(Id/Passport)*
                      <img src="../images/up.svg" width="30px"> </button>
                      <input type="file" name="identification" />
                    </div>

                    </div>


                </div>



        <div class="row my-4 form-group">

            <div class="col-sm-12 mx-auto"> 

                    <div class="upload-btn-wrapper w-75  d-block">
                      <button class="btnUp_listing w-100"> Change Supporting Business Documentation*
                      <img src="../images/up.svg" width="30px"> </button>
                      <input  type="file" name="document" />
                    </div>

                    </div>


                    <div class="col-sm-12 mt-3"> 

                    <div class="upload-btn-wrapper w-75  d-block">
                      <button class="btnUp_listing bg-info w-100"> Change supportive video
                      <img src="../images/up.svg" width="30px"> </button>
                      <input  type="file" name="video" />
                    </div>

                    </div>

            <div class="col-sm-12 w-75  d-block"> <span class="my-3 d-block font-weight-bold text-center m-auto"> OR </span>

          <label class="labels font-weight-bold">Video Link</label>
           <input class="w-100 d-blocks d-inline form-control" value="{{$ev->link}}" name="link" /> 

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
         @if(count($listings)==0)
         <td  > No data found! </td>
         @endif
    
    </tbody> 
    
    
</table>
               

                </div>

                </div>


            </div>


            <div class="clear"></div>
          

        </div>


@endsection



