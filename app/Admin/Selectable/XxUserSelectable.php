<?php

namespace App\Admin\Selectable;

use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;
use App\Models\XxUser;

class XxUserSelectable extends Selectable
{
    public $model = XxUser::class;
    public $perPage = 10;

    // popup view in list page
    public function make()
    {
        $this->model()->where('status', 1);
        $this->disableTools(false);
        $this->disableFilter(false);
        $this->filter(function (Filter $filter) {
            $filter->disableIdFilter();
            $filter->like('name', 'Name');
            $filter->like('memo', 'Memo');
        });
        $this->column('id', 'ID');
        $this->column('name', 'Name');
        $this->column('memo', 'Memo');
    }

    // // disp in list page
    // public static function display()
    // {
    //     return function ($value) {

    //         // If `$value` is an array, it means it is used in the `collaborators` column, and the user’s name field separated by a semicolon `;` is displayed
    //         if (is_array($value)) {
    //             return implode(';', array_column($value, 'name'));
    //         }

    //         // Otherwise it is used in the `author_id` column, which directly displays the user’s `name` field
    //         return $this->xxTest->name;
    //     };
    // }
}
