<?php

namespace App\Http\Controllers;
use App\Models\uploadimage;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
// use Intervention\Image\Facades\Image;
use Image;
use Input;

class PhotoController extends Controller
{
    public function index()
    {
        $data = uploadimage::all();
        return $data;
    }
    public function store(Request $request){
        $request->validate([
            'email'=>'required',
            'title'=>'required',
            'description'=>'required',
            'category'=>'required',
            'photo'=>'required|mimes:jpg,jpeg,png,csv,txt,xlx,pdf|max:2048'
        ]);
        // uploadimage::create($request->all());
        $store = new uploadimage;
        if($request->file()){
            $file_name = time().'_'.$request->photo->getClientOriginalName();
            $file_path = $request->file('photo')->storeAs('uploads',$file_name,'public');
            $store->photo = time().'_'.$request->photo->getClientOriginalName();
            $store->email = $request->email;
            $store->title = $request->title;
            $store->description = $request->description;
            $store->category = $request->category;
            $store->save();
        }


        return response([
            'message' =>'success'
        ]);
    }
    public function singlePost( $id ){
        $data = uploadimage::where('id', $id)->first();
        return $data;
    }
    public function singleUser( $id ){
        $data = uploadimage::where('id', $id)->first();
        return $data;
    }
    public function userData($email){
        $data = uploadimage::where('email', $email)->get();
        return $data;
    }
    public function oneData($cat){
        $data = uploadimage::where('category', $cat)->get();
        return $data;
    }
    public function deleteUser($del){
        $data = uploadimage::where('id', $del)->delete();
        return $data;
    }
    public function userUpdate(Request $request){
        $request->validate([
            'email'=>'required',
            'title'=>'required',
            'description'=>'required',
            'category'=>'required',
            'photo'=>'required'
        ]);
        $data = uploadimage::find($request->id);
        $data->title = $request->title;
        $data->category = $request->category;
        $data->email = $request->email;
        $data->photo = $request->photo;
        $data->description = $request->description;
        $data->save();
    }
}
