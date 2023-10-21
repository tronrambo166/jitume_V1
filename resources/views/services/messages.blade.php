@extends('business.layout')

@section('page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container px-0" id="">
        
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
    
 <form action="" method="post">  @csrf  
    <div class="row m-auto">   
    <h4 class="bid_header my-0 text-left pb-3 py-2 font-weight-bold">Messages</h4>     
     <table class="eq table table-bordered " id="">
    <thead class="table_head">
        <tr>

            <th class="ml-1">From </th>
            <th class="ml-1">Related Service </th>
            <th class="ml-1">Message</th> 
            <th class="ml-1">Time</th>        
        </tr>

    </thead>
    

    
    <tbody>
        @foreach($results as $ev)
        <tr onclick="bg_change({{$ev->id}});" id="{{$ev->id}}" >
           <!--  <td><input onchange="check();" type="checkbox" name="bid_ids[]" value="{{$ev->id}}"></td> -->

                <td>
                {{$ev->sender }}
                </td>

                    <td>{{$ev->service }}</td>
                    <td>{{$ev->msg }}</td>
                    <td>{{date('d M, h:ia',strtotime($ev->created_at)) }}</td>
   
        </tr>



<!-- Table temp end -->

         @endforeach
         @if(count($results)==0)
         <td  > No data found! </td>
         @endif
    
    </tbody> 
    
    
</table>
 
<!--  <div class="row ml-auto" style="width:35%;"> 
 <div class="col-sm-6 float-right"> </div>             
<div class="col-sm-6 float-right">
    <a id="fakeBtn" onclick="accept();" type="submit" class="bid-accept text-center float-right border border-dark font-weight-bold btn text-mute py-1 w-100 mx-auto">Confirm</a>

    <button style="background:green;" id="realBtn" type="submit" class="bid-accept collapse float-right font-weight-bold btn text-light w-100 mx-auto">Confirm</button>
</div>
</div> -->

</div>
</form>


</div>


<script type="text/javascript">
  function accept() {
            alert('Please select a booking!');
    }

    function check() {
    var checked  = '';
    [...document.querySelectorAll('input[name="bid_ids[]"]:checked')]
   .forEach((cb) => checked = checked+cb.value+',');

        var ids = checked;
        if(ids != '')
        {
        $('#fakeBtn').hide();
        $('#fakeBtnR').hide();
        $('#realBtn').show();
        $('#realBtnR').show();   
        }
        else{
        $('#fakeBtn').show();
        $('#fakeBtnR').show();
        $('#realBtn').hide();
        $('#realBtnR').hide();
        }
    }
</script>
                


@endsection



