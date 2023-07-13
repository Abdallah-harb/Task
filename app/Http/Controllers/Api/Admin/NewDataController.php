<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Http\Resources\Admin\DataResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::whereType('user')->get();
            if(count($users)<1){
                return  ResponseHelper::sendResponseSuccess([],Response::HTTP_OK,"There are no User Yet");
            }
            return  ResponseHelper::sendResponseSuccess(DataResource::collection($users));
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "data" => $request->data
            ]);
            return  ResponseHelper::sendResponseSuccess(new DataResource($user));

        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::whereId($id)->get();
            return  ResponseHelper::sendResponseSuccess(DataResource::collection($user));
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::whereId($id)->first();
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "data" => $request->data
            ]);
            return  ResponseHelper::sendResponseSuccess(new DataResource($user));
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::whereId($id)->first();
            $user->delete();
            return  ResponseHelper::sendResponseSuccess([],Response::HTTP_OK,"User Delete Successfully");
        }catch (\Exception $ex){
            return ResponseHelper::sendResponseError([],Response::HTTP_BAD_REQUEST,$ex->getMessage());
        }
    }
}
