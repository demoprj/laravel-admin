<?php

namespace App\Admin\Selectable;

use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;
use App\Models\XxTestDetail;

class XxTestDetailSelectable extends Selectable
{
    public $model = XxTestDetail::class;
    public $perPage = 10;

    // popup view in list page
    public function make()
    {
        $this->model()->where('status', 1);
        $this->disableTools(false);
        $this->disableFilter(false);
        $this->filter(function (Filter $filter) {
            $filter->disableIdFilter();
            $filter->like('name', 'TestDetailName');
            $filter->equal('xxTest.name', 'TestName');
        });
        $this->column('id', 'ID');
        $this->column('name', 'Name');
        $this->column('value', 'Value');
    }

    // disp in list page
    public static function display()
    {
        // Todo
    }
}
