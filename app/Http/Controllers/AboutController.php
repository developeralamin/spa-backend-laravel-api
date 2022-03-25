<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::all();
        return response()->json([
            'data' => $about
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'title'  => 'required',
            'description'  => 'required',
            'video_url'  => 'required',
        ]);
        
        $CreateAbout = new About();

        $CreateAbout->title = $request->title;
        $CreateAbout->description = $request->description;
        $CreateAbout->video_url = $request->video_url;

        $CreateAbout->save();

        return response()->json([
            'message' =>'About Created Successfully'
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
         $about = About::findOrFail($id);
         return response()->json([
            'data' =>$about
         ],201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $About = About::find($id);
          return response()->json([
            'data' =>$About
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
          $About                = About::find($id);

           $About->title        = $request->title;
           $About->description  = $request->description;
           $About->video_url    = $request->video_url;
           $About->save();

            return response()->json([
                'data' =>'About Update successfully'
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
        $about = About::destroy($id);
         if($about){
            return response()->json([
                'message' =>'About Delete successfully'
            ],200);
        }
            else{
                return response()->json([
                    'erorr' =>'About  Not Delete'
            ],404);
            }

         }

}
