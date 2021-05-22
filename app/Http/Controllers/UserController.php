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

class UserController extends Controller
{
    public function profile()
        {
            $user = Auth()->user();
            return view('profile',compact('user',$user));
        }

    public function update_avatar(Request $request)
    {

        $request->validate
        ([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth()->user();
            
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('original_images'), $avatarName);

        $img = Image::make(public_path('original_images/').$avatarName)->resize(200, 200);
        $img->save(public_path('images/').$avatarName);

        $img = Image::make(public_path('original_images/').$avatarName)->resize(30, 30);
        $img->save(public_path('images/micro_images/').$avatarName);
 

        $user->avatar = $avatarName;
        $user->save();

       // return back()
       //     ->with('success','You have successfully upload image.');
       return redirect('/profile')->with('success','You have successfully upload image.');


     
    } 
    public function adminpanel()
    {
        //
        //$categories = category::all();
        return view('/adminpanel',['adverts'=>DB::table('adverts')->get()]);
    }   

    public function adminpanelall()
    {
        //
        //$categories = category::all();
        return view('adminpanel/all',['adverts'=>DB::table('adverts')->get()]);
    }   

    public function adminpaneledit($ad)
    {
        //dd($ad);
        
        return view('adminpanel/edit',['adverts'=>DB::table('adverts')->where('id',$ad)->get()],['categories'=>DB::table('categories')->get()]);
    }   

    


    public function UserStore(request $request)
    {
        //dd($ad);
        $input = $request ->all();
        //dd($input);
        $id_req = $input['id'];
        //dd($id_req);
        //adverts::find($id_req);
        
        $price_req = $input["price"];
        $adress_req = $input['adress'];
       // $AdvertCategory_req = $input['AdvertCategory'];
        $phoneNumber_req = $input['phoneNumber'];
        $AdvertName_req = $input['AdvertName'];
        $Adverttext_req = $input['Adverttext'];

        //$advert -> AdvertCategory = $AdvertCategory_req;
        $advert -> price = $price_req;
        $advert -> adress = $adress_req;
        $advert -> advert_name = $AdvertName_req;
        $advert -> AdvertText = $Adverttext_req;
        
        $advert ->update();  
        
        return redirect('/adminpanel/all')->with('success');
    }
    

    public function UserUpdate(request $request)
    {
      $user = Auth()->user();
      $input = $request -> all();
      //dd($input);
      $id_req = $input['id'];
      //$user = user::find($id_req);
      $firstName_req = $input['firstName'];
      $lastName_req = $input['lastName'];
      $phoneNumber_req = $input['phoneNumber'];
      $name_req = $input['name'];

      $user -> name = $name_req;
      $user -> firstName = $firstName_req;
      $user -> lastName = $lastName_req;
      $user -> phoneNumber = $phoneNumber_req;

      $user ->save();

        return redirect('/profile')->with('success');
    }

    public function myads()
    {

        return view('/myads',['adverts'=>DB::table('adverts')->get()]);
    }

    public function addelete($ad)
    {
        //dd($ad);
        $id=$ad;
        $advert = advert::find($ad);
        $advert -> destroy($id);

        return redirect('/myads');

    }

    public function adedit($ad)
    {
        //dd($ad);
        
        return view('myads/edit',['adverts'=>DB::table('adverts')->where('id',$ad)->get()],['categories'=>DB::table('categories')->get()]);
    }   

}