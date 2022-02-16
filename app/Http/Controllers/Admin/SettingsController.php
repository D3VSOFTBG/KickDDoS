<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
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
           'mail_mailer' => 'required|max:5000',
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
            [
                'name' => 'PRIVATE_KEY_PATH',
                'value' => $request->private_key_path,
            ],
        ];

        // MAIL MAILER
        $drivers = [
            'smtp',
            'sendmail',
            'mailgun',
            'ses',
            'log',
            'array',
            'failover',
        ];
        if(in_array($request->mail_mailer, $drivers))
        {
            $mail_mailer = [
                'name' => 'MAIL_MAILER',
                'value' => $request->mail_mailer,
            ];
            array_push($setting_values, $mail_mailer);
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
