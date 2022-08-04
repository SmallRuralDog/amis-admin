<?php

namespace SmallRuralDog\AmisAdmin\Controllers;

use AmisAdmin;
use App\Http\Controllers\Controller;
use Exception;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use SmallRuralDog\AmisAdmin\Renderers\Button;
use SmallRuralDog\AmisAdmin\Renderers\Flex;
use SmallRuralDog\AmisAdmin\Renderers\Form\AmisForm;
use SmallRuralDog\AmisAdmin\Renderers\Form\Checkbox;
use SmallRuralDog\AmisAdmin\Renderers\Form\InputImage;
use SmallRuralDog\AmisAdmin\Renderers\Form\InputText;
use SmallRuralDog\AmisAdmin\Renderers\GridSchema;
use SmallRuralDog\AmisAdmin\Renderers\Page;
use Validator;

class AuthController extends Controller
{

    public function index(): JsonResponse
    {

        $login = AmisForm::make()
            ->title("登录")
            ->wrapWithPanel(false)
            ->api(route_get('amis-admin.login.index'))
            ->redirect(admin_route(config('amis-admin.auth.login_redirect')))
            ->body([
                InputText::make()->name('username')->label('用户名')->required(true)->placeholder("请输入用户名"),
                InputText::make()->name('password')->label('密码')->password()->required(true)->placeholder("请输入密码"),
                Checkbox::make()->name('remember')->label(" ")->option('自动登录')->value(config('amis-admin.auth.remember')),
                Flex::make()->items([
                    Button::make()->type('submit')->label('登录')->level('primary')->block(true)->size('lg'),
                ])

            ]);

        $login = GridSchema::make()->columns([$login]);

        return AmisAdmin::response($login);
    }

    public function store(Request $request)
    {
        try {
            $this->loginValidator($request->all())->validate();

            $credentials = $request->only([$this->username(), 'password']);
            $remember = $request->get('remember', false);

            if ($this->guard()->attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return AmisAdmin::response("登录成功");
            }

            abort(400, "用户名或密码错误");

        } catch (Exception $e) {
            return AmisAdmin::responseError($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(config('amis-admin.route.prefix'));
    }


    protected function loginValidator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            $this->username() => 'required',
            'password' => 'required',
        ]);
    }


    public function userSetting(Request $request): JsonResponse
    {
        if ($request->isMethod('post')) {
            try {
                $validated = AmisAdmin::validatorData($request->all(), [
                    'avatar' => 'string',
                    'username' => 'required',
                    'old_password' => 'required_with:new_password',
                    'new_password' => 'confirmed',
                ]);
                if ($validated->fails()) {
                    abort(400, $validated->errors()->first());
                }

                $avatar = $request->get('avatar');
                $name = $request->get('name');

                $old_password = $request->get('old_password');
                $new_password = $request->get('new_password');
                $user = $this->guard()->user();
                //验证旧密码是否正确
                if ($new_password) {
                    abort_if(!Hash::check($old_password, $user->password), 400, '旧密码错误');
                    $user->password = bcrypt($new_password);
                }
                if ($name) $user->name = $name;
                if ($avatar) $user->avatar = $avatar;

                $user->save();

                return AmisAdmin::response($user);
            } catch (Exception $e) {
                return AmisAdmin::responseError($e->getMessage());
            }

        }


        $form = AmisForm::make()
            ->data(AmisAdmin::user())
            //->resetAfterSubmit(true)
            ->api(route_get('amis-admin.userSetting'));
        $form->body([
            InputImage::make()->name('avatar')->label('头像'),
            InputText::make()->name('username')->label('用户名')->readOnly(true)->disabled(true),
            InputText::make()->name('name')->label('名称')->required(true)->placeholder("请输入名称"),
            InputText::make()->password()->name('old_password')->label('旧密码')->placeholder("请输入旧密码"),
            InputText::make()->password()->name('new_password')->label('密码')->placeholder("请输入密码"),
            InputText::make()->password()->name('new_password_confirmation')->label('确认密码')->placeholder("请输入确认密码"),
        ]);
        return AmisAdmin::response(Page::make()->title("个人设置")->body($form));

    }

    protected function username(): string
    {
        return 'username';
    }

    protected function guard()
    {
        return AmisAdmin::guard();
    }

}
