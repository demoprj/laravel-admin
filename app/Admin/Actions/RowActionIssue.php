<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

// https://laravel-admin.org/docs/zh/1.x/model-grid-custom-actions#%E5%BC%B9%E5%87%BA%E8%A1%A8%E5%8D%95
// php artisan admin:action RowActionIssue --grid-row --name="创建Issue"
class RowActionIssue extends RowAction
{
    public $name = '创建Issue';

    public function handle(Model $model, Request $request)
    {
        // input
        $request->get('type');
        $request->get('reason');

        // handle
        // do something ...

        // output
        return $this->response()->success('Issue已提交')->refresh();
    }

    public function form()
    {
        $type = [
            1 => '选项1',
            2 => '选项2',
            3 => '选项3',
        ];
        $this->checkbox('type', '类型')->options($type);
        $this->textarea('reason', '原因')->rules('required');
    }
}
