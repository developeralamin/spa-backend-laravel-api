<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;


class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lesson =Lesson::with('category')->get();
        return response()->json([
           'data' => $lesson
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $lesson              = new Lesson();

        $lesson->title       = $request->title;
        $lesson->description = $request->description;
        $lesson->video_url   = $request->video_url;
        $lesson->category_id = $request->category_id;

        $lesson->save();

        return response()->json([
          'message' => 'Lesson added successfully'
       ],201);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $lesson = Lesson::find($id);
         // $category = Category::all();
          return response()->json([
            'data' =>$lesson
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
          $Lesson = Lesson::find($id);

           $Lesson->title = $request->title;
           $Lesson->description = $request->description;
           $Lesson->video_url = $request->video_url;
           $Lesson->category_id = $request->category_id;
           $Lesson->save();

            return response()->json([
                'data' =>'Lesson Update successfully'
           ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $lesson = Lesson::destroy($id);
         if($lesson){
            return response()->json([
                'message' =>'Lesson Delete successfully'
            ],200);
        }
            else{
                return response()->json([
                    'erorr' =>'Lesson  Not Delete'
            ],404);
            }
    }
}
