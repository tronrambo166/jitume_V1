@extends('services.layout')

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
                
            <button class="rounded text-danger buttonEq2 my-1">Delete</button>
            

            </td>
        </tr>




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
      <form action="{{route('up_service')}}"  method="post" enctype="multipart/form-data">
            @csrf   
               <input  name="id" type="number" hidden value="{{$ev->id}}" class="form-control">

               <input  name="old_img" type="text" hidden value="{{$ev->image}}" class="form-control">

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
                    <input required="" type="number" class="form-control" value="{{$ev->price}}" name="price" value="">                     
                    </div>
                        </div>
                    </div>
                    
                </div>


                   <div class="row form-group"> 
                        <div class="row">
                                        
           <div class="col-sm-6">
           <select name="category" class="border-none form-control"><option hidden="hidden" class="form-control">Services</option> <option value="Business Planning" class="form-control">Business Planning</option> <option value="IT">IT</option> <option value="Legal Project Management">Legal Project Management</option> <option value="Branding and Design">Branding and Design </option> <option value="Auto">Auto</option> <option value="Finance, Accounting &amp; 
                Tax Marketing">Finance, Accounting &amp; 
                Tax Marketing</option> <option value="Tax Marketing">Tax Marketing</option> <option value="Public Relations">Public Relations</option> <option value="Other">Other</option></select>
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

               



                 <div class="row my-4"> 
                    <button style="background:#0eaf5d;" class="w-25 m-3 btn text-white font-weight-bold">SAVE</button></div>


            </form>

    </div>
    </div>
    </div>
    </div>
      <!-- Edit MODAL -->


         @endforeach
         @if(count($listings)==0))
         <td  > No data found! </td>
         @endif
    
    </tbody> 
    
    
</table>
               

                </div>

                </div>

                <div style="background:aliceblue;" class="col-sm-5"><p class="mx-auto my-5 py-5 font-weight-bold text-center">MAP Loading...</p></div>

            </div>


            <div class="clear"></div>
            <div class="clearfix py-5"></div>

        </div>


@endsection



