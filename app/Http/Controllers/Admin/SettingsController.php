<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    function render()
    {
        $settings_old = Setting::all();

        $settings = [];

        foreach($settings_old as $setting)
        {
            $settings[$setting['name']] = $setting['value'];
        }

        $data = [
            'settings' => $settings,
        ];

        return view('admin.settings', $data);
    }
    function post(Request $request)
    {
        $request->validate([
           'title' => 'required|max:5000',
           'mail_driver' => 'required|max:5000',
           'mail_host' => 'required|max:5000',
           'mail_port' => 'required|integer|max:5000',
           'mail_username' => 'required|max:5000',
           'mail_encryption' => 'required|max:5000',
           'mail_from_address' => 'required|email|max:5000',
        ]);

        $setting = new Setting();

        $setting_values = [
            [
                'name' => 'TITLE',
                'value' => $request->title,
            ],
            [
                'name' => 'MAIL_HOST',
                'value' => $request->mail_host,
            ],
            [
                'name' => 'MAIL_PORT',
                'value' => $request->mail_port,
            ],
            [
                'name' => 'MAIL_USERNAME',
                'value' => $request->mail_username,
            ],

            [
                'name' => 'MAIL_ENCRYPTION',
                'value' => $request->mail_encryption,
            ],
            [
                'name' => 'MAIL_FROM_ADDRESS',
                'value' => $request->mail_from_address,
            ],
        ];

        // MAIL DRIVER
        $drivers = [
            'smtp',
            'sendmail',
            'mailgun',
            'ses',
            'log',
            'array',
        ];
        if(in_array($request->mail_driver, $drivers))
        {
            $mail_driver = [
                'name' => 'MAIL_DRIVER',
                'value' => $request->mail_driver,
            ];
            array_push($setting_values, $mail_driver);
        }
        else
        {
            abort(403);
        }

        if(isset($request->description))
        {
            $description = [
                'name' => 'DESCRIPTION',
                'value' => nl2br(strip_tags($request->description)),
            ];
            array_push($setting_values, $description);
        }

        if(isset($request->mail_password))
        {
            $mail_password = [
                'name' => 'MAIL_PASSWORD',
                'value' => kickddos_encrypt($request->mail_password),
            ];
            array_push($setting_values, $mail_password);
        }

        $setting_index = 'name';

        batch()->update($setting, $setting_values, $setting_index);

        // Clear cache
        Cache::flush();

        return back();
    }
    function cache_flush()
    {
        Cache::flush();
        return back();
    }
}
