<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Video::all());
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|string|max:255',
        ]);

        $video = Video::create($validatedData);

        return response()->json($video, Response::HTTP_CREATED);
    }

    public function show(Video $video): JsonResponse
    {
        return response()->json($video);
    }

    public function update(Request $request, Video $video): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'url' => 'string|max:255',
        ]);

        $video->update($validatedData);

        return response()->json($video);
    }

    public function destroy(Video $video): JsonResponse
    {
        $video->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
