<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    //
    public function IndexSetting()
    {
        $setting = DB::table('settings_tbl')->where('id', 1)->select('id', 'choose_banner', 'choose_social', 'text_logo')->first();
        return view('admin.setting.overview', compact('setting'));
    }

    public function ChangeSystem(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data_change = [
                'choose_banner' => $request->choose_banner,
                'choose_social' => $request->choose_social,
                'text_logo' => $request->text_logo ?? 'DevC Blog'
            ];

            $UpdateSystem = DB::table('settings_tbl')->where('id', 1)->update($data_change);
            if ($UpdateSystem) {
                return redirect()->route('devC-overview')->with('success', 'Cập nhật hệ thống thành công');
            }
            return redirect()->route('devC-overview');

        }
    }
}
