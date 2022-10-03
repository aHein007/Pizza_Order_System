<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PizzaController extends Controller
{
    //pizza page
    public function pizzaPage(){
        $data =Pizza::paginate(4);
        if(count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus =1;
        }
        return view("admin.pizzaPage.pizzaPage")->with(["pizzaData"=>$data,"status"=>$emptyStatus]);
    }

    //pizz search
    function pizzaSearch(Request $request){
        $search =$request->searchData;
        $data =Pizza::orwhere("pizza_name","like","%".$search."%")
                    ->orwhere("pizza_price","like","%".$search."%")
                    ->paginate(4);

        if(count($data) == 0){
            $emptyStatus =0 ;
        }else{
            $emptyStatus =1 ;
        }

        return view("admin.pizzaPage.pizzaPage")->with(["pizzaData"=>$data,"status"=>$emptyStatus]);
    }
    //add pizza page
    public function addPizzaPage(){
        $data =Category::get();
        return view("admin.pizzaPage.addPizzaPage")->with(["categoryData"=>$data]);
    }
    //add pizza process
    public function addPizzaProcess(Request $request){
        $file =$request->file("image");
        $imageName =uniqid()."_".$file->getClientOriginalName();
       $file->move(public_path()."/uploadImage/",$imageName);

        $pizzaData =$this->getData($request,$imageName);

        Pizza::create($pizzaData);
        return redirect()->route("admin#pizzaPage")->with(["add"=>"Your pizza items add successfully!"]);

    }

    //see More Page
    function seeMorePage($id){
        $pizzaData =Pizza::select("pizzas.*","categories.category_name","categories.category_id","pizzas.pizza_name","pizzas.pizza_id")
                        ->join("categories","pizzas.category_id","categories.category_id")
                        ->where("pizza_id",$id)
                        ->first();


        return view("admin.pizzaPage.seeMorePage")->with(["dataPizza"=>$pizzaData]);
    }

    //delete pizza
    function deletePizza($id){
        $data =Pizza::select("pizza_image")->where("pizza_id",$id)->first();
        $deleteImage =$data["pizza_image"];

        if(File::exists(public_path("/uploadImage/".$deleteImage))){
            File::delete(public_path("/uploadImage/".$deleteImage));
        }

        Pizza::where("pizza_id",$id)->delete();
        return back()->with(["delete"=>"Your items have been deleted!"]);
    }

    //update pizza
    public function updatePizzaPage($id){
        $categoryData =Category::get();
        $pizzaData =Pizza::select("pizzas.*","categories.category_id","categories.category_name")
                         ->where("pizza_id",$id)
                         ->join("categories","pizzas.category_id","categories.category_id")
                         ->first();
            //dd($pizzaData->toArray());
        return view('admin.pizzaPage.updatePizzaPage')->with(["dataPizza"=>$pizzaData,"dataCategory"=>$categoryData]);
    }

    //update pizza Process
    function updatePizza($id,Request $request){

        $data =$this->getUpdateData($request);
        //old image
        $pizzaData =Pizza::select("pizza_image")->where("pizza_id",$id)->first();
        $getOldImage = $pizzaData["pizza_image"];

        //old image delete
        if(File::exists(public_path("/uploadImage/".$getOldImage))){
          File::delete(public_path("/uploadImage/".$getOldImage));
        }

        //new image put to uploadImage;
        $file =$request->file("image");
        $getNewImage =uniqid()."_".$file->getClientOriginalName();
        $file->move(public_path()."/uploadImage/",$getNewImage);

        $data["pizza_image"]=$getNewImage;
        $updatePizza =Pizza::where("pizza_id",$id)->update($data);
        return redirect()->route("admin#pizzaPage")->with(["success"=>"Your items update successfully!"]);
    }



    private function getUpdateData($request){
         $arr =[
            "pizza_name" =>$request->name,
            "pizza_price" =>$request->price,
            "publish_status" =>$request->publish,
            "category_id" =>$request->category,
            "discount_price" =>$request->discount,
            "buy_one_get_one_status" =>$request->byOne,
            "waiting_time" =>$request->waiting,
            "description"=>$request->description,
        ];

        //new image
        if(isset($request->image)){
            $arr["pizza_image"]=$request->image;
        }
        return $arr;
    }



    private function getData($request,$imageName){
        return [
            "pizza_name" =>$request->name,
            "pizza_image" =>$imageName,
            "pizza_price" =>$request->price,
            "publish_status" =>$request->publish,
            "category_id" =>$request->category,
            "discount_price" =>$request->discount,
            "buy_one_get_one_status" =>$request->byOne,
            "waiting_time" =>$request->waiting,
            "description"=>$request->description,
        ];
    }


}
