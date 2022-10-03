<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //category page
    function categoryPage(){
        $data =Category::select("categories.category_id","categories.category_name","categories.category_date",DB::raw("count(pizzas.category_id) as count"))
                ->leftJoin("pizzas","categories.category_id","pizzas.category_id")
                ->groupBy("categories.category_id","categories.category_name","categories.category_date")
                ->paginate(7);

        if(count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus =1;
        }


        return view("admin.categoryPage.categoryPage")->with(["categoryData"=>$data,"status"=>$emptyStatus]);
    }

    //countItemsPage
    function countItemsPage($id){
        $data =Pizza::select("pizzas.*","categories.category_name")
                        ->where("pizzas.category_id",$id)
                        ->join("categories","pizzas.category_id","categories.category_id")
                        ->paginate(7);

        return view("admin.categoryPage.countItems")->with(["pizzaData"=>$data]);
    }

    // add category page
    function addCategoryPage(){
        return view("admin.categoryPage.addCategoryPage");
    }

    //add category process
    function addCategoryProcess(Request $request){
        $data =$this->addData($request);
        $categoryData =Category::create($data);
       return redirect()->route("admin#categoryPage")->with(["add"=>"Your items add successfully!"]);
    }

    //category Delete
    function categoryDelete($id){
        Category::where("category_id",$id)->delete();
        return redirect()->route("admin#categoryPage")->with(["delete"=>"Your items delete successfully!"]);
    }

    //Category update Page
    function categoryUpdatePage($id){
        $data =Category::where("category_id",$id)->first();
        return view("admin.categoryPage.categoryUpdatePage")->with(["categoryData"=>$data]);
    }

    //category Update
    function categoryUpdate($id,Request $request){
        $data =$this->addData($request);
        Category::where("category_id",$id)->update($data);
        return redirect()->route("admin#categoryPage")->with(["update"=>"Your items update successfully!"]);
    }

    //category Search
    function categorySearch(Request $request){
        $search =$request->searchData;
        $data =Category::where("category_name","like","%".$search."%")->paginate(7);
        if(count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus =1;
        }
        return view("admin.categoryPage.categoryPage")->with(["categoryData"=>$data,"status"=>$emptyStatus]);
    }

    private function addData($request){
        return [
            "category_name" =>$request->name,
            "category_date" =>$request->date,
           ];
    }
}
