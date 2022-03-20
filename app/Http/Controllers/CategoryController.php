<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::all();

        return response()->json([
            'data' => $category
        ],200);

    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $this->validate($request, [
            'title' => 'required',
        ]);

        $category           = new Category();
      $category->title      = $request->title;
      $category->slug       = Str::slug($request->title);

      $category->save();

      return response()->json([
          'message' => 'Category added successfully'
       ],201);
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
          $category = Category::find($id);
          return response()->json([
            'data' =>$category
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
           $category = Category::find($id);

           $category->title = $request->title;
           $category->save();

            return response()->json([
                'data' =>'Category Update successfully'
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
         $category = Category::destroy($id);
         if($category){
            return response()->json([
                'message' =>'Category Delete successfully'
            ],200);
        }
            else{
                return response()->json([
                    'erorr' =>'Category  Not Delete'
            ],404);
            }

         }



    
}
