<?php

use App\Setting;
use Illuminate\Support\Facades\Cache;

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
