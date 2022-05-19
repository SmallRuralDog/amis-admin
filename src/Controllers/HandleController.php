<?php

namespace SmallRuralDog\AmisAdmin\Controllers;

use AmisAdmin;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Storage;

class HandleController extends Controller
{

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


    protected function upload(Request $request)
    {
        try {
            $file = $request->file('file');
            $type = $request->file('type');
            $path = $request->input('path', 'images');
            $uniqueName = $request->input('uniqueName', config('amis-admin.upload.uniqueName', false));
            $disk = config('amis-admin.upload.disk');
            $name = $file->getClientOriginalName();
            if ($uniqueName == "true" || $uniqueName) {
                $path = $file->store($path, $disk);
            } else {
                $path = $file->storeAs($path, $name, $disk);
            }
            $data = [
                'value' => $path,
                'filename' => $name,
                'url' => Storage::disk($disk)->url($path)
            ];
            return AmisAdmin::response($data);
        } catch (Exception $exception) {
            return AmisAdmin::responseError($exception->getMessage());
        }

    }

}
