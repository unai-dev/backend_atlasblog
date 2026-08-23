<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $per_page = $request->query("per_page", 5);
        $page = $request->query("page", 0);
        $offset = ($page * $per_page) - 1;

        $posts = Post::skip($offset)
            ->take($per_page)
            ->get();

        return response()->json(["data" => $posts]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::create($request->all());

        return response()->json(["data" => $post], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if (is_null($post)) {
            return response()->json(["error" => "Post not found!"], Response::HTTP_NOT_FOUND);
        }

        return response()->json(["data" => $post]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
