@extends('admin.layouts.admin_master')
@section('body')
<div class="content" id="salesContent">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-9">
              <div class="card border-primary">
                <div class="card-body">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="nc-icon nc-cart-simple"></i>
                      </div>
                    </div>
                    <form  action="#" id="product_submit_form" method="get" >
                    <input type="text" class="form-control awesomplete test"  id="sale-item" placeholder="Enter item name" list="mylist">
                    <datalist id="mylist">
 @foreach($products as $product)
 <option>#{{$product->id}} &nbsp;&nbsp;&nbsp;{{$product->name}}</option>
 @endforeach
</datalist>
<button id="submit-item" class="btn btn-success btn-sm btn-fill">dalo</button>
</form>
                  </div>
                </div>
              </div>

              <div class="card border-info">
                <div class="card-body">

                  <table class="table table-bordered text-center" id="tbUser">


                    <th>Item Name</th>
                    <th style="width: 100px;">Price</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th style="width: 80px;">Qty.</th>
                    <th style="width: 80px;">Disc %</th>
                    <th>Total</th>
                    <th>&nbsp;</th>

                    <tbody id="table_body" class="text-center">


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="card border-success">
                <div class="card-body text-center">
                  <button class="btn btn-warning btn-fill btn-sm" id="suspendSale">
                    <i class="nc-icon nc-button-pause"></i> Suspend</button>

                  <button class="btn btn-danger btn-fill btn-sm" id="cancelSale">
                    <i class="nc-icon nc-simple-remove"></i> Cancel</button>
                  <hr>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="nc-icon nc-single-02">+</i>
                      </div>
                    </div>
                    <input type="text" class="form-control" id="customerName" placeholder="Type Customer Name">
                  </div>
                </div>
              </div>
              <div class="card border-success">
                <div class="card-body">
                  <div class="sub-total">
                    <span>Sub Total:</span>
                    <span class="float-right subTotal">
                      <small>PKR</small>
                    </span>
                  </div>
                  <hr>
                  <div class="amount-div">
                    <table class="table">
                      <th>Total</th>
                      <th>Due</th>
                      <tbody class="text-center">
                        <td>200.00
                          <small>PKR</small>
                        </td>
                        <td style="border:0px;">200.00 </td>
                      </tbody>
                    </table>
                  </div>
                  <button class="submitProducts btn btn-secondary btn-sm btn-fill pull-right" >Submit</button>
                  <input type="checkbox" name="myCheck" id="myCheck">
                  <small class="text-muted">Change Sale Date</small>
                  <br>
                  
                  <input type="date" name="dateField" id="dateField" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <audio id="beep" preload="auto">
      <source src="{{ asset('sound/beep1.mp3') }}"> </source>
    </audio>
@endsection
@section('active-sales', 'active')

@section('script')
<script src="{{ asset('js/core/awesomplete.js')}}"></script>

<script >
  
  var globalTotal=0;
 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
  

function updateSubTotal()
{
  var subTotal=0;
$(".total").each(function(){
   var  total = $(this).val();
     total = parseFloat(total.slice(0,total.indexOf('p')));
    subTotal+=total;
globalTotal=subTotal;
    
    });

$('.subTotal').text(subTotal+" PKR");
// console.log(subTotal);
}

function playBeep()
{

var audio = $("#beep")[0];
     audio.play();

}



function calculateDiscount(total,discount)
{

return (total - ((discount*total)/100));

}
 

