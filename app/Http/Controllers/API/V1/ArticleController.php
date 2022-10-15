<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Article::paginate(15);

        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Get All Data',
                'data' => $data
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Failed Get Data!'
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
    public function store(ArticleRequest $request)
    {
        $data = Article::create($request->only('title', 'content', 'image_url', 'id_user', 'id_category'));

        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Store All Data',
                'data' => $data
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'message' => 'Failed Store Data!',
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
        $data = Article::find($id);

        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Get Data',
                'data' => $data
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Not Found!',
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
    public function update(ArticleRequest $request, $id)
    {
        $data = Article::find($id);

        $data->update($request->only(
            'title', 
            'content', 
            'image_url', 
            'id_user', 
            'id_category'
        ));

        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Update Data',
                'data' => $data
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Failed Update data!',
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
        $data = Article::find($id);

        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Delete Data',
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Failed Delete Data!',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
