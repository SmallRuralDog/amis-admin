<?php

namespace SmallRuralDog\AmisAdmin;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Response;
use SmallRuralDog\AmisAdmin\Models\AdminUser;
use SmallRuralDog\AmisAdmin\Models\Menu;
use Str;
use Validator;

class AmisAdmin
{

    public static array $css = [];
    public static array $js = [];
    public static array $baseJs = [];

    public static function css($css = null): View|Factory|array|Application
    {
        if (!is_null($css)) {
            return self::$css = array_merge(self::$css, (array)$css);
        }
        $css = array_merge(static::$css, []);
        $css = array_filter(array_unique($css));
        return view('amis-admin::partials.css', compact('css'));
    }

    public static function js($js = null): View|Factory|array|Application
    {
        if (!is_null($js)) {
            return self::$js = array_merge(self::$js, (array)$js);
        }
        $js = array_merge(static::$js, []);
        $js = array_filter(array_unique($js));
        return view('amis-admin::partials.js', compact('js'));
    }

    public static function baseJs($baseJs = null): View|Factory|array|Application
    {
        if (!is_null($baseJs)) {
            return self::$baseJs = array_merge(self::$baseJs, (array)$baseJs);
        }
        $baseJs = array_merge(static::$baseJs, []);
        $baseJs = array_filter(array_unique($baseJs));
        return view('amis-admin::partials.baseJs', compact('baseJs'));
    }

    public function response($data, $message = '', $code = 0, $headers = []): JsonResponse
    {
        $re_data = [
            'status' => $code,
            'msg' => $message,
        ];
        if ($data) {
            $re_data['data'] = $data;
        }
        return Response::json($re_data, 200, $headers);
    }


    public function responseMessage($message = '', $code = 0): JsonResponse
    {
        return $this->response([], $message, $code);
    }

    public function responseError($message = '', $code = 1): JsonResponse
    {
        return $this->response([], $message, $code);
    }


    public function getMenus(): array
    {
        $user = $this->user();
        if ($user?->isAdministrator()) {
            $list = Menu::query()->orderBy('order')->where('hidden', false)->get();
        } else {
            $userRolesData = $user?->roles()->with(['permissions.menus' => fn($q) => $q->where('hidden', false), 'menus' => fn($q) => $q->where('hidden', false)])->get();
            //权限绑定的菜单
            $permissionMenus = $userRolesData->pluck('permissions')->flatten()->pluck('menus')->flatten();
            //角色绑定的菜单
            $list = $userRolesData->pluck('menus')->flatten()->merge($permissionMenus)->unique('id')->filter(fn($item) => !$item->hidden)->sortBy('order');
        }

        $list = $list->map(function (Menu $menu) {
            if ($menu->uri_type == 'route') {
                $menu->uri = Str::start($menu->uri, '/');
            }

            $menu->active_menus = array_merge($menu->active_menus ?? [], [$menu->key]);

            return $menu;
        });


        return [
            'active_menus' => $list->pluck('active_menus', 'key')->toArray(),
            'menus' => arr2tree($list->toArray()),
        ];
    }

    public function validatorData(array $all, $rules, $message = []): \Illuminate\Validation\Validator
    {
        $validator = Validator::make($all, $rules, $message);
        if ($validator->fails()) {
            abort(400, $validator->errors()->first());
        }
        return $validator;
    }

    public function bootstrap()
    {
        require config('amis-admin.bootstrap', admin_path('bootstrap.php'));
    }

    public function user(): Authenticatable|AdminUser|null
    {
        return $this->guard()->user();
    }

    public function guard(): Guard|StatefulGuard
    {
        $guard = config('amis-admin.auth.guard') ?: 'admin';
        return Auth::guard($guard);
    }

    public function headerToolbar(Closure $builder = null)
    {
        $navbar = app('amis-admin.headerToolbar');
        $builder && $builder($navbar);
        return $navbar;
    }

    public function getHeaderToolbars()
    {
        return app('amis-admin.headerToolbar');
    }
}
