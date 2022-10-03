<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{//contact Page
    function contactPage(){
        $data =Contact::paginate(13);
        if(count($data) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }
        return view("admin.contactPage.contactPage")->with(["contactData"=>$data,"status"=>$emptyStatus]);
    }

    //contact Delete
    function contactDelete($id){
       $data =Contact::where("contact_id",$id)->delete();
       return back()->with(["contactMessage"=>"Your contact message deleted!"]);
    }

    //contact serarch
    function contactSearch(Request $request){
        $dataSearch =$request->searchData;
        $data =Contact::orwhere("contact_name","like","%".$dataSearch."%")
                          ->orwhere("contact_email","like","%".$dataSearch."%")
                          ->paginate(13);
        if(count($data)== 0){
            $emptyStatus =0;
        }else{
            $emptyStatus =1;
        }

        return view("admin.contactPage.contactPage")->with(["contactData"=>$data,"status"=>$emptyStatus]);
    }
}
