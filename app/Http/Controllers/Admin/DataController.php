<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helper\HelperFile;
use App\Http\Requests\Admin\DataRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataController extends Controller
{
    // check user birthday
    public function main(){
        $user_birthday = User::find(auth()->user()->id)->data;

        if (Carbon::parse($user_birthday)->isBirthday() ){
           $message = "happy birthday";
            return view('Dashboard.index',compact('message'));
        }
        return view('Dashboard.index');
    }
    public function index()
    {
        $users = User::whereType('user')->get();
        return view('Dashboard.User.all',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataRequest $request)
    {
        try {
            $NewUser =User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "data" => $request->data
            ]);
            return redirect()->route('all.user');
        }catch (\Exception $ex){
            return $ex->getMessage();
        }

    }


    public function update(Request $request,$id)
    {
        try {
            $user = User::find($id);
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "data" => $request->data
            ]);
            return redirect()->route('all.user');
        }catch (\Exception $ex){
            return $ex->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
             $user->delete();
            return redirect()->route('all.user');
        }catch (\Exception $ex){
            return $ex->getMessage();
        }
    }
}
