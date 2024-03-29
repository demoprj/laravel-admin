<?php

namespace App\Admin\Controllers;

use App\Models\XxTest;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;

class XxTestController3 extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'XxTest';


    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            // ->description('xxx')
            // ->breadcrumb(
            //     ['text' => 'xxx', 'url' => '/xxx'],
            // )
            // ->view('xxx.show', $xxx->toArray())
            ->row(function ($row) {
                $row->column(10, $this->grid());
                $row->column(2, view('xxtest.sidebar'));
            });
    }

    public function show($id, Content $content)
    {
        return $content
            ->header('详情')
            ->description(' ')
            // ->body($this->detail($id));
            ->row(function ($row) use ($id) {
                $row->column(10, $this->detail($id));
                $row->column(2, view('xxtest.sidebar'));
            });
    }

    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑')
            ->description(' ')
            // ->body($this->form()->edit($id));
            ->row(function ($row) use ($id) {
                $row->column(10, $this->form()->edit($id));
                $row->column(2, view('xxtest.sidebar'));
            });
    }

    public function create(Content $content)
    {
        return $content
            ->header('新建')
            ->description(' ')
            // ->body($this->form());
            ->row(function ($row) {
                $row->column(10, $this->form());
                $row->column(2, view('xxtest.sidebar'));
            });
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new XxTest());

        $grid->column('id', __('Id'));
        $grid->column('number', __('Number'));
        $grid->column('name', __('Name'));
        $grid->column('value', __('Value'));
        $grid->column('ownerId', __('OwnerId'));
        $grid->column('star', __('Star'));
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
        $show->field('number', __('Number'));
        $show->field('name', __('Name'));
        $show->field('value', __('Value'));
        $show->field('ownerId', __('OwnerId'));
        $show->field('star', __('Star'));
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

        $form->text('number', __('Number'));
        $form->text('name', __('Name'));
        $form->text('value', __('Value'));
        $form->number('ownerId', __('OwnerId'));
        $form->switch('star', __('Star'));
        $form->text('memo', __('Memo'));
        $form->switch('visible', __('Visible'))->default(1);
        $form->switch('status', __('Status'))->default(1);
        $form->number('created_by', __('Created by'));
        $form->number('updated_by', __('Updated by'));
        $form->number('deleted_by', __('Deleted by'));

        return $form;
    }
}
