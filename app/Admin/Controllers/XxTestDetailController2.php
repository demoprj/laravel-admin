<?php

namespace App\Admin\Controllers;

use App\Models\XxTestDetail;
use App\Admin\Selectable\XxTestSelectable;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Grid\Displayers\ContextMenuActions;

// php artisan admin:make XxTestDetailController --model=App\\Models\\XxTestDetail
class XxTestDetailController2 extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'XxTestDetail';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new XxTestDetail());
        $grid->model()->orderBy('id', 'DESC');

        // --------------------
        // normal
        // --------------------
        $grid->column('id', __('Id'))->sortable();
        // $grid->column('testId', __('TestId'));
        // $grid->column('name', __('Name'));
        // $grid->column('name', __('Name'))->limit(5);
        $grid->column('name', __('Name'))->substr(0, 5);
        $grid->column('value', __('Value'));
        // $grid->column('meta', 'Meta')->help('json');     // 显示JSON内嵌字段
        $grid->column('meta->a', 'key_in_json');         // 显示JSON内嵌字段


        // --------------------
        // relation
        // --------------------
        $grid->column('xxTest.name', 'xxTest.name')->help('relation');
        $grid->xxTest()->value()->help('relation');


        // --------------------
        // selectalbe
        // --------------------
        $grid->column('testId', 'XxTestId')->display(function () {
            return '111';
        })->belongsTo(XxTestSelectable::class)->help('selectalbe');

        // --------------------
        // action style
        // --------------------
        $grid->setActionClass(ContextMenuActions::class);

        // --------------------
        // suffix
        // --------------------
        $grid->column('memo', __('Memo'))->editable();
        $grid->column('created_by', __('Created by'))->replace([0 => '']);
        // $grid->column('updated_by', __('Updated by'));
        // $grid->column('deleted_by', __('Deleted by'));
        $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        // $grid->column('deleted_at', __('Deleted at'));
        // $grid->column('visible', __('Visible'));
        // $grid->column('status', __('Status'));
        $grid->status('Status')->xx_formatter_status()->help('extension');


        // --------------------
        // total
        // --------------------
        // $grid->column('value', 'Total')->totalRow();
        $grid->column('value', 'Total')->totalRow(function ($value) {
            return "<span class='text-danger text-bold'><i class='fa fa-yen'></i> {$value}</span>";
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(XxTestDetail::findOrFail($id));

        // --------------------
        // normal
        // --------------------
        $show->field('id', __('Id'));
        $show->field('testId', __('TestId'));
        $show->field('name', __('Name'));
        $show->field('value', __('Value'));
        // $show->field('meta', __('Meta'));
        $show->meta('Meta')->json();
        $show->field('memo', __('Memo'));
        $show->field('visible', __('Visible'));
        // $show->field('status', __('Status'));
        $show->field('created_by', __('Created by'));
        $show->field('updated_by', __('Updated by'));
        $show->field('deleted_by', __('Deleted by'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        // --------------------
        // relation
        // --------------------
        $show->field('xxTest.name', 'xxTest.name');
        $show->xxTest()->value();

        // --------------------
        // suffix
        // --------------------
        $show->status('状态')->using(['0' => '无效', '1' => '有效']);

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new XxTestDetail());

        // --------------------
        // normal
        // --------------------
        // $form->number('testId', __('TestId'));
        $form->text('xxTest.name', 'TestIdNane');
        $form->text('name', __('Name'));
        $form->number('value', __('Value'));
        $form->text('meta', __('Meta'));
        $form->text('memo', __('Memo'));
        $form->switch('visible', __('Visible'))->default(1);
        // $form->switch('status', __('Status'))->default(1);
        // $form->number('created_by', __('Created by'));       // 联动写入，不允许手动写入
        // $form->number('updated_by', __('Updated by'));       // 联动写入，不允许手动写入
        // $form->number('deleted_by', __('Deleted by'));       // 联动写入，不允许手动写入

        // --------------------
        // suffix
        // --------------------
        $form->select('status', '状态')->options([0 => '无效', 1 => '有效'])->default(1)->required();

        return $form;
    }
}
