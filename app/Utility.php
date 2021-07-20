<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Utility extends Model
{
    //
    protected $table = 'settings';

    public static function settings()
    {
        $data = DB::table('settings');

        $data = $data->get();

        $settings = [
            "title_text" => "aulaja.COM",
            "style_theme" => "bg-theme bg-theme2",
            "company_name" => "aulaja.COM",
        ];

        foreach ($data as $row) {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function getValByName($key)
    {
        $setting = Utility::settings();
        if (!isset($setting[$key]) || empty($setting[$key])) {
            $setting[$key] = '';
        }
        return $setting[$key];
    }
}
