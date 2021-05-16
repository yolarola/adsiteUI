<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManager;
use App\Models\advert;
use App\Models\Category;
use App\Models\Message;
use File;
use Illuminate\Support\Facades\Storage;
use Image; 
use DB;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    
    public function messagesall()
    {

        return view('messages/all', ['adverts'=>DB::table('adverts')->join('messages','adverts.user_id', '=','messages.reciever_id')]);
    }   //['adverts'=>DB::table('adverts')->get()], ['messages'=>DB::table('messages')->get()], 

    public function messagesshow($adv)
    {
        //dd($nm);
        $user= auth()->user();
        return view('messages/show',['adverts'=>DB::table('adverts')->where('user_id',$adv)->get()],['messages'=>DB::table('messages')->where('sender_id', $user->id)
        ->orWhere('reciever_id',$user->id)->where('sender_id',$adv)->orWhere('reciever_id',$adv)->get()]);
    } 

    public function sendmessage(request $request)
    {
        $message = new message();
        $input = $request ->all();
       // dd($input);
        $message_to_req = $input['message_to'];
        $reciever_id_req = $input['reciever_id'];
        $sender_id_req = $input['sender_id'];
        $adv = $input['userid'];

        $message->message = $message_to_req;
        $message->reciever_id = $reciever_id_req;
        $message->sender_id = $sender_id_req;
        $message->save();


       // return view(route('messagesshow', [$input['userid']]));
       // return redirect()->route('messagesshow', ['id' => 1]);
        return redirect()->route('messagesshow', $adv);
    } 
}
