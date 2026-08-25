<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLikeRequest;
use App\Http\Requests\IndexLikeRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexLikeRequest $request)
    {
        $per_page = $request->query("per_page", 5);
        $page = $request->query("page", 0);
        $offset = $per_page *  $page;

        $likes = Like::where("post_id", $request->validated())
            ->skip($offset)
            ->take($per_page)
            ->get();

        return response()->json(["data" => $likes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLikeRequest $request)
    {
        $like = Like::create($request->validated());
        return response()->json(["data" => $like], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        $like->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
