<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getArticleData()
    {
        $data = Article::all();        
        return response()->json([
            'data' => $data
        ], 200);        
    }

    public function index()
    {
        $data = Article::paginate(15);

        if(!$data == null)
        {
            return response()->json([
                'message' => 'Success Get All Data',
                'data' => $data
            ], 200);
        }
        return response()->json([
            'message' => 'Failed Get Data!'
        ], 404);

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
        if($request->file('image')){
            $image = Storage::put('public/image', $request->file('image'));
            $imageUrl = Storage::url($image);
            $data = Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imageUrl,
                'id_user' => $request->id_user,
                'id_category' => $request->id_category
            ]);
    
            return response()->json([
                'message' => 'Success Store All Data',
                'status' => true,
                'data' => $data
            ], 201);
        }
        $data = Article::create([
            'title' => $request->title,
            'content' => $request->content,            
            'id_user' => $request->id_user,
            'id_category' => $request->id_category
        ]);

        return response()->json([
            'message' => 'Success Store All Data',
            'status' => true,
            'data' => $data
        ], 201);


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
            ], 200);
        }
        return response()->json([
            'message' => 'Not Found!',
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
        $data = Article::where('id', '=',$id)->first();
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
    public function update(ArticleRequest $request, $id)
    {
        $data = Article::find($id);

        if($request->file('image')){
            $image = Storage::put('public/image', $request->file('image'));
            $imageUrl = Storage::url($image);
    
            $data->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imageUrl,
                'id_user' => $request->id_user,
                'id_category' => $request->id_category
            ]);
    
            return response()->json([
                'message' => 'Success Update Data 1',
                'status' => true,
                'data' => $data
            ]);
        }
        $data->update([
            'title' => $request->title,
            'content' => $request->content,
            'id_user' => $request->id_user,
            'id_category' => $request->id_category
        ]);
        return response()->json([
            'message' => 'Success Update Data 2',
            'status' => true,
            'data' => $data
        ], 200);

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
        $file = File::exists(public_path($data->image));
        if(!$file){
            return response()->json([
                'status' => false
            ]);
        }
        $data->delete();
        return response()->json([
            'message' => 'Success Delete Data',
            'status' => true
        ], 200);
    }
}
