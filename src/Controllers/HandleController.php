<?php

namespace SmallRuralDog\AmisAdmin\Controllers;

use AmisAdmin;
use App\Http\Controllers\Controller;
use Crypt;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Storage;

class HandleController extends Controller
{

    public function action()
    {
        try {
            $data = request()?->all();
            $validator = AmisAdmin::validatorData($data, [
                'action' => 'required|string',
                'class' => 'required|string',
                'params' => 'array',
                'data' => 'array',
            ]);
            if ($validator->fails()) {
                abort(400, $validator->errors()->first());
            }
            $class = Crypt::decryptString($data['class']);
            $action = $data['action'];
            $params = $data['params'];
            $data = $data['data'];
            $res = (new $class())->$action($params, $data);
            return $res ?? AmisAdmin::responseMessage('请求成功');
        } catch (Exception $e) {
            return AmisAdmin::responseError($e->getMessage());
        }
    }


    public function menu(): JsonResponse
    {
        $menus = AmisAdmin::getMenus();
        return AmisAdmin::response($menus);
    }

    public function headerToolbar(): JsonResponse
    {
        $toolbars = AmisAdmin::getHeaderToolbars();

        return AmisAdmin::response($toolbars);
    }

    public function uploadImage(Request $request): JsonResponse
    {
        try {
            AmisAdmin::validatorData($request->all(), [
                'file' => 'mimes:' . config('amis-admin.upload.mimes', 'jpeg,bmp,png,gif,jpg')
            ]);
            return $this->upload($request);

        } catch (Exception $exception) {
            return AmisAdmin::responseError($exception->getMessage());
        }
    }

    public function uploadFile(Request $request): JsonResponse
    {
        try {
            AmisAdmin::validatorData($request->all(), [
                'file' => 'mimes:' . config('amis-admin.upload.file_mimes', '')
            ]);
            return $this->upload($request);

        } catch (Exception $exception) {
            return AmisAdmin::responseError($exception->getMessage());
        }
    }


    protected function upload(Request $request)
    {
        try {
            $file = $request->file('file');
            $type = $request->file('type');
            $path = $request->input('path', 'images');
            $uniqueName = $request->boolean('unique_name', config('amis-admin.upload.uniqueName', false));
            $disk = config('amis-admin.upload.disk');
            $name = $file->getClientOriginalName();
            if ($uniqueName) {
                $path = $file->store($path, $disk);
            } else {
                $path = $file->storeAs($path, $name, $disk);
            }
            abort_if(!$path, 400, '上传失败');

            $url = Storage::disk($disk)->url($path);

            $data = [
                'value' => $path,
                'filename' => $name,
                'url' => $url,
                'link' => $url,
            ];
            return AmisAdmin::response($data);
        } catch (Exception $exception) {
            return AmisAdmin::responseError($exception->getMessage());
        }

    }

}
