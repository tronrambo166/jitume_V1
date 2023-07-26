@extends('business.layout')

@section('page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container" id="" style="background:white;">
        
        @if(Session::has('success_update'))
        <div class="w-50 m-auto alert font-weight-bold alert-success alert-dismissible fade show" role="alert">
          <p class="font-weight-bold">{{Session::get('success_update')}}   @php Session::forget('success_update'); @endphp </p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>  @endif

<style type="text/css">
    .showFormB input, .showFormB select {
    border-top: 1px solid #7c7c7c;
    border-left: 1px solid #c3c3c3;
    border-right: 1px solid #c3c3c3;
    border-bottom: 1px solid #ddd;
    background: #fff;
    height: 28px;
}

</style>
    
    <form action="" method="post">    
    <div class="row pt-4  m-auto">        
     <table class="eq table table-bordered " id="">
    <thead>
        <tr>
            <th> </th>
            <th>Date </th>
            <th>Investor </th>
            <th>Business</th>
            <th>Type </th>  
            <th>Amount </th> 
            <th>Representaion % </th>        
        </tr>

    </thead>
    

    
    <tbody>
        @foreach($bids as $ev)
        <tr >
            <td><input type="checkbox" name="bid_ids[]" value="{{$ev->id}}"></td>
            <td>{{$ev->date }}</td>
                <td>{{$ev->investor }}</td>
                    <td>{{$ev->business }}</td>
                        <td>{{$ev->type }}</td>
                        <td>{{$ev->amount }}</td>
                        <td>{{$ev->representation }}</td>
   
        </tr>


         @endforeach
         @if(count($bids)==0)
         <td  > No data found! </td>
         @endif
    
    </tbody> 
    
    
</table>
               
<div class=" ml-auto">
    <button type="submit" class="float-right font-weight-bold btn-success w-25 mx-auto">Accept</button>
</div>

</div>
</form>


                </div>

                


@endsection



