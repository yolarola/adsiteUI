<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
//use App\Image;
use App\Models\advert;
use App\Models\Category;
use Intervention\Image\ImageManager;
use File;
use Image; 
class AdvertController extends Controller
{


    public function parent()
    {
        return $this -> hasOne(DB::table('categories'), 'id', 'parent_id');
    }

    public function advert()
    {
       // $categories = DB::table('category')->get();
        return view('advert',
    ['categories'=>DB::table('categories')->get()]);
    }

  

    public function AdvertStore(Request $request)
    {
        //dd($request);
        function translit($str){
            $alphavit = array(
            /*--*/
            "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e",
            "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l", "м"=>"m",
            "н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t",
            "у"=>"y","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch", "ш"=>"sh","щ"=>"sh",
            "ы"=>"i","э"=>"e","ю"=>"u","я"=>"ya",
            /*--*/
            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E", "Ё"=>"Yo",
            "Ж"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K", "Л"=>"L","М"=>"M",
            "Н"=>"N","О"=>"O","П"=>"P", "Р"=>"R","С"=>"S","Т"=>"T","У"=>"Y",
            "Ф"=>"F", "Х"=>"H","Ц"=>"C","Ч"=>"Ch","Ш"=>"Sh","Щ"=>"Sh",
            "Ы"=>"I","Э"=>"E","Ю"=>"U","Я"=>"Ya",
            "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>""
            );
            return strtr($str, $alphavit);
        }


        $request->validate
        ([
            'img_main' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        $user= auth()->user();
            //dd($request);
        $advert = new advert();
        $input = $request ->all();
        //dd($input);
        $price_req = $input['price'];
        $adress_req = $input['adress'];
        $AdvertCategory_req = $input['AdvertCategory'];
        $phoneNumber_req = $input['phoneNumber'];
        $AdvertName_req = $input['AdvertName'];
        $Adverttext_req = $input['Adverttext'];
        $AdvertfirstName_req = $input['firstName'];
       // dd($AdvertCategory_req);
        //dd($price_req);      
        //$advert -> id = $request ->input('id');
        $advert -> folder = $user ->name;
        $advert -> advert_name = $AdvertName_req;
        $advert -> folder = 'rrrr';
        $advert -> phoneNumber =  $phoneNumber_req;
        $advert -> name = $user ->name;
        $advert -> email = $user ->email;   

        $advert -> AdvertCategory = $AdvertCategory_req;
        $advert -> price = $price_req;
        $advert -> adress = $adress_req;
        $advert -> advert_name = $AdvertName_req;
        $advert -> AdvertText = $Adverttext_req;
        $advert -> firstName = $AdvertfirstName_req;

        $advert ->save();        

        $id = $user->id;
        $foldername = $user ->name;

        $advert_name_translit = $advert -> advert_name;
        $advert_name_translit = translit($advert_name_translit);
        $advert_name_translit = str_replace(' ','_',$advert_name_translit);
        $advert_name_translit = $user->id.'_'.$foldername.'_'.time().'_'.$advert_name_translit;

        $name_name = $advert ->name;
        $folder_folder = $advert ->main_folder;
           // dd($name_name);
           // dd($folder_folder);
        if (($name_name) != ($folder_folder))
        {
            $path = public_path().'/uploads/' . $foldername;
            if(!File::exists($path))
             {
                File::makeDirectory($path);
             }

           // dd($advert_name_translit);

            $path_advert = public_path().'/uploads/' . $foldername . '/' . $advert_name_translit;
            File::makeDirectory($path_advert);
            

            $path_originals = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/originals';
            File::makeDirectory($path_originals);
            $path_crops = public_path().'/uploads/' . $foldername .'/'. $advert_name_translit . '/crops';
            File::makeDirectory($path_crops);

            $advert -> folder = $advert_name_translit;
            $advert ->main_folder = $user ->name;
            $advert ->user_id = $user->id;
            $advert ->save();
            
        }
        else {
            //redirect('/advert')->with('success','You have successfully upload image.');
           // dd($name_name);
        }

        //IMAGE_MAIN
        $image_main = $user->id.'_img_main'.time().'.'.request()->img_main->getClientOriginalExtension();

        $request->img_main->move($path_originals, $image_main);

        $advert -> img_main = $image_main;

        $img = Image::make($path_originals.'/'.$image_main)->resize(150, 150);
        $img->save($path_crops.'/'.'crops'.'_'.$image_main);

        $advert-> crop_img_main = 'crops_'.$image_main;
        $advert ->save();

        //IMG2
        //dd($request);
        $image2 = $user->id.'_img_2'.time().'.'.request()->img_2->getClientOriginalExtension();
     
        $request->img_2->move($path_originals, $image2);

        $advert -> img_2 = $image2;

        $img = Image::make($path_originals.'/'.$image2)->resize(150, 150);
        $img->save($path_crops.'/'.'crops'.'_'.$image2);

        $advert-> crop_img_2 = 'crops_'.$image2;
        $advert ->save();
        //////////

        //IMG3
        $image3 = $user->id.'_img_3'.time().'.'.request()->img_3->getClientOriginalExtension();
     
        $request->img_3->move($path_originals, $image3);

        $advert -> img_3 = $image3;

        $img = Image::make($path_originals.'/'.$image3)->resize(150, 150);
        $img->save($path_crops.'/'.'crops'.'_'.$image3);

        $advert-> crop_img_3 = 'crops_'.$image3;
        $advert ->save();



        return redirect('/')->with('success','You have successfully upload image.');
    }

    public function AdvertUpdate(request $request)
    {
        //dd($ad);
       
        $input = $request ->all();
        //dd($input);
        $id_req = $input['id'];
        $advert = advert::find($id_req); //дырочка
        //dd($id_req);
        //adverts::find($id_req);
        
        $price_req = $input["price"];
        $adress_req = $input['adress'];
        $AdvertCategory_req = $input['AdvertCategory'];
        $phoneNumber_req = $input['phoneNumber'];
        $AdvertName_req = $input['AdvertName'];
        $Adverttext_req = $input['Adverttext'];
        $firstName_req = $input['firstName'];
        
        //$advert -> AdvertCategory = $AdvertCategory_req;
        $advert -> price = $price_req;
        $advert -> adress = $adress_req;
        $advert -> advert_name = $AdvertName_req;
        $advert -> AdvertText = $Adverttext_req;
        $advert -> firstName = $firstName_req;
        $advert -> AdvertCategory = $AdvertCategory_req;
       
        $advert ->save();  
        
        return redirect('/adminpanel/all')->with('success');
    }

    public function MyadUpdate(request $request)
    {
        //dd($ad);
       
        $input = $request ->all();
        //dd($input);
        $id_req = $input['id'];
        $advert = advert::find($id_req); //дырочка
        //dd($id_req);
        //adverts::find($id_req);
        
        $price_req = $input["price"];
        $adress_req = $input['adress'];
        $AdvertCategory_req = $input['AdvertCategory'];
        $phoneNumber_req = $input['phoneNumber'];
        $AdvertName_req = $input['AdvertName'];
        $Adverttext_req = $input['Adverttext'];
        $firstName_req = $input['firstName'];
        
        //$advert -> AdvertCategory = $AdvertCategory_req;
        $advert -> price = $price_req;
        $advert -> adress = $adress_req;
        $advert -> advert_name = $AdvertName_req;
        $advert -> AdvertText = $Adverttext_req;
        $advert -> firstName = $firstName_req;
        $advert -> AdvertCategory = $AdvertCategory_req;
       
        $advert ->save();  
        
        return redirect('/myads')->with('success');
    }

    public function adminpaneldelete($ad)
    {
        //dd($ad);
        $id=$ad;
        $advert = advert::find($ad);
        $advert -> destroy($id);

        return redirect('/adminpanel/all');

    }

    public function adminhomedelete($ad)
    {
        //dd($ad);
        $id=$ad;
        $advert = advert::find($ad);
        $advert -> destroy($id);

        return redirect('/');

    }

    public function adminpanelaprove($ad)
    {
        //dd($ad);
        $id=$ad;
        $advert = advert::find($ad);
        $advert -> moderated = 1;
        $advert ->save();

        return redirect('/adminpanel/all');

    }

    public function ImageUpdate_main(Request $request)
    {
        $input = $request ->all();
        $id_req = $input['adid'];
        //dd($id_req);
        $user= auth()->user();
        $advert = advert::find($id_req); //дырочка
        $foldername = $advert -> main_folder;
        $advert_name_translit = $advert -> folder;

        
        $request->validate
        ([
            'img_main' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $path_originals = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/originals';
        $path_crops = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/crops';
        
        $image_main = $user->id.'_img_main'.time().'.'.request()->img_main->getClientOriginalExtension();

        $request->img_main->move($path_originals, $image_main);

        $advert -> img_main = $image_main;

        $img = Image::make($path_originals.'/'.$image_main)->resize(150, 150);
        $img->save($path_crops.'/'.'crops'.'_'.$image_main);

        $advert-> crop_img_main = 'crops_'.$image_main;
        $advert ->save();

            //return redirect('/myads/edit')
            return redirect()->route('adedit',$advert->id);
            
    }

    public function ImageUpdate_2(Request $request)
    {
        $input = $request ->all();
        $id_req = $input['adid'];
        //dd($id_req);
        $user= auth()->user();
        $advert = advert::find($id_req); //дырочка
        $foldername = $advert -> main_folder;
        $advert_name_translit = $advert -> folder;

        
        $request->validate
        ([
            'img_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $path_originals = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/originals';
        $path_crops = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/crops';
        
        $image2 = $user->id.'_img_2'.time().'.'.request()->img_2->getClientOriginalExtension();
     
        $request->img_2->move($path_originals, $image2);

        $advert -> img_2 = $image2;

        $img = Image::make($path_originals.'/'.$image2)->resize(150, 150);
        $img->save($path_crops.'/'.'crops'.'_'.$image2);

        $advert-> crop_img_2 = 'crops_'.$image2;
        $advert ->save();

            //return redirect('/myads/edit')
            return redirect()->route('adedit',$advert->id);
            
    }

    public function ImageUpdate_3(Request $request)
    {
        $input = $request ->all();
        $id_req = $input['adid'];
        //dd($id_req);
        $user= auth()->user();
        $advert = advert::find($id_req); //дырочка
        $foldername = $advert -> main_folder;
        $advert_name_translit = $advert -> folder;

        
        $request->validate
        ([
            'img_3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $path_originals = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/originals';
        $path_crops = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/crops';
        
        $image3 = $user->id.'_img_3'.time().'.'.request()->img_3->getClientOriginalExtension();
     
        $request->img_3->move($path_originals, $image3);

        $advert -> img_3 = $image3;

        $img = Image::make($path_originals.'/'.$image3)->resize(150, 150);
        $img->save($path_crops.'/'.'crops'.'_'.$image3);

        $advert-> crop_img_3 = 'crops_'.$image3;
        $advert ->save();

            //return redirect('/myads/edit')
            return redirect()->route('adedit',$advert->id);
            
    }

    public function admin_ImageUpdate_main(Request $request)
    {
        $input = $request ->all();
        $id_req = $input['adid'];
        //dd($id_req);
        $user= auth()->user();
        $advert = advert::find($id_req); //дырочка
        $foldername = $advert -> main_folder;
        $advert_name_translit = $advert -> folder;

        
        $request->validate
        ([
            'img_main' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $path_originals = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/originals';
        $path_crops = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/crops';
        
        $image_main = $user->id.'_img_main'.time().'.'.request()->img_main->getClientOriginalExtension();

        $request->img_main->move($path_originals, $image_main);

        $advert -> img_main = $image_main;

        $img = Image::make($path_originals.'/'.$image_main)->resize(150, 150);
        $img->save($path_crops.'/'.'crops'.'_'.$image_main);

        $advert-> crop_img_main = 'crops_'.$image_main;
        $advert ->save();

            //return redirect('/myads/edit')
            return redirect()->route('adminpaneledit',$advert->id);
            
    }

    public function admin_ImageUpdate_2(Request $request)
    {
        $input = $request ->all();
        $id_req = $input['adid'];
        //dd($id_req);
        $user= auth()->user();
        $advert = advert::find($id_req); //дырочка
        $foldername = $advert -> main_folder;
        $advert_name_translit = $advert -> folder;

        
        $request->validate
        ([
            'img_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $path_originals = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/originals';
        $path_crops = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/crops';
        
        $image2 = $user->id.'_img_2'.time().'.'.request()->img_2->getClientOriginalExtension();
     
        $request->img_2->move($path_originals, $image2);

        $advert -> img_2 = $image2;

        $img = Image::make($path_originals.'/'.$image2)->resize(150, 150);
        $img->save($path_crops.'/'.'crops'.'_'.$image2);

        $advert-> crop_img_2 = 'crops_'.$image2;
        $advert ->save();

            //return redirect('/myads/edit')
            return redirect()->route('adminpaneledit',$advert->id);
            
    }

    public function admin_ImageUpdate_3(Request $request)
    {
        $input = $request ->all();
        $id_req = $input['adid'];
        //dd($id_req);
        $user= auth()->user();
        $advert = advert::find($id_req); //дырочка
        $foldername = $advert -> main_folder;
        $advert_name_translit = $advert -> folder;

        
        $request->validate
        ([
            'img_3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $path_originals = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/originals';
        $path_crops = public_path().'/uploads/' . $foldername .'/'.$advert_name_translit . '/crops';
        
        $image3 = $user->id.'_img_3'.time().'.'.request()->img_3->getClientOriginalExtension();
     
        $request->img_3->move($path_originals, $image3);

        $advert -> img_3 = $image3;

        $img = Image::make($path_originals.'/'.$image3)->resize(150, 150);
        $img->save($path_crops.'/'.'crops'.'_'.$image3);

        $advert-> crop_img_3 = 'crops_'.$image3;
        $advert ->save();

            //return redirect('/myads/edit')
            return redirect()->route('adminpaneledit',$advert->id);
            
    }

    public function admin_MyadUpdate(request $request)
    {
        //dd($ad);
       
        $input = $request ->all();
        //dd($input);
        $id_req = $input['id'];
        $advert = advert::find($id_req); //дырочка
        //dd($id_req);
        //adverts::find($id_req);
        
        $price_req = $input["price"];
        $adress_req = $input['adress'];
        $AdvertCategory_req = $input['AdvertCategory'];
        $phoneNumber_req = $input['phoneNumber'];
        $AdvertName_req = $input['AdvertName'];
        $Adverttext_req = $input['Adverttext'];
        $firstName_req = $input['firstName'];
        
        //$advert -> AdvertCategory = $AdvertCategory_req;
        $advert -> price = $price_req;
        $advert -> adress = $adress_req;
        $advert -> advert_name = $AdvertName_req;
        $advert -> AdvertText = $Adverttext_req;
        $advert -> firstName = $firstName_req;
        $advert -> AdvertCategory = $AdvertCategory_req;
       
        $advert ->save();  
        
        return redirect()->route('adminpanelall');
    } 


    public function search(request $request)
    {
        $key = trim($request->get('q'));

        $adverts = Advert::query()
        ->where('advert_name', 'like', "%{$key}%")
        ->orWhere('AdvertText', 'like', "%{$key}%")
        ->get();

        return view('search',['key' => $key,
        'adverts' => $adverts],['categories'=>DB::table('categories')->get()]);
    }

    public function categorysearch(request $request)
    {
        //dd($request);
        $input = $request['categorysearchbutton'];
        //dd($input);
        $adverts = Advert::query()
            ->where('AdvertCategory',$input)
            ->get();
            
        return view('categorysearch', ['adverts' => $adverts],['categories'=>DB::table('categories')->get()]);
    }
}

