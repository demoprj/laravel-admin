<?php

namespace App\Admin\Extensions\Nav;

use Illuminate\Contracts\Support\Renderable;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use App\Models\XxTest;

class ShoppingCart implements Renderable
{
    public function render()
    {
        $res = Admin::grid(XxTest::class, function (Grid $grid) {
            $grid->setTitle('XxTest列表');
            // $grid->model()->where('status=1');
            $grid->disableCreateButton();
            $grid->paginate(10);
            $grid->disableActions(false);
            $grid->disableFilter(true);
            $grid->expandFilter();

            // $grid->filter(function ($filter) {
            //     $filter->disableIdFilter();
            //     $filter->like('name', 'Name');
            //     $filter->equal('status', 'Status')->select([0=>'无效', 1=>'有效'])->default(1);
            // });

            $grid->column('id', 'ID');
            $grid->column('name', 'Name');
            $grid->column('status', '数据状态')->using([0=>'无效', 1=>'有效']);
        });


        return <<<HTML
<li class="dropdown" id='nav_shoppingcart'>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-cart-arrow-down"></i>
    </a>
            <div class="dropdown-menu box box-solid" style="width: 700px;height: 400px;margin-bottom: 0;">
{$res->render()}
                购物车
            </div>
</li>
<script>
    $(document).on('click', '#nav_shoppingcart .dropdown-menu', function (e) {
        e.stopPropagation();
    });
</script>
HTML;
    }
}
