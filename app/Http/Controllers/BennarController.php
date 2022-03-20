<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bennar;
use Intervention\Image\Facades\Image;
use File;
use App\Models\User;

class BennarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $bennar = Bennar::all();

         foreach ($bennar as $i => $value) {
             $bennar[$i]['photo'] = env('APP_URL').'/img/bennar/'.$value['photo'];
         }

         return response()->json([
            'data' =>$bennar
         ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    $slug= strtolower(str_replace('','-',$request->title));

    if($slug > 0){
         $slug = $slug .'-'.time();
    }

    if($request->photo !== null || $request->photo !== ''){

        $text = $slug .'.'.$request->photo->getClientOriginalName();
        Image::make($request->photo)->resize(600, 622)->save(public_path('/img/bennar/'.$text));


        $bennar        = new Bennar();
        $bennar->title = $request->title;
        $bennar->photo = $text;
        $bennar->save();

    }
  
      return response()->json([
        'message' => 'Bennar Added Successfully'
      ]);



    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         $bennar = Bennar::findOrFail($id);
         $path = env('APP_URL').'/img/bennar/';
         return response()->json([
            'data' =>$bennar, 'path' =>$path
         ],200);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // return $request->all();

        $old_bennar   =  Bennar::findOrFail($id);
        $slug         =  $old_bennar->title;
        $old_image    =  $old_bennar->photo;

       // $currentPhoto = $old_bennar->photo; 

         if ($request->photo !== null) {
          $image = $request->file('photo');
          
         $text = $slug .'.'.$image->getClientOriginalName();

       if(file_exists(public_path('/img/bennar/'. $old_image))) {
             unlink(public_path('/img/bennar/'. $old_image));
           }

        Image::make($request->photo)->resize(600, 622)->save(public_path('/img/bennar/'.$text));

        Bennar::findOrFail($id)->update([
            'title'              =>$request->title,
            'photo'              =>$text,
          ]);

         }

     else{

      Bennar::findOrFail($id)->update([
         'title'                  =>$request->title,
        ]);
      
         }
     
    return response()->json([
        'data' =>'Bennar Update Successfully'
    ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $Benner  = Bennar::findOrFail($id);
      $image_path = public_path('/img/bennar/'.$Benner->photo);

      if(file_exists($image_path)){
        File::delete($image_path);
      }

      $Benner->delete();

      return response()->json([
        'message' =>'Bennar Delete Successfully'
      ]);

    }


     // public function logout()
     // {
          
     // }

}
