<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Banned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use PDO;
use PDOException;

class InstallController extends Controller
{
    function install_get()
    {
        return redirect(route('install.1'));
    }
    function install_1_get()
    {
        return view('install.1');
    }
    function install_1_post(Request $request)
    {
        $request->validate([
            'db_connection' => [
                'required',
                new Banned,
            ],
            'db_host' => [
                'required',
                new Banned,
            ],
            'db_port' => [
                'required',
                new Banned,
            ],
            'db_database' => [
                'required',
                new Banned,
            ],
            'db_username' => [
                'required',
                new Banned,
            ],
            'db_password' => [
                new Banned,
            ],
        ]);

        $ok = false;

        try
        {
            $connection = new PDO("mysql:host=$request->db_host;dbname=$request->db_database", $request->db_username, $request->db_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $ok = true;
        }
        catch (PDOException $e)
        {
            return back()->withErrors(['DB:', $e->getMessage()]);
        }

        if($ok)
        {
            env_update('DB_CONNECTION', $request->db_connection);
            env_update('DB_HOST', $request->db_host);
            env_update('DB_PORT', $request->db_port);
            env_update('DB_DATABASE', $request->db_database);
            env_update('DB_USERNAME', $request->db_username);
            env_update('DB_PASSWORD', $request->db_password);

            // // Migrate
            // Artisan::call('migrate:fresh', ['--force' => true]);
            // // Seed
            // Artisan::call('db:seed', ['--force' => true]);
            // // Generate App key
            // Artisan::call('key:generate', ['--force' => true]);

            return redirect(route('install.2'));
        }
        else
        {
            return back();
        }
    }
    function install_2_get()
    {
        return view('install.2');
    }
    function install_2_post()
    {
        // Migrate
        Artisan::call('migrate:fresh', ['--force' => true]);
        // Seed
        Artisan::call('db:seed', ['--force' => true]);
        // Generate App key
        Artisan::call('key:generate', ['--force' => true]);

        return redirect(route('install.3'));
    }
    function install_3_get()
    {
        return view('install.3');
    }
    function install_3_post(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = 1;

        if($request->password == $request->password_confirmation)
        {
            $user->password = Hash::make($request->password);
        }
        else
        {
            return back()->withErrors('The passwords do not match.');
        }

        $user->save();

        if(!file_exists(storage_path('.installed')))
        {
            // Create installed file
            File::put(storage_path('.installed'), 1);
        }

        return redirect(route('home'));
    }
}
