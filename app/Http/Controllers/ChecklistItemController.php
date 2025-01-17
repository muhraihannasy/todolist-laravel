<?php

namespace App\Http\Controllers;

use App\Models\ChecklistItem;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;


class ChecklistItemController extends Controller implements HasMiddleware
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
            $data = ChecklistItem::all();

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
            $data = ChecklistItem::where('uuid', $uuid);

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

            $data = ChecklistItem::create($validatedData);

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
                'sequence' => 'number'
            ]);

            $data = ChecklistItem::where('uuid', $uuid)->update($validatedData);

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
}
