<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;

// https://laravel-admin.org/docs/zh/1.x/model-grid-custom-actions#%E6%89%B9%E9%87%8F%E6%93%8D%E4%BD%9C
// php artisan admin:action BatchActionCopy2 --grid-batch --name="批量复制2"
class BatchActionCopy2 extends BatchAction
{
    // public $name = '批量复制2';
    protected $selector = '.copy-items';


    public function handle(Collection $collection, Request $request)
    {
        foreach ($collection as $model) {
            // $model->replicate()->save();
        }

        return $this->response()->success('复制成功')->refresh();
    }

    public function form()
    {
        $this->checkbox('type', '类型')->options([]);
        $this->textarea('reason', '原因')->rules('required');
    }

    public function html()
    {
        return "<a class='copy-items btn btn-sm btn-danger'><i class='fa fa-info-circle'></i>复制2</a>";
    }
}
