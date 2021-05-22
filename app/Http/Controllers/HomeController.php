<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Models\advert;
use App\Models\Category;
use File;
use Illuminate\Support\Facades\Storage;
use Image; 
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

 
    public function index()
    {
        return view('/home',['adverts'=>DB::table('adverts')->get()],['categories'=>DB::table('categories')->get()]);
    }

    public function homeshow($ad)
    {
        //dd($ad); 
        return view('/home/show',['adverts'=>DB::table('adverts')->where('id',$ad)->get()],['categories'=>DB::table('categories')->get()]);
    }   
}
