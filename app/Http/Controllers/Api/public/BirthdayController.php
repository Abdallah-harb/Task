<?php

namespace App\Http\Controllers\Api\public;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BirthdayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_birthday = User::find(auth('api')->user()->id)->data;

        if (Carbon::parse($user_birthday)->isBirthday() ){
            $message = "happy birthday";
           return ResponseHelper::sendResponseSuccess([],Response::HTTP_OK,"Your birthday , celebrate");
        }
        return ResponseHelper::sendResponseSuccess([],Response::HTTP_OK,"Not BirthDay today it in " . Carbon::parse($user_birthday)->format('d-m'));
    }


}
