<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Models\XxTest;

// https://laravel-admin.org/docs/zh/1.x/model-grid-column-display#%E5%88%97%E6%93%8D%E4%BD%9C
// php artisan admin:action RowActionStar --grid-row --name="测试动作"
class RowActionStar extends RowAction
{
    public $name = '测试动作';

    public function handle(XxTest $model)
    {
        // update
        $model->star = (int) !$model->star;
        $model->save();

        // response
        $html = $model->star ? "<i class=\"fa fa-star\"></i>" : "<i class=\"fa fa-star-o\"></i>";
        $msg = $model->star ? '标星成功' : '取消标星';
        return $this->response()->html($html)->success($msg)->refresh();
    }

    public function display($star)
    {
        return $star ? "<i class=\"fa fa-star\"></i>" : "<i class=\"fa fa-star-o\"></i>";
    }
}
