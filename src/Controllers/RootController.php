<?php

namespace SmallRuralDog\AmisAdmin\Controllers;

use AmisAdmin;
use App\Http\Controllers\Controller;

class RootController extends Controller
{

    public function index()
    {
        $config = [
            'name' => config('amis-admin.name'),
            'title' => config('amis-admin.title'),
            'apiBase' => admin_url("/"),
            'prefix' => config('amis-admin.route.prefix'),
            'loginLogo' => config('amis-admin.loginLogo'),
            'loginDesc' => config('amis-admin.loginDesc'),
            'copyright' => config('amis-admin.copyright'),
            'footerLinks' => config('amis-admin.footerLinks'),
        ];

        return view('amis-admin::root', ['config' => $config]);
    }
}
