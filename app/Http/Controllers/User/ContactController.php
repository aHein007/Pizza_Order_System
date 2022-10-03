<?php

namespace App\Http\Controllers\User;

use App\Models\Pizza;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
 function userPageSite(){
    $pizzaData =Pizza::paginate(6);
    if(count($pizzaData) === 0){
        $emptyStatus =0;
    }else{
        $emptyStatus =1;
    }
    $categoryData =Category::get();
    Session::put("PIZZA_DETAIL",$pizzaData);

    return view("user.userPageSite")->with(["pizzaItems"=>$pizzaData,"dataCategory"=>$categoryData,"status"=>$emptyStatus]);
}


function userContact(Request $request){
   $data =$this->messageData($request);
   $contactData =Contact::create($data);

   return redirect()->route("user#userPageSite")->with(["success"=>"Thanks your suggestion!"]);
}

//user search bar
function searchBar(Request $request){
  $pizzaData =Pizza::where("pizza_name","like","%".$request->searchData."%")
                    ->paginate(6);
                    if(count($pizzaData) === 0){
                        $emptyStatus =0;
                    }else{
                        $emptyStatus =1;
                    }
  $categoryData =Category::get();
  $pizzaData->append($request->all());
  return view("user.userPageSite")->with(["pizzaItems"=>$pizzaData,"dataCategory"=>$categoryData,"status"=>$emptyStatus]);
}


//click search
function clickSearch($id){
    $pizzaData =Pizza::where("category_id",$id)->paginate(6);
    if(count($pizzaData) === 0){
        $emptyStatus =0;
    }else{
        $emptyStatus =1;
    }


return view("user.userPageSite")->with(["pizzaItems"=>$pizzaData,"dataCategory"=>$categoryData,"status"=>$emptyStatus]);
}

//pizza min and mix
function minPrice(Request $request){
    $min =$request->min;
    $max =$request->max;

    $query =Pizza::select('*'); 

    $start =$request->startDate;
    $end =$request->endDate;

    if(!is_null($start) && is_null($end)){
        $query =$query->whereDate("created_at",">=",$start);
    }elseif(is_null($start) && !is_null($end)){
        $query =$query->whereDate("created_at","<=",$start);
    }elseif(!is_null($start) && !is_null($end)){
        $query =$query->whereDate("created_at",">=",$start)
                      ->whereDate("created_at","<=",$start);
    }

  if(!is_null($min) && is_null($max)){
     $query=$query->where("pizza_price",">=",$min);


  }elseif(!is_null($max) && is_null($min)){
     $query =$query->where("pizza_price","<=",$max);

  }elseif(!is_null($min) && !is_null($max)){
     $query =$query->where("pizza_price",">=",$min)
                   ->where("pizza_price","<=",$max);

  }
  $query =$query->paginate(6);
  $emptyStatus =count($query) == 0 ?  0 : 1;
  $query->appends($request->all());
  $categoryData =Category::get();
  return view("user.userPageSite")->with(["pizzaItems"=>$query,"dataCategory"=>$categoryData,"status"=>$emptyStatus]);
 }

private function messageData($request){
    return[
    "contact_name"=>$request->name,
    "contact_email" =>$request->email,
    "contact_message" =>$request->message,
    ];
}
}
