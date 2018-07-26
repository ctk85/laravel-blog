<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use Image;

class ProfileController extends Controller
{

    /**
     * Auth middelware.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    /**
     * Update the user's avatar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request, $id)
    {
        $request->validate([
            'avatar' => 'required|image|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $user = User::findOrFail($id);
        
        try {
            $avatarName = $id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
            
            //Store
            $request->avatar->storeAs('avatars',$avatarName);

            //Resize
            $thumbnailpath = public_path('storage/avatars/'.$avatarName);
            $img = Image::make($thumbnailpath)->resize(120, null, function($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($thumbnailpath);
            
            $user->avatar = $avatarName;
            $user->save();
        } catch (\Exception $e) {

            $errors[] = $e->getMessage();
            return back()->withErrors($errors);
        }
        return back()->with('success','You have successfully uploaded a new image.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
