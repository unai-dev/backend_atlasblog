<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
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
    public function store(CreateMessageRequest $request)
    {
        $message = Message::create($request->validated());
        return response()->json(["data" => $message], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return response()->json(["data" => $message]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->update($request->validated());
        return response()->json(["data" => $message], Response::HTTP_ACCEPTED);
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
