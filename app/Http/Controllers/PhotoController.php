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
            'photo'=>'required'
        ]);
        // if($request->photo){
            // $file = $request->photo;
            // $name = Image::make('public/uploads/', $request->photo)->resize(320, 240)->save('public/uploads/',$request->photo);
        //  $name = time().'.'.explode('/',explode(':',substr($request->photo,0,strpos($request->photo,':')))[1])[1];
        // \Image::make($request->photo)->save(public_path('img/public/').$request->photo);
        // // //     $categoryImage = Image::make($full_path);
        // // //     // $categoryImage = Image::make( $full_path )->resize(1600,479)->stream();
            // $request->merge(['photo'=> $name ]);
        // }
        // if($request->photo){
        //     $name = $request->file('photo');
        //      $request->file('photo')->storeAs('img/public',$name);
        // }
        // if($request->photo){
        //     $imageName = $request->photo;
        //     $destinationPath = 'img/public';
        //     $request->photo->move($destinationPath, $imageName);
        // }

        uploadimage::create($request->all());


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
