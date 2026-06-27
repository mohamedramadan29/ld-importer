<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\dashboard\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use Message_Trait, Upload_Images;

    public function index()
    {
        $setting = Setting::getSettings();
        return view('dashboard.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::getSettings();

        $setting->site_name = $request->site_name;
        $setting->site_description = $request->site_description;
        $setting->phone1 = $request->phone1;
        $setting->phone2 = $request->phone2;
        $setting->whatsapp = $request->whatsapp;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->google_map_link = $request->google_map_link;
        $setting->working_hours = $request->working_hours;
        $setting->facebook = $request->facebook;
        $setting->instagram = $request->instagram;
        $setting->twitter = $request->twitter;
        $setting->tiktok = $request->tiktok;
        $setting->youtube = $request->youtube;
        $setting->snapchat = $request->snapchat;
        $setting->linkedin = $request->linkedin;
        $setting->terms = $request->terms;
        $setting->about_us = $request->about_us;

        if ($request->hasFile('site_logo')) {
            $setting->site_logo = $this->saveImage($request->file('site_logo'), 'assets/uploads/settings');
        }

        $setting->save();

        return $this->success_message('تم حفظ الإعدادات بنجاح');
    }
}
