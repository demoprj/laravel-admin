<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

// https://laravel-admin.org/docs/zh/1.x/model-grid-custom-actions#%E6%99%AE%E9%80%9A%E6%93%8D%E4%BD%9C
// php artisan admin:action ActionImport --name="导入"
class ActionImport extends Action
{
    protected $selector = '.action-import';

    public function handle(Request $request)
    {
        // $request ...
        $request->file('file');
        try {
            // do something ...
            return $this->response()->success('导入成功')->refresh();
            // return $this->response()->info('提示信息...');
            // return $this->response()->warning('警告信息...');
            // return $this->response()->success('Success！')->refresh();
            // return $this->response()->success('Success！')->redirect('/admin/users');
            // return $this->response()->success('Success！')->download('http://www.xxx.com/file.zip');
            // return $this->response()->topRight()->success('Success！')->refresh();
            // return $this->response()->bottomCenter()->error('Error！')->refresh();
            // return $this->response()->success('Success！')->timeout(3000)->refresh();
        } catch (\Exception $e) {
            return $this->response()->error('产生错误：' . $e->getMessage());
        }
    }

    public function form()
    {
        $this->file('file', '请选择文件');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default action-import">导入</a>
HTML;
    }

    // public function authorize($user, $model)
    // {
    //     return false;
    // }

    // public function authorize($user, Collection $collection)
    // {
    //     return false;
    // }
}
