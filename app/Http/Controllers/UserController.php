<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Models\advert;
use App\Models\report;
use App\Models\review;
use App\Models\Category;
use File;
use Illuminate\Support\Facades\Storage;
use Image;
use DB;
use App\Models\advert_archive;

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

      $user -> save();

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

    public function userprofile($id)
    {

        return view('user', ['users'=>DB::table('users')->where('id',$id)->get()],
        ['reviews'=>DB::table('users')->join('reviews', 'users.id', '=', 'reviews.user_id')->where('user_id',$id)->get()->sortByDesc('id')]
        );
       // ['adverts'=>DB::table('adverts')->join('messages','adverts.id', '=','messages.advert_id')->get()->sortByDesc('id')->unique('advert_id')]);
    }


    public function archive($ad)
    {
        //dd($ad);
        $id=$ad;
        $advert = advert::find($ad);
        //$archive = DB::table('advert_archive');
        $advert_archive = new advert_archive();
        //$advert_archive -> updated_at = $advert -> updated_at;
        //$advert_archive -> created_at = $advert -> created_at;
        $advert_archive -> img_main = $advert -> img_main;
        $advert_archive -> img_2 = $advert -> img_2;
        $advert_archive -> img_3 = $advert -> img_3;
        $advert_archive -> folder = $advert -> folder;
        $advert_archive -> name = $advert -> name;
        $advert_archive -> email = $advert -> email;
        $advert_archive -> phoneNumber = $advert -> phoneNumber;
        $advert_archive -> firstName = $advert -> firstName;
        //$advert_archive -> firstName = $advert -> firstName;
        $advert_archive -> AdvertText = $advert -> AdvertText;
        $advert_archive -> advert_name = $advert -> advert_name;
        $advert_archive -> main_folder = $advert -> main_folder;
        $advert_archive -> crop_img_main = $advert -> crop_img_main;
        $advert_archive -> crop_img_2 = $advert -> crop_img_2;
        $advert_archive -> crop_img_3 = $advert -> crop_img_3;
        $advert_archive -> AdvertCategory = $advert -> AdvertCategory;
        $advert_archive -> price = $advert -> price;
        $advert_archive -> adress = $advert -> adress;
        $advert_archive -> moderated = $advert -> moderated;
        $advert_archive -> create_date = $advert -> created_at;

        $advert_archive -> save();


        $advert -> destroy($id);

        return redirect('/myads');

    }

    public function sendreview(request $request)
    {

        $review = new review;
        $review -> user_id = $request['user_id'];
        $review -> reviewer_id = $request['reviewer_id'];
        $review -> review = $request['review_to'];
        $review -> reviewer_name = $request['reviewer_name'];
       // $id1=$request['user_id'];
        //$id2=$request['reviewer_id'];
        //dd($id1,$id2);
        $review -> save();

        $user_id = $request['user_id'];
        return redirect()->route('userprofile',[$user_id]);
        //return view('/user',[$user_id]);
    }

    public function sendreport(request $request)
    {

        $report = new report;
        $report -> user_id = $request['user_id'];
        $report -> reporter_id = $request['reporter_id'];
        $report -> report = $request['report_to'];
        $report -> user_name = $request['user_name'];
        $report -> reporter_name = $request['reporter_name'];
        $report -> advert_id = $request['advert_id'];

        $report -> save();

        //$user_id = $request['user_id'];
        //return redirect()->route('userprofile',[$user_id]);
        //return view('home')->with('success','Ваша жалоба была отправлена!');
        return redirect()->route('home')->with('success','Ваша жалоба была отправлена!');
    }

    public function report($ad)
    {

        return view('/report',['adverts'=>DB::table('adverts')->where('id',$ad)->get()]);
    }

    public function reportuser($ad)
    {

        return view('/reportuser',['users'=>DB::table('users')->where('id',$ad)->get()]);
    }
}
