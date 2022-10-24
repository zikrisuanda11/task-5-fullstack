<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index()
    {
        $data = Category::all();

        return response()->json([
            'message' => 'Success Get All Data',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = Category::create($request->only(
            'name',
            'id_user'
        ));

        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Create Data',
                'data' => $data
            ], 201);
        }
        return response()->json([
            'message' => 'Failed Store Data!'
        ], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Category::find($id);

        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Get Data',
                'data' => $data
            ], 200);
        }
        return response()->json([
            'message' => 'Failed Find Data!'
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::where('id', '=',$id)->first();
        return response()->json([
            'data' => $data
        ], 200);
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
        $data = Category::find($id);
        $data->update($request->only(
            'name',
            'id_user'
        ));

        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Update Data',
                'data' => $data
            ], 200);
        }
        return response()->json([
            'message' => 'Failed Update Data!'
        ], 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::find($id);
        $data->delete();
        return response()->json([
            'message' => 'Success Delete Data',
            'status' => true,
        ], 200);        
    }
}
