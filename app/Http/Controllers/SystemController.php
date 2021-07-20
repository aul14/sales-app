<?php

namespace App\Http\Controllers;

use App\Utility;
use Illuminate\Http\Request;

class SystemController extends Controller
{

    public function index()
    {
        //
        $settings = Utility::settings();
        return view('settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        if (\Auth::user()) {

            if ($request->logo) {
                $request->validate(
                    [
                        'logo' => 'image|mimes:png',
                    ]
                );

                $logoName = 'logo.png';
                $path     = $request->file('logo')->storeAs('public/logo/', $logoName);
            }
            if ($request->favicon) {
                $request->validate(
                    [
                        'favicon' => 'image|mimes:png',
                    ]
                );
                $favicon = 'favicon.png';
                $path    = $request->file('favicon')->storeAs('public/logo/', $favicon);
            }

            if (!empty($request->title_text) || !empty($request->style_theme) || !empty($request->company_name)) {
                $post = $request->all();
                unset($post['_token']);
                foreach ($post as $key => $data) {
                    \DB::insert(
                        'insert into settings (`value`, `name`) values (?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                        [
                            $data,
                            $key,
                        ]
                    );
                }
            }

            return redirect()->back()->with('success', 'Setting successfully updated.');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function companyIndex()
    {
        if (\Auth::user('manage-setting')) {

            $settings = Utility::settings();

            return view('setting.company', compact('settings'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
