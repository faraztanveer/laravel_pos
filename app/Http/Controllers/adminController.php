<?php

namespace App\Http\Controllers;
use App\category;
use App\brand;
use App\product;
use DB;
use Illuminate\Http\Request;

class adminController extends Controller
{
    
    public function index(){
$productCount=product::all()->count();
$categoryCount=category::all()->count();
$brandCount=brand::all()->count();
$monthlyReport= DB::select("SELECT COUNT(id) as totalSale, month FROM data_sets GROUP BY month order by (case month when 'january' then 1 when 'february' then 2 when 'march' then 3 when 'april' then 4 when 'may' then 5 when 'june' then 6 when 'july' then 7 when 'august' then 8 when 'september' then 9 when 'october' then 10 when 'november' then 11 when 'december' then 12 END)");
$month=[];
$totalSale=[];
$i=0;
foreach($monthlyReport as $monthlyReport)
{
    $month[$i]=$monthlyReport->month;
    $totalSale[$i]=$monthlyReport->totalSale;
    $i++;

}

$chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels($month)
        ->datasets([
            [
                "label" => "monthly sale record",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $totalSale,
            ]
        ])
        ->options([]);


return view('admin.index',compact(['productCount','categoryCount','brandCount','chartjs']));

    }

    
    
   
}
