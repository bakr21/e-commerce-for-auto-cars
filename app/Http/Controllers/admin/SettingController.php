<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::first();

        if (!$settings) {
            $settings = new SiteSetting();
        }

        return view('admin.settings.generalsetting', compact('settings'));
    }

    public function update(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'map_link' => 'nullable|url',
            'phone_number' => 'nullable|string|max:20',
            'company_description' => 'required|string',
            'hotline' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'facebook_link' => 'nullable|url',
            'whatsapp_number' => 'nullable|string|max:20',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'working_hours' => 'nullable|string',
        ]);

        $settings = SiteSetting::first() ?? new SiteSetting();

        // Update the settings
        $settings->site_name = ['ar'=> $request->site_name_ar , 'en' => $request->site_name];
        $settings->map_link = $request->map_link;
        $settings->phone_number = $request->phone_number;
        $settings->company_description = ['ar'=> $request->company_description_ar , 'en' => $request->company_description];
        $settings->hotline = $request->hotline;
        $settings->address = ['ar'=> $request->address_ar , 'en' => $request->address];
        $settings->email = $request->email;
        $settings->facebook_link = $request->facebook_link;
        $settings->whatsapp_number = $request->whatsapp_number;
        $settings->twitter_link = $request->twitter_link;
        $settings->linkedin_link = $request->linkedin_link;
        $settings->working_hours = $request->working_hours;

        // Image handling
        if ($request->hasFile('site_image')) {

            if ($settings->site_image && file_exists(public_path('storage/images/' . $settings->site_image))) {
                unlink(public_path('storage/images/' . $settings->site_image));
            }


            $path = $request->file('site_image')->store('public/images');
            $settings->site_image = basename($path);
        }



        $settings->save();

        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully!');
    }
}
