<?php
namespace App\Http\Controllers;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\customer;
use App\bill;
use App\billDetail;
use App\dataSet;
use Carbon\Carbon;

class posController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $id=Auth::user()->id;
       
       $products = product::where('admin_id',$id)->get();
        return view('admin.pos.sales', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

public function getItemDetail($id)
{
    $product = product::find($id);

 return response()->json((array('product'=>$product,'productControls'=>$product->productControls)));

}

public function getColors($id,$size)
{
  
   $colors=DB::select("SELECT  productcontrols.color, productcontrols.quantity, productcontrols.id FROM productcontrols, products WHERE products.id=productcontrols.product_id AND size='$size' AND productcontrols.quantity > 0");
 

 return response()->json((array('colors'=>$colors)));

}


public function submitSale(Request $request)
{
    $id=Auth::user()->id;
    $bill=new bill;
    $bill->customer_id=$request->customer;
    $bill->grand_total=$request->grandTotal;
    $bill->save();
    
    $bid=$bill->id;
    $pc= $request->pc;
    $quantity=$request->quantity;
    $totalProductRs=$request->totalProductRs;
    $discount=$request->discount;
    $length=count($pc);
    $i=0;

       
       while($i<$length)
    {
        $billDetail= new billDetail;
        $billDetail->bill_id=$bill->id;
        $billDetail->pc_id=$pc[$i];
        $billDetail->quantity=$quantity[$i];
        $billDetail->discount=$discount[$i];
        $str=$totalProductRs[0];
        $str= explode(" ",$str,2);
        $str=(int)$str[0];
        $billDetail->total=$str;
        $billDetail->save();
        $i++;
        
    }
$billDetail = billDetail::where('bill_id',$bid)->get();
    foreach($billDetail as $billDetail)
    {


        $dataSet= new dataSet;
        $dataSet->category=$billDetail->productControl->products->generalCategory->name;
        $dataSet->admin_id=$id;
        $dataSet->brand=$billDetail->productControl->products->brand->name;
        $dataSet->location=$billDetail->bill->customer->town->towns;
       
        $month= Carbon::parse($bill->created_at);
        $dataSet->month= $month->format('F');
       
          $dataSet->save();
        




    
    }
    
    return response()->json();
    

}

}
