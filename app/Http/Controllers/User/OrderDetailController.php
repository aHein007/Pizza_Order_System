<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderDetailController extends Controller
{   //order detail page
    function orderDetailPage($id){
        $pizzaData =Pizza::where("pizza_id",$id)->first();
        return view("user.orderDetail.orderDetailpage")->with(["pizzaItem"=>$pizzaData]);
    }

    //Buy Pizza order
    function orderBuy($id){
        $pizzaData =Pizza::where("pizza_id",$id)->first();
        return view("user.orderDetail.orderBuy")->with(["pizzaItem"=>$pizzaData]);
    }

    function orderProcess(Request $request){
        $detailPizza =Session::get("PIZZA_DETAIL");
        $userId =auth()->user()->id;
        $data =$this->orderData($request,$userId,$detailPizza);
        $pizzaCount =$request->count;
        $waitingTime = $pizzaCount * $detailPizza[0]["waiting_time"];

        for($i = 0; $i <$pizzaCount; $i++){
            Order::create($data);
        }
        return back()->with(["orderSucces"=>"You are order now successfully! Please wait $waitingTime minutes"]);
    }

    function orderData($request,$userId,$detailPizza){
        return[
            "customer_id"=>$userId,
            "pizza_id" =>$detailPizza[0]["pizza_id"],
            "carrier_id" =>0,
            "payment_id" =>$request->pay,
             "order_time" =>Carbon::now()
        ];
    }
}
