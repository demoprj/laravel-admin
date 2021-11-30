<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;

// https://laravel-admin.org/docs/zh/1.x/model-grid-custom-actions#%E6%89%B9%E9%87%8F%E6%93%8D%E4%BD%9C
// php artisan admin:action BatchActionCopy1 --grid-batch --name="批量复制1"
class BatchActionCopy1 extends BatchAction
{
    public $name = '批量复制1';

    public function handle(Collection $collection)
    {
        foreach ($collection as $model) {
            // $model->replicate()->save();
        }

        // admin_toastr('Message...', 'success');
        // admin_toastr('Message...', 'info');
        // admin_toastr('Message...', 'warning');
        // admin_toastr('Message...', 'error');
        // admin_success('title', 'message...');
        // admin_warning('title', 'message...');
        // admin_error('title', 'message...');
        // admin_info('title', 'message...');

        return $this->response()->success('复制成功')->refresh();
    }
}