$('#product_submit_form').submit(function(event) {
  event.preventDefault();
 var itemName=$('#sale-item').val();
//var itemid= itemName.slice(itemName.indexOf('#')+1,itemName.indexOf(' '));
var itemid = parseInt(itemName.slice(itemName.indexOf('#')+1,itemName.indexOf(' ')));
$('#sale-item').val('');
//console.log($("#p"+itemid).length);

 $.ajax({
                url: 'getItemDetail/'+itemid,
                type: 'get',
                success: function (data) 
                {
      // console.log(data.productControls[0].color);
     // if($("#p"+itemid).length == 0)
     // {
       // console.log(data.productControls[2].color);
       var arr=data.productControls;
      // console.log(arr);
     //var wanted = arr.filter( function(arr){return (arr.color=='#000000' && arr.size=='small' && arr.quantity>0);} );
//console.log(wanted);        
var element="<tr id='p"+itemid+"' ><input type='hidden'   class='totalQuant' ><input type='hidden' name='pc[]' class='pcId' ><td><input disabled name='productName[]' value='"+data.product.name+"' class='form-control' ></td><td class='pricetd'><input disabled name='price[]' class='price form-control' type='text' value='"+data.product.currentPrice+" ' ></td><td class='sizetd'><select name='size[]' class='form-control size'></select></td><td class='colortd' ><select name='color[]' class='form-control color'></select></td><td   class='quantitytd' ><input type='text' name='quantity[]' value=0 class='form-control quantity' name='quantity'  size='1'></td><td class='discounttd'><input type='number' name='discount[]'  class='form-control discount' size='1'></td><td class='totalProductRs totaltd'><input disabled class='total  form-control' name='totalProductRs[]' type='text' value='0 PKR' ></td><td style='border: 0px;'><button class='btn btn-danger btn-fill btn-sm btnDelete'><i class='fa fa-trash fa-2x'></i></button></td></tr>";
$('#table_body').append(element);
updateSubTotal();

//while(data.productControls) 
var sizeArr= new Array();
for(var i=0; i< data.productControls.length; i++)
{

sizeArr[i]=data.productControls[i].size;

}


console.log(sizeArr);
console.log($.unique(sizeArr));

var element="<option>select size</option>";
for (var i=0; i<sizeArr.length; i++)
 {


 element+="<option value="+sizeArr[i]+" >"+sizeArr[i]+"</option>";

 }
idName = '#p'+itemid+' .size';

$(idName).html(element);

playBeep();
updateSubTotal();

//updateSubTotal(data.product.currentPrice);
     // }
//       else
//       {

// var idName='#p'+itemid+' .quantity';

// var totalQuantity=parseInt( $(idName).val());

// if(isNaN(totalQuantity))
// {
//   totalQuantity=0;
// }
// totalQuantity++;
// console.log(totalQuantity);
// $(idName).val(totalQuantity);
// idName='#p'+itemid+' .price';
// var price=  $(idName).val();
// price = parseFloat(price.slice(0,price.indexOf('p')));
// price= price.toFixed(2)
// //updateSubTotal(price);
// var totalPrice= totalQuantity*price;
// idName='#p'+itemid+' .discount';

// var disc=$(idName).val();
// disc = parseInt(disc);
// if(disc!=0 && !isNaN(disc))
// {
//   //console.log(totalPrice);
//  totalPrice =  calculateDiscount(totalPrice,disc);
// }
// //console.log(price);



// idName='#p'+itemid+' .total';

// $(idName).val(totalPrice+" PKR");


// updateSubTotal();



//          }
         //end else
         
               }
         //end success
            });
            // end  ajax


 });

 // end product submission

 var quantity=0;

$(document).on("keyup keypress blur change", ".quantity", function() {
    var sum = 0;
    $(".quantity").each(function(){

    
    });
    var totalquant=parseInt($(this).parent().siblings('.totalQuant').val());
    quantity = $(this).val();
    if(quantity>totalquant)
    {
     $(this).val(totalquant);
     console.log($(this).val());
    }
     var price =$(this).parent().siblings('.pricetd').children('.price').val();  

  price = parseFloat(price.slice(0,price.indexOf('p')));
  price= price.toFixed(2)

var totalTmp =$(this).parent().siblings('.totaltd').children('.total').val(); 
var total = quantity*price;
var disc =$(this).parent().siblings('.discounttd').children('.discount').val(); 

disc = parseInt(disc);
//console.log("disc before if"+disc);
if(disc!=0 && !isNaN(disc)){

  //console.log("disc in if"+disc);

 total =  calculateDiscount(total,disc);
}

$(this).parent().siblings('.totaltd').children('.total').val(total+" PKR");
updateSubTotal();

//totalTmp=parseFloat(totalTmp.slice(0,totalTmp.indexOf('p')));
//totalTmp= totalTmp.toFixed(2)

//updateSubTotal(total-totalTmp);
});

