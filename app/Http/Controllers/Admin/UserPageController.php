<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPageController extends Controller
{
    //user Page
    function userPage(){
        $data =User::where("role","user")
                    ->paginate(9);
        if($data->count() == 0){
            $empty = 0;
          }else{
            $empty =1;
        }

        return view("admin.userPage.userPage")->with(["userData"=>$data,"counter"=>$empty]);
    }

    //User Page - admin Role
    function adminRole(){
        $data=User::where("role","admin")->paginate(9);
        if($data->count() == 0){
            $empty = 0;
          }else{
            $empty =1;
        }

        return view("admin.userPage.client.adminRolePage")->with(["userData"=>$data,"counter"=>$empty]);
    }

    //User Page -user Role
    function userRole(){
        $data=User::where("role","user")->paginate(9);
        if($data->count() == 0){
            $empty = 0;
          }else{
            $empty =1;
        }

        return view("admin.userPage.client.userRolePage")->with(["userData"=>$data,"counter"=>$empty]);
    }

    //admin search
    function adminSearch(Request $request){
      $data =$this->searchItem($request,"admin");
      if($data->count() == 0){
        $empty = 0;
      }else{
        $empty =1;
    }
        return view("admin.userPage.client.adminRolePage")->with(["userData"=>$data,"counter"=>$empty]);
    }

    //user search
    function userSearch(Request $request){
        $data =$this->searchItem($request,"user");
        if($data->count() == 0){
            $empty = 0;
          }else{
            $empty =1;
        }
        return view("admin.userPage.client.userRolePage")->with(["userData"=>$data,"counter"=>$empty]);
    }

    //user Delete
    function userDelete($id){
        $data =User::where("id",$id)->delete();
        return back()->with(["delete"=>"User account have been delete!"]);
    }

    private function searchItem($request,$role){
        $searchData=$request->dataSearch;
        $data =User::where("role",$role)
                    ->where(function($query) use ($searchData){
                        $query->orwhere("name","like","%".$searchData."%")
                              ->orwhere("address","like","%".$searchData."%");
                    })->paginate(9);
                $data->appends($request->all());
                return $data;
    }
}
