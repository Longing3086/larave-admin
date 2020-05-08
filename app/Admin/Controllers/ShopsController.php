<?php

namespace App\Admin\Controllers;

use App\Shop;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Shop';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shop());

        $grid->id('ID')->sortable();
        $grid->name('商品名称');
        $grid->column('images','商品图片')->image('', 100, 100);
        $grid->price('价格');
        $grid->status('已上架')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->remark('备注');

        $grid->actions(function ($actions) {
            $actions->disableView();
//            $actions->disableDelete();
        });
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
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
        $show = new Show(Shop::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('images', __('Images'));
        $show->field('name', __('Name'));
        $show->field('price', __('Price'));
        $show->field('status', __('Status'));
        $show->field('remark', __('Remark'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Shop());

        $form->text('name', '商品名字')->rules('required');
        $form->image('images', '商品图片')->rules('required|image');
        $form->decimal('price', '商品价格')->rules('required|numeric|min:0.01');
        $form->switch('status', '是否上架')->options(['1' => '是', '0'=> '否'])->default('0');
        $form->text('remark', '备注');

        return $form;
    }
}
