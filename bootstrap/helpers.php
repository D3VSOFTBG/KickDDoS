<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

function setting($name)
{
    if (Cache::has($name))
    {
        return Cache::get($name);
    }
    else
    {
        Cache::forever($name, Setting::where('name', $name)->pluck('value')->first());
        return Cache::get($name);
    }
}
function kickddos_encrypt($unencrypted_password)
{
    // Store the cipher method
    $ciphering = "AES-256-CBC";

    // Use OpenSSL Encryption method
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = config('kickddos.iv');

    // Store the encryption key
    $encryption_key = config('app.key');

    return openssl_encrypt($unencrypted_password, $ciphering, $encryption_key, $options, $encryption_iv);
}
function kickddos_decrypt($encrypted_password)
{
    // Store the cipher method
    $ciphering = "AES-256-CBC";

    // Use OpenSSL Encryption method
    $options = 0;

    // Non-NULL Initialization Vector for decryption
    $decryption_iv = config('kickddos.iv');

    // Store the decryption key
    $decryption_key = config('app.key');

    return openssl_decrypt($encrypted_password, $ciphering, $decryption_key, $options, $decryption_iv);
}
function if_null($var)
{
    if($var == null)
    {
        return 'No';
    }
    else
    {
        return $var;
    }
}
function is_admin($is_admin)
{
    if($is_admin == 1)
    {
        return 'Admin';
    }
    else
    {
        return 'No';
    }
}
function set_mail_config()
{
    $set_mailers_smtp = [
        'transport' => setting('MAIL_MAILER'),
        'host' => setting('MAIL_HOST'),
        'port' => setting('MAIL_PORT'),
        'encryption' => setting('MAIL_ENCRYPTION'),
        'username' => setting('MAIL_USERNAME'),
        'password' => kickddos_decrypt(setting('MAIL_PASSWORD')),
        'timeout' => null,
    ];
    $set_from = [
        'address' => setting('MAIL_FROM_ADDRESS'),
        'name' => setting('TITLE'),
    ];

    Config::set('mail.mailers.smtp', $set_mailers_smtp);
    Config::set('mail.from', $set_from);
}
function null_to_0($var)
{
    if($var == NULL)
    {
        return 0;
    }
    else
    {
        return $var;
    }
}
