<?php

namespace App\Admin\Controllers;

use App\Models\XxTest;
use App\Models\XxUser;
use App\Admin\Selectable\XxUserSelectable;
use App\Admin\Renderable\ShowXxUser;
// use App\Admin\Selectable\XxTestDetailSelectable;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Table;
use App\Admin\Actions\RowActionStar;
use App\Admin\Actions\RowActionIssue;
use App\Admin\Actions\BatchActionCopy1;
use App\Admin\Actions\BatchActionCopy2;
use App\Admin\Actions\ActionImport;

// php artisan admin:make XxTestController --model=App\\Models\\XxTest
// php artisan admin:controller --model=App\\Models\\XxTest
// https://github.com/laravel-admin-extensions/helpers/blob/master/src/Scaffold/stubs/controller.stub
class XxTestController2 extends AdminController
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
        $grid->model()->orderBy('id', 'DESC');
        // $grid->model()->where('status', '=', 1);


        // $currentUser = Admin::user();

        // --------------------
        //  Header
        // --------------------
        // $grid->header(function ($query) {
        //     return 'header';
        // });

        // --------------------
        //  Search
        // --------------------
        $grid->quickSearch('name', 'value');

        // --------------------
        //  quick create
        // --------------------
        $grid->quickCreate(function (Grid\Tools\QuickCreate $create) {
            $create->text('name', 'Name');
            $create->text('value', 'Value');
        });

        // --------------------
        //  Filter
        // --------------------
        $grid->disableFilter(false);
        $grid->expandFilter();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name', '名称');
            $filter->between('created_at', '创建时间')->datetime();
            // if(request()->input('created_at.start') == null){
            //     request()->offsetSet('created_at.start', date('Y-m-d'));
            // }
            // $filter->between('created_at', '创建时间')->datetime()->default([date('Y-m-d'), '']);
            $filter->like('memo', '备注');
            if (!isset(request()->status)) {
                request()->offsetSet('status', 1);
            }
            $filter->equal('status', '状态')->select([1 => '有效', 0 => '无效'])->default(1);
        });

        // --------------------
        // normal
        // --------------------
        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name2'))->view('column.test001');
        // $grid->column('value', __('Value'));
        $grid->column('ownerId', __('OwnerId'));
        // $grid->column('json_column->key_in_json', 'key_in_json')->help('json');     // 显示JSON内嵌字段

        // --------------------
        // format
        // --------------------
        $grid->value('value_formatted1')->display(function ($value) {
            return $value . '.suffix1';
        });
        $grid->column('value_formatted2')->display(function () {
            return $this->value . '.suffix2';
        });
        $grid->column('column_not_in_table')->display(function () {
            return $this->name . '-' . $this->value;
        })->help('ex');
        $grid->column('test_name')->help('ex');


        // --------------------
        // relation
        // --------------------
        $grid->column('Details')->display(function () {
            return $this->xxTestDetails->count();
        })->replace([0 => ''])->badge('badge bg-blue')->help('relation');
        // $grid->column('xxTestDetails', 'xxTestDetails');
        $grid->column('xxTestDetails', 'xxTestDetails')->pluck('name')->help('relation');
        // $grid->column('xxTestDetails', 'xxTestDetails')->pluck('name')->implode('-');
        $grid->column('expand', 'expansion1')->expand(function ($model) {
            $details = $model->xxTestDetails()->get()->map(function ($detail) {
                return $detail->only(['id', 'name', 'created_at']);
            });
            return new Table(['ID', '名称', '创建时间'], $details->toArray());
        })->help('relation');
        $grid->column('expand2', 'expansion2')->display(function ($value, $column) {
            if ($this->xxTestDetails()->count() > 0) {
                return $column->expand(function ($model) {
                    $details = $model->xxTestDetails()->get()->map(function ($detail) {
                        return $detail->only(['id', 'name', 'created_at']);
                    });
                    return new Table(['ID', '名称', '创建时间'], $details->toArray());
                });
            } else {
                return '';
            }
            return new Table(['ID', '名称', '创建时间'], $details->toArray());
        })->help('relation');
        $grid->column('modal', 'expansion3')->modal(function ($model) {
            $details = $model->xxTestDetails()->get()->map(function ($detail) {
                return $detail->only(['id', 'name', 'created_at']);
            });
            return new Table(['ID', '名称', '创建时间'], $details->toArray());
        })->help('relation');
        $grid->column('modal2', 'expansion4')->display(function ($value, $column) {
            if ($this->xxTestDetails()->count() > 0) {
                return $column->modal(function ($model) {
                    $details = $model->xxTestDetails()->get()->map(function ($detail) {
                        return $detail->only(['id', 'name', 'created_at']);
                    });
                    return new Table(['ID', '名称', '创建时间'], $details->toArray());
                });
            } else {
                return '';
            }
            return new Table(['ID', '名称', '创建时间'], $details->toArray());
        })->help('relation');


        // --------------------
        // selectalbe
        // --------------------
        // $grid->column('id', 'Dtls')->display(function () {
        //     return '111';
        // })->belongsToMany(XxTestDetailSelectable::class)->help('selectalbe');


        // --------------------
        // action style
        // --------------------
        // $grid->setActionClass(ContextMenuActions::class);

        // --------------------
        // row action (grid-row)
        // --------------------
        $grid->column('star', '标星')->action(RowActionStar::class);
        $grid->actions(function ($actions) {
            $actions->add(new RowActionIssue());
        });

        // --------------------
        // batch action (grid-batch)
        // --------------------
        $grid->batchActions(function ($batch) {
            $batch->add(new BatchActionCopy1());
            // $batch->add(new BatchActionCopy2());
        });
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new BatchActionCopy2());
        });

        // --------------------
        // action
        // --------------------
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ActionImport());
        });


        // --------------------
        // suffix
        // --------------------
        // $grid->column('memo', __('Memo'))->editable();
        $grid->column('memo')->display(function ($value, $column) {
            if (($this->id % 2) == 0) {
                return $value;
            }
            return $column->editable();
        });
        // $grid->column('created_by', __('Created by'))->replace([0 => '']);
        // $grid->column('created_by')->modal(ShowXxUser::class);
        $grid->column('created_by_obj.name', '创建者');
        $grid->created_by_obj()->name('创建者2');
        // $grid->column('updated_by', __('Updated by'));
        // $grid->column('deleted_by', __('Deleted by'));
        $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        // $grid->column('deleted_at', __('Deleted at'));

        // $grid->column('visible', __('Visible'));
        // $grid->column('visible', 'visible1')->using([0 => '不可见', 1 => '可见']);
        $grid->column('visible', 'visible2')->using([0 => '不可见', 1 => '可见'], '未知')->dot([0 => 'danger', 1 => 'success'], 'warning');
        // $grid->column('status', __('Status'));
        // $grid->status('状态')->display(function ($status) {
        //     switch ($status) {
        //         case 0:
        //             return "<span class='label label-danger'>无效</span>";
        //             break;
        //         case 1:
        //             return "<span class='label label-success'>有效</span>";
        //             break;
        //     }
        // });
        $grid->status()->xx_formatter_status()->help('extension');
        // $grid->column('status')->displayUsing(\App\Admin\Extensions\XxStatus::class);


        // --------------------
        //  Footer
        // --------------------
        // $grid->footer(function ($query) {
        //     return 'footer';
        // });


        return $grid;
    }

    // public function show($id, Content $content)
    // {
    //     $item = XxTest::find($id);

    //     return $content->title('详情')
    //         ->description('简介')
    //         ->view('xxtest.show2', $item->toArray());
    // }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        // $content->body(Admin::show(XxTest::findOrFail($id)));
        // $show = new Show(XxTest::findOrFail($id));
        $record = XxTest::findOrFail($id);
        $show = new Show($record);


        // --------------------
        // normal
        // --------------------
        $show->field('id', __('Id'));
        $show->field('number', __('Number'));
        // $show->field('name', __('Name'));
        // $show->field('value', __('Value'));


        // --------------------
        // format
        // --------------------
        $show->name('name_formatted1')->as(function ($name) {
            return "<{$name}>1";
        });
        $show->field('value', 'value_formatted2')->as(function () {
            return "<{$this->value}>2";
        });
        $show->field('column_not_in_table')->as(function () {
            return $this->name . '-' . $this->value;
        })->help('ex');


        // --------------------
        // relation
        // --------------------
        // $show->field('ownerId', __('OwnerId'));
        $show->field('owner_obj.name', __('Owner'));


        // --------------------
        // suffix
        // --------------------
        $show->field('memo', __('Memo'))->label();
        $show->field('visible', __('Visible'));
        // $show->field('status', __('Status'));
        // $show->field('created_by', __('Created by'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_by', __('Updated by'));
        // $show->field('updated_at', __('Updated at'));
        // $show->field('deleted_by', __('Deleted by'));
        // $show->field('deleted_at', __('Deleted at'));
        $show->divider();
        $show->field('created_by_obj.name', '创建者');
        $show->created_at('创建时间');
        $show->field('updated_by_obj.name', '更新者');
        $show->updated_at('更新时间');
        $show->field('deleted_by_obj.name', '删除者');
        $show->deleted_at('删除时间');

        $show->divider();
        // $show->status('状态')->using(['0' => '无效', '1' => '有效']);
        $show->status('状态')->xx_formatter_status();

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
        if ($form->isEditing()) {
            $id = request()->route()->parameters()['xxtest2'];
            $record = XxTest::find($id);
        }
        // $form->ignore(['column1', 'column2', 'column3']);
        // $form->hidden('column4');
        // $form->setWidth(10, 2);
        // $form->setAction('admin/users');

        // $form->tab('tab1', function ($form) {
        //     $form->text('text1');
        // })->tab('tab2', function ($form) {
        //     $form->text('text2');
        // })->tab('tab3', function ($form) {
        //      $form->hasMany('obj3', function ($form) {
        //          $form->text('text3');
        //      });
        //   });


        // --------------------
        // normal
        // --------------------
        // $form->fieldset('基本信息', function (Form $form) {
        $form->divider('');
        if ($form->isCreating()) {
            $form->text('number', __('Number'))->required()->readonly()->value(xx_helper_generate_serial_number('TEST'));
        } else {
            $form->text('number', __('Number'))->required()->readonly();
        }
        $form->text('name', __('Name'))->required()->autofocus();
        $form->text('value', __('Value'))->default(10)->help('help');
        // $form->number('ownerId', __('OwnerId'))->attribute(['dusk' => '123456']);
        // if ($form->isEditing()) {
        //     $form->select('ownerId', '所有者')->options(
        //         XxUser::query()->pluck('name', 'uid AS id')
        //     )->default($form->model()->ownerId);
        //     // )->default($form->ownerId);
        // } else {
        //     $form->select('ownerId', '所有者')->options(
        //         XxUser::query()->pluck('name', 'uid AS id')
        //     );
        // }
        $form->belongsTo('ownerId', XxUserSelectable::class, '所有者');

        $form->text('memo', __('Memo'))->placeholder('请输入');
        if ($form->isEditing()) {
            $form->switch('visible', __('Visible'))->default($form->model()->visible)->readonly();
        } else {
            $form->switch('visible', __('Visible'))->default(1)->readonly();
        }
        // $form->switch('status', __('Status'))->default(1);
        // });


        // --------------------
        // format
        // --------------------
        $form->display('value_formatted2')->with(function () {
            return '--' . $this->value . '--2';
        });
        $form->display('column_not_in_table')->with(function () {
            return $this->name . '-' . $this->value;
        })->help('ex');

        // $form->fieldset('改动信息', function (Form $form) {
        // --------------------
        // relation
        // --------------------
        $form->divider('');
        // $form->display('created_by', __('创建者'));       // 联动写入，不允许手动写入
        // $form->display('created_at', '创建时间');         // 联动写入，不允许手动写入
        // $form->display('updated_by', __('修改者'));       // 联动写入，不允许手动写入
        // $form->display('updated_at', '修改时间');         // 联动写入，不允许手动写入
        // $form->display('deleted_by', __('删除者'));       // 联动写入，不允许手动写入
        // $form->display('deleted_at', '删除时间');         // 联动写入，不允许手动写入
        $form->display('created_by_obj.name', __('创建者'));
        $form->display('created_at', '创建时间');
        $form->display('updated_by_obj.name', __('修改者'));
        $form->display('updated_at', '修改时间');
        $form->display('deleted_by_obj.name', __('删除者'));
        $form->display('deleted_at', '删除时间');
        // });


        // --------------------
        // suffix
        // --------------------
        // $form->fieldset('状态信息', function (Form $form) {
        $form->divider('');
        if ($form->isEditing()) {
            $form->select('status', '状态')->options([0 => '无效', 1 => '有效'])->default($form->model()->status)->required();
        } else {
            $form->select('status', '状态')->options([0 => '无效', 1 => '有效'])->default(1)->required();
        }
        // });


        // --------------------
        // NestedForm
        // --------------------
        $form->divider('');
        $form->hasMany('xxTestDetails', function (Form\NestedForm $innerform) {
            // $innerform->text('id')->readonly();
            $innerform->text('name')->required();
            $innerform->number('value');
            // if ($innerform->isEditing()) {
            //     $innerform->datetime('created_at')->readonly();
            // } else {
            //     $innerform->datetime('created_at')->default(now());
            // }
        });


        // --------------------
        // test
        // --------------------
        $form->divider('');
        $form->text('datalist')->datalist([
            'key1' => 'value1',
            'key2' => 'value2',
        ]);
        // https://github.com/RobinHerbots/Inputmask
        $form->text('phone')->inputmask(['mask' => '999-9999-9999'])->icon('fa-phone');
        $form->text('card')->inputmask(['mask' => '9999-9999-9999-9999-999'])->icon('fa-credit-card');
        $form->textarea('comment')->rows(3);
        // $form->text('title')->pattern('[A-z]{3}');
        // $form->text('title')->rules('required|min:10');

        $form->radio('radio1')->options(['m' => 'Female', 'f' => 'Male'])->default('m');
        $form->radio('radio2')->options(['m' => 'Female', 'f' => 'Male'])->stacked();
        $form->radioButton('radio3')->options(['m' => 'Female', 'f' => 'Male'])->default('m');
        $form->radioCard('radio4')->options(['m' => 'Female', 'f' => 'Male'])->default('m');

        $form->checkbox('checkbox1')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
        $form->checkbox('checkbox2')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name'])->stacked();
        $form->checkbox('checkbox3')->options(function () {
            return [1 => 'foo', 2 => 'bar', 'val' => 'Option name'];
        });
        $form->checkbox('checkbox4')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name'])->canCheckAll();
        $form->checkboxButton('checkbox5')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
        $form->checkboxCard('checkbox6')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);

        $form->select('select1')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
        // $form->select('select2')->options('/api/users');
        $form->select('select3')->options(XxTest::all()->pluck("concat(id, '-', name) as name", 'id'));
        // $form->select('province')->options(...)->load('city', '/api/city');
        // $form->select('city');

        $form->multipleSelect('multipleSelect1')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);

        $form->listbox('listbox')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name'])->height(100);

        $form->email('email');
        $form->password('password');
        $form->url('url');
        $form->ip('ip');
        $form->mobile('mobile1');
        $form->mobile('mobile2')->options(['mask' => '999 9999 9999']);
        $form->color('color')->default('#ccc');
        $form->time('time1');
        $form->time('time2')->format('HH:mm:ss');
        $form->date('date1');
        $form->date('date2')->format('YYYY-MM-DD');
        // $form->timeRange($startTime, $endTime, 'Time Range');
        // $form->dateRange($startDate, $endDate, 'Date Range');
        // $form->datetimeRange($startDateTime, $endDateTime, 'DateTime Range');
        $form->currency('currency1');
        $form->currency('currency2')->symbol('￥');
        $form->number('number1');
        $form->number('number2')->max(100);
        $form->number('number3')->min(10);
        $form->rate('rate');
        // https://github.com/IonDen/ion.rangeSlider#settings
        $form->slider('slider')->options([
            'max'       => 100,
            'min'       => 1,
            'step'      => 1,
            'postfix'   => 'years old'
        ]);
        $states = [
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ];
        $form->switch('switch')->states($states);
        // //https://github.com/laravel-admin-extensions/latlong
        // $form->latlong('latitude', 'longitude', 'Position');


        $form->html('<h1>test</h1>', 'html');
        $form->tags('tag1,tag2', 'tags');
        $form->icon('icon', 'icon');
        $form->timezone('timezone', 'timezone');


        // $form->image($column[, $label]);
        // $form->image($column[, $label])->thumbnail('small', $width = 300, $height = 300);
        // $form->multipleImage($column[, $label]);

        // $form->file($column[, $label]);
        // $form->file($column[, $label])->downloadable();
        // $form->file($column[, $label])->move($dir, $name);
        // $form->file($column[, $label])->rules('mimes:doc,docx,xlsx');

        // // for ["foo", "Bar"]
        // $form->list('column_name');
        // // for json格式的二维数组
        // $form->table('column_name', function ($table) {
        //     $table->text('key');
        //     $table->text('value');
        //     $table->text('desc');
        // });



        // --------------------
        // linkage
        // --------------------

        // https://laravel-admin.org/docs/zh/1.x/model-form-linkage


        // --------------------
        // callback
        // --------------------

        // $form->submitted(function (Form $form) {
        //     //...
        // });
        // $form->saving(function (Form $form) {
        //     //...
        // });
        // $form->saved(function (Form $form) {
        //     //...
        // });
        // $form->deleting(function () {
        //     ...
        //     throw new \Exception('产生错误！！');
        // });

        // $form->deleted(function () {
        //     ...
        //     throw new \Exception('hahaa');
        // });


        // --------------------
        // scene
        // --------------------

        // if ($form->isCreating()) {
        //     // do something
        // }
        // if ($form->isEditing()) {
        //     // do something
        // }


        // --------------------
        // confirm
        // --------------------

        // $form->confirm('确定更新吗？', 'edit');
        // $form->confirm('确定创建吗？', 'create');
        // $form->confirm('确定提交吗？');


        // $form->tools(function (Form\Tools $tools) {
        //     $tools->disableList();
        //     $tools->disableDelete();
        //     $tools->disableView();
        //     $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        // });

        // $form->footer(function ($footer) {
        //     $footer->disableReset();
        //     $footer->disableSubmit();
        //     $footer->disableViewCheck();
        //     $footer->disableEditingCheck();
        //     $footer->disableCreatingCheck();
        // });


        return $form;
    }
}