// total calculation


var discount=0;

$(document).on("keyup keypress blur change", ".discount", function() {
    var sum = 0;
    $(".discount").each(function(){

    
    });
    discount = $(this).val();
    
    var quant =$(this).parent().siblings('.quantitytd').children('.quantity').val(); 
    quant = parseInt(quant);
  //   console.log("quantity"+quant);
     var price =$(this).parent().siblings('.pricetd').children('.price').val();  
     //var total =$(this).parent().siblings('.totaltd').children('.total').val();  
     price = parseFloat(price.slice(0,price.indexOf('p')));
     price= price.toFixed(2);
//console.log("price="+price);
    var total=quant * price;
//console.log(total);
  //total = parseFloat(total.slice(0,total.indexOf('p')));
  //console.log("before"+total);
  
  
var totalTmp = total; 
total   =     calculateDiscount(total,discount);
//console.log("discount"+discount);

$(this).parent().siblings('.totaltd').children('.total').val(total+" PKR");
updateSubTotal();

//totalTmp=parseFloat(totalTmp.slice(0,totalTmp.indexOf('p')));
//totalTmp= totalTmp.toFixed(2)


});






$(document).on("change", ".size", function() {
var thiss = $(this);
var size = thiss.val();
console.log(size);
var id  = $(this).closest('tr').attr('id');
id= parseInt( id.slice(1));
console.log(id);



 $.ajax({
                url: 'getColors/'+id+'/'+size,
                type: 'get',
                success: function (data) 
                {
                  var colors =  data.colors;
                  var element="<option>select colors</option>";
                  console.log(colors);
for (var i=0; i<colors.length; i++)
 {
console.log(i);
var val=colors[i].color+"|"+colors[i].quantity+"|"+colors[i].id;
console.log(val);
element+="<option  style='background-color:"+colors[i].color+"' value="+val+" >"+ colors[i].color +"</option>";

 }

thiss.parent().siblings('.colortd').children('.color').html(element);
                
                }
});


$(document).on("change", ".color", function() {

  var quantity=$(this).val();
  var arr=quantity.split('|');
$(this).parent().siblings('.totalQuant').val(arr[1]);
//console.log(quantity);
$(this).parent().siblings('.pcId').val(arr[2]);

console.log($(this).parent().siblings('.pcId').val());





});


});


$('.submitProducts').click(function(){

  var price = $('input[name="price[]"]').map(function(){ 
                    return this.value; 
                }).get();
              
                var pc = $('input[name="pc[]"]').map(function(){ 
                    return this.value; 
                }).get();
                var size = $('input[name="size[]"]').map(function(){ 
                    return this.value; 
                }).get();
                var color = $('input[name="color[]"]').map(function(){ 
                    return this.value; 
                }).get();
                var  quantity = $('input[name="quantity[]"]').map(function(){ 
                    return this.value; 
                }).get();
                var totalProductRs = $('input[name="totalProductRs[]"]').map(function(){ 
                    return this.value; 
                }).get();
                var discount = $('input[name="discount[]"]').map(function(){ 
                    return this.value; 
                }).get();



 $.ajax({
                url: '{{ route('pos.submitSale') }}',
                type: 'post',
                dataType: 'json',
                data: {
                pc:pc,
                quantity:quantity,
                totalProductRs:totalProductRs,
                customer:1,
                grandTotal:globalTotal,
                discount:discount
            },
                success: function (data) 
                {

                  console.log(data);
                  location.reload();
                }
 });


});







$("#tbUser").on('click', '.btnDelete', function () {
    $(this).closest('tr').remove();
    updateSubTotal();
});


</script>

@endsection
@section('head_links')
  <link href="{{ asset('css/awesomplete.css') }}" rel="stylesheet" />
  <meta name="csrf-token" content="{{csrf_token()}}">

@endsection
