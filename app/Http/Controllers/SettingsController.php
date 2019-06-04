<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a Settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        $settings = [];
        $settings[] = [
            'name' => 'name',
            'label' => 'Full Name',
            'type' => 'text',
            'item' => \Auth::user()->{'name'},
        ];

        $settings[] = [
            'name' => 'email',
            'label' => 'Email',
            'type' => 'email',
            'item' => \Auth::user()->{'email'},
        ];

        $settings[] = [
            'name' => 'bio',
            'label' => 'Bio',
            'type' => 'textarea',
            'item' => \Auth::user()->{'bio'},
        ];

        $selectOptions = \App\Language::all()->take(20)->map(function ($item) {
            $language = [
                'id' => $item->{'id'},
                'label' => $item->{'name'}
            ];
            return $language;
        });

        $userLanguages = \Auth::user()->{'languages'}->pluck('id');
        $settings[] = [
            'name' => 'languages',
            'label' => 'Languages',
            'type' => 'select',
            'items' => $userLanguages,
            'isList' => true,
            'selectOptions' => $selectOptions
        ];
        return view('user.settings', compact('settings'));
    }

    /**
     * Display a Settings page.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateSettings(Request $request)
    {
        if ($request->has('name')) {
            $name = $request->input('name');
            \Auth::user()->update(['name' => $name]);
        }

        if ($request->has('email')) {
            $email = $request->input('email');
            \Auth::user()->update(['email' => $email]);
        }

        if ($request->has('bio')) {
            $bio = $request->input('bio');
            \Auth::user()->update(['bio' => $bio]);
        }

        if ($request->has('languages')) {
            $languages = $request->input('languages');
            \Log::debug($languages);
            \Auth::user()->languages()->sync($languages);
        }


        return response()->json([
            'success' => true,
        ]);
    }

    public function uploadImage(Request $request)
    {
        $rules = [
            'image' => 'required',
        ];

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $img = Image::make($request->input('image'))->fit(200)->encode('jpg');

        $path = "users/" . \Str::snake(\Auth::user()->{'name'}) . time() . ".jpg";
        if (\Storage::disk('public')->put($path, $img, 'public')) {
            if (\Auth::user()->{'avatar'} != 'users/default.png') {
                \Storage::disk('public')->delete(\Auth::user()->{'avatar'});
            }
            \Auth::user()->{'avatar'} = $path;
            \Auth::user()->save();
            return response()->json([
                'success' => true,
                'path' => \Storage::url($path),
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }
}
