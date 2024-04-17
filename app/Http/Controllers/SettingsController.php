<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Basic;
use App\Models\Contact;
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
        $banner = Banner::all();
        return view('backend.settings.banner', ['heroimages' => $banner]);
    }

    public function heroImageStore(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'title' => 'nullable',
            'sub_title' => 'nullable',
            'button_text' => 'nullable',
            'button_link' => 'nullable',
        ]);

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->sub_title = $request->sub_title;
        $banner->button_text = $request->button_text;
        $banner->button_link = $request->button_link;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('backend/heroImages'), $imageName);
            $banner->image = 'heroImages/' . $imageName;
        }
        if ($banner->save()) {
            return redirect()->route('settings.banner');
        }
    }

    public function heroImageDestroy($id)
    {
        $banner = Banner::find($id);
        if ($banner->delete()) {
            return redirect()->route('settings.banner');
        }
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        if ($contact->save()) {
            return redirect()->route('fontend.index');
        }
    }

    public function contactShow()
    {
        $contacts = Contact::all();
        return view('backend.settings.contacts', ['contacts' => $contacts]);
    }

    public function contactDestroy($id)
    {
        $contacts = Contact::find($id);
        if ($contacts->delete()) {
            return redirect()->route('settings.contacts');
        }
    }
}
