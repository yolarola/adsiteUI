<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;

class DropdownController extends Controller
{

  

    public function index()
    {
       // $categories = DB::table('category')->get();
       //dd($request)
        return view('dropdown',
    ['categories'=>DB::table('categories')->get()]);
    }

    public function req(Request $request)
    {
        $input = $request ->all();
        $selected = $input['categories_selected'];
        dd($selected);
    }


    public function data(Request $request){

        if($request->has('id')){
            $parentId = $request->get('id');
            $data = Category::where('parent_id',$parentId)->get();
            return ['success'=>true,'data'=>$data];
        }

    }

}