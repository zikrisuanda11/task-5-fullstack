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

        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Get All Data',
                'data' => $data
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Failed Get All Data!',
        ], Response::HTTP_NOT_FOUND);

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
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'message' => 'Failed Store Data!'
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
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
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Failed Find Data!'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Failed Update Data!'
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
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
        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Delete Data'
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Failed Delete Data!'
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
