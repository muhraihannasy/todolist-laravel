<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class ChecklistController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(middleware: 'auth:api'),
        ];
    }

    public function index()
    {
        try {
            $data = Checklist::with('checklistItems')->get();

            return response()->json([
                'success' => true,
                'message' => "Success get data",
                'data' => $data,
            ], status: 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function detail(string $uuid)
    {
        try {
            $data = Checklist::where('uuid', $uuid)->with('checklistItems')->get()->first();

            return response()->json([
                'success' => true,
                'message' => "Success get data",
                'data' => $data,
            ], status: 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }


    public function create(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'background-color' => 'string',
                'description' => 'string',
            ]);

            $validatedData['user_id'] = Auth::user()->id;

            $data = Checklist::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => "Success create data",
                'data' => $data,
            ], status: 200);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                "data" => null,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function update(string $uuid, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'string|max:255',
                'background-color' => 'string',
                'description' => 'string',
                'sequence' => 'numeric'
            ]);

            Checklist::where('uuid', $uuid)->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => "Success create data",
                'data' => $validatedData,
            ], status: 200);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                "data" => null,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function delete(string $uuid)
    {
        try {
            Checklist::where('uuid', $uuid)->delete();

            return response()->json([
                'success' => true,
                'message' => "Success delete data",
            ], status: 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
