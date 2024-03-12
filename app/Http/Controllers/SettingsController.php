<?php

namespace App\Http\Controllers;

use App\Models\HeroImage;
use App\Models\Basic;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function basic()
    {
        $basic = Basic::first();
        return view('backend.settings.basic', ['basics' => $basic]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string',
            'site_tagline' => 'string',
            'footer_text.*' => 'required|string',
            'phone' => 'string',
            'email' => 'string',
            'facebook' => 'string',
            'instagram' => 'string',
            'twitter' => 'string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $basic = Basic::first();
        if (empty($basic)) {
            $basic = new Basic();
        }
        $basic->site_title = $request->site_title;
        $basic->site_tagline = $request->site_tagline;
        $basic->footer_text = $request->footer_text;
        $basic->phone = $request->phone;
        $basic->email = $request->email;
        $basic->facebook = $request->facebook;
        $basic->instagram = $request->instagram;
        $basic->twitter = $request->twitter;
        if ($request->hasFile('image')) {
            if ($basic->image) {
                $oldimagePath = public_path($basic->image);
                if (file_exists($oldimagePath)) {
                    unlink($oldimagePath);
                }
            }
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('backend/logos'), $imageName);
            $basic->image = 'logos/' . $imageName;
        }
        if ($basic->save()) {
            return redirect()->route('settings.basic');
        }
    }

    public function banner()
    {
        $heroimages = HeroImage::all();
        return view('backend.settings.banner', ['heroimages' => $heroimages]);
    }
    public function heroImageStore(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $heroimages = new HeroImage();
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('backend/heroImages'), $imageName);
            $heroimages->image = 'heroImages/' . $imageName;
        }
        if ($heroimages->save()) {
            return redirect()->route('settings.banner');
        }
    }
    public function heroImageDestroy($id)
    {
        $heroimages = HeroImage::find($id);
        if ($heroimages->delete()) {
            return redirect()->route('settings.banner');
        }
    }
}
