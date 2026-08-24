<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->query("per_page", 5);
        $page = $request->query("page", 0);
        $offset = $page * $per_page;

        $categories = Category::skip($offset)
            ->take($per_page)
            ->get();

        return response()->json(["data" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                "name" => "required|string|max:255"
            ]);

            $category = Category::create($validated);
            return response()->json(["data" => $category], Response::HTTP_CREATED);
        } catch (ValidationException $ex) {
            return response()->json(["error" => $ex->errors()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (is_null($category)) {
            return response()->json(["error" => "Category not found!"], Response::HTTP_NOT_FOUND);
        }

        return response()->json(["data" => $category]);
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
        Category::destroy($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
