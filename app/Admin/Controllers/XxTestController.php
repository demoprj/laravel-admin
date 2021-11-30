<?php

namespace App\Admin\Controllers;

use App\Models\XxTest;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class XxTestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'XxTest';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new XxTest());

        $grid->column('id', __('Id'));
        $grid->column('bk', __('Bk'));
        $grid->column('number', __('Number'));
        $grid->column('name', __('Name'));
        $grid->column('value', __('Value'));
        $grid->column('ownerId', __('OwnerId'));
        $grid->column('star', __('Star'));
        $grid->column('misc', __('Misc'));
        $grid->column('memo', __('Memo'));
        $grid->column('visible', __('Visible'));
        $grid->column('status', __('Status'));
        $grid->column('created_by', __('Created by'));
        $grid->column('updated_by', __('Updated by'));
        $grid->column('deleted_by', __('Deleted by'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));

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
        $show = new Show(XxTest::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('bk', __('Bk'));
        $show->field('number', __('Number'));
        $show->field('name', __('Name'));
        $show->field('value', __('Value'));
        $show->field('ownerId', __('OwnerId'));
        $show->field('star', __('Star'));
        $show->field('misc', __('Misc'));
        $show->field('memo', __('Memo'));
        $show->field('visible', __('Visible'));
        $show->field('status', __('Status'));
        $show->field('created_by', __('Created by'));
        $show->field('updated_by', __('Updated by'));
        $show->field('deleted_by', __('Deleted by'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new XxTest());

        $form->number('bk', __('Bk'));
        $form->text('number', __('Number'));
        $form->text('name', __('Name'));
        $form->text('value', __('Value'));
        $form->number('ownerId', __('OwnerId'));
        $form->switch('star', __('Star'));
        $form->text('misc', __('Misc'));
        $form->text('memo', __('Memo'));
        $form->switch('visible', __('Visible'))->default(1);
        $form->switch('status', __('Status'))->default(1);
        $form->number('created_by', __('Created by'));
        $form->number('updated_by', __('Updated by'));
        $form->number('deleted_by', __('Deleted by'));

        return $form;
    }
}
