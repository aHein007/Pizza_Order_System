<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    //admin profile page
    function adminPage(){
        $id =auth()->user()->id;
        $data =User::where("id",$id)->first();
        return view("admin.adminPage")->with(["adminData"=>$data]);
    }

    //admin profile updte
    function updateData($id,Request $request){
        $data =$this->requestUpdateData($request);
        $update =User::where("id",$id)->update($data);
        return back()->with(["update"=>"Your account succesfully updated!"]);
    }

    //admin change password
    function changePasswordPage(){
        return view("admin.changePasswordPage");
    }

    function changePassword($id,Request $request){
        $oldPassword =$request->old;
        $newPassword =$request->new;
        $confirmPassword =$request->confirm;

        $password=User::where("id",$id)->first();
        $hashedPassword =$password["password"];



        if (Hash::check($oldPassword,$hashedPassword)) {
            if($newPassword == $confirmPassword){
               if(strlen($newPassword) <= 6 || strlen($confirmPassword) <= 6){
                return back()->with(["notMatch"=>"You need to fill more than 6 charactor!"]);
                }else{
                $hashed =Hash::make($newPassword);
                User::where("id",$id)->update([
                    "password" =>$hashed
                ]);
                return redirect()->route("admin#page")->with(["update"=>"Your password changed successfully!"]);
               }
            }else{
                return back()->with(["notSame"=>"Your password need to same with confirm Password"]);
            }
        }else{
            return back()->with(["oldError"=>"Your password wrong!Try again!"]);
        }





    }

    private function requestUpdateData($request){
        return [
            "name" =>$request->name,
            "email" =>$request->email,
            "address" =>$request->address,
            "phone" =>$request->phone,
        ];
    }




}
