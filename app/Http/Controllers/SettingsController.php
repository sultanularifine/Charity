<?php

namespace App\Http\Controllers;

use App\Models\HeroImage;
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
        $heroimages = HeroImage::all();
        return view('backend.settings.banner', ['heroimages' => $heroimages]);
    }

    public function heroImageStore(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'title' => 'nullable',
            'sub_title' => 'nullable',
        ]);

        $heroimages = new HeroImage();
        $heroimages->title = $request->title;
        $heroimages->sub_title = $request->sub_title;
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
            // return redirect()->route('settings.contactShow');
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
