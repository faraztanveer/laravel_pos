@extends('admin.layouts.admin_master')
@section('body')
@include('alert::message')
@include('admin.layouts.product_section')
@endsection

@section('active-product', 'active')
@section('script')

 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
   
@endsection



@section('head_links')

<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    
<script >
	var table;
$(function() {
	//console.log('thiss');
 table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('get.products')}}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'productName', name: 'productName' },
            { data: 'basePrice', name: 'basePrice' },
            { data: 'currentPrice', name: 'currentPrice ' },
            { data: 'catName', name: 'catName' },
            { data: 'brandName', name: 'brandName' },
            { data: 'availability', name: 'availability' },
            { data: 'quantity', name: 'quantity' },
            { data: 'photo', name: 'photo' },
            { data: 'action', name: 'action' }
            
            
        ]
    });
});



function deleteProduct(id)
{
    swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result) {

$.ajax({
                url: 'product/delete/'+id,
                success: function (status) 
                {
                   if(status)
                    {
                        swal(
      'Deleted!',
      'product has been deleted.',
      'success'
    );
                    table.ajax.reload();
}
                }
 });

   
  }
});

 


}

function showProduct(id){




$.ajax({
                url: 'product/show/'+id,
                success: function (data) 
                {

                  console.log(data.product.name);  
                }
}
);



}



</script>


    @endsection