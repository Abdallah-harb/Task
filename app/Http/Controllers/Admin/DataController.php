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
        if (Carbon::parse($user_birthday)->isBirthday()){
           $message = "happy birthday";
            return view('Dashboard.index',compact('message'));
        }
        return view('Dashboard.index');
    }

    public function index()
    {
        $users = User::whereType('user')->get();
        if(count($users) < 1){
            return "There are no User Yet .!";
        }
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
            $image = HelperFile::uploadImage($request->image,'image');
            $NewUser =User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "data" => $request->data,
                "image"=> $image
            ]);
            toastr()->success('Data has been saved successfully!', 'Congrats');
            return redirect()->route('all.user');
        }catch (\Exception $ex){
            toastr()->error('Oops! Something went wrong!', 'Oops!');
            return $ex->getMessage();
        }

    }


    public function update(DataRequest $request,$id)
    {

        try {
            $user = User::find($id);
            if(!$user){
                toastr()->error('Oops! Something went wrong!', 'Oops!');
                return redirect()->route('all.user');
            }
            if($request->hasFile('image')){
                $image = HelperFile::uploadImage($request->image,'image');
                $user->update([ "image"=> $image]);
            }
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "data" => $request->data
            ]);
            toastr()->success('Data has been Updated successfully!');
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
            toastr()->warning('User Deleted Successfully .!');
            return redirect()->route('all.user');
        }catch (\Exception $ex){
            return $ex->getMessage();
        }
    }
}
