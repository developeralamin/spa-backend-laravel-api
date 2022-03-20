<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use File; // For File
use Carbon\Carbon;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                                   //->paginate(4)
        $course =Course::with('category')->get();
        foreach ($course as $i => $value) {
            $course[$i]['photo'] = env('APP_URL').'/img/course/'.$value['photo'];
        }
        return response()->json([
           'data' => $course
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$data =  $request->all();

        $slug = strtolower(str_replace(' ','-' ,$request->title));

        if($slug > 0){
         $slug = $slug .'-'.time();
        }
        

         if ($request->photo !== null || $request->photo !== '') {
            
            $text = $slug .'.'.$request->photo->getClientOriginalName();
            Image::make($request->photo)->resize(600, 622)->save(public_path('/img/course/'.$text));

            $course                    = new Course();
            $course->title             = $request->title;
            $course->description       = $request->description;
            $course->photo             = $text;
            $course->category_id       = $request->category_id;
            $course->save();  
         }
      

       return response()->json([
           'message' =>'Course Added successfully'
       ]);

         
    }

 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $course = Course::findOrFail($id);
         $path = env('APP_URL').'/img/course/';

         return response()->json([
            'data' =>$course , 'path'=>$path
         ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $course = Course::findOrFail($id);
         $path = env('APP_URL').'/img/course/';

         return response()->json([
            'data' =>$course , 'path'=>$path
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

        $old_course = Course::findOrFail($id);

        $slug       = $old_course->title;
        $old_image  = $old_course->photo;

       if ($request->photo !== null) {

            $image = $request->file('photo');

            $text = $slug . '.' .$image->getClientOriginalName();

            if(file_exists(public_path('img/course/'.$old_image))){
                unlink(public_path('img/course/'.$old_image));
            }
                 
        Image::make($request->photo)->resize(600, 622)->save(public_path('/img/course/'.$text));

        Course::findOrFail($id)->update([

            'title'                    =>  $request->title,
            'photo'                    =>  $text,
            'description'              =>  $request->description,
            'category_id'              =>  $request->category_id,

          ]);

        }

        else{

            Course::findOrFail($id)->update([
            'title'                    =>  $request->title,
            'description'              =>  $request->description,
            'category_id'              =>  $request->category_id,
          ]);


        }
  
        return response()->json([
            'data' =>'Course Update successfully'
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
        $getCourseInfo = Course::find($id);

         $deleteCourse = Course::destroy($id);
         if($deleteCourse){
            unlink(public_path('/img/course/'.$getCourseInfo->photo));
            return response()->json([
                'message' =>'Course Delete successfully',
                'path' => public_path('/img/course/'.$getCourseInfo->photo)
            ],200);
        }
            else{
                return response()->json([
                    'erorr' =>'Course  Not Delete'
            ],404);
            }
    }
}
