<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->query("per_page", 5);
        $page = $request->query("page", 0);
        $offset = ($page * $per_page) - 1;

        $messages = Message::skip($offset)
            ->take($per_page)
            ->get();

        return response()->json(["data" => $messages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                "content" => "required|max:2000",
                "post_id" => "required|numeric|exists:posts,id"
            ]);
            $message = Message::create($validated);
            return response()->json(["data" => $message], Response::HTTP_CREATED);
        } catch (ValidationException $ex) {
            return response()->json(["error" => $ex->errors()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Message::find($id);

        if (is_null($message)) {
            return response()->json(["error" => "Message not found!"], Response::HTTP_NOT_FOUND);
        }

        return response()->json(["data" => $message]);
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
        Message::destroy($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
