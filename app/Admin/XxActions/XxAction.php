<?php

namespace App\Admin\XxActions;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use App\Admin\XxActions\XxForm as Form;

abstract class XxAction extends Action
{
    protected function initInteractor()
    {
        if ($hasForm = method_exists($this, 'form')) {
            $this->interactor = new Form($this);
        }
    }

    public function validate(Request $request)
    {
        if ($this->interactor instanceof Form) {
            $this->interactor->validate($request);
        }
        return $this;
    }

    public function __call($method, $arguments = [])
    {
        if (
                in_array($method, Form::$elements)
                ||
                in_array($method, Form::$elements_enhance)
            ) {
            return $this->interactor->{$method}(...$arguments);
        }
        throw new \BadMethodCallException("Method {$method} does not exist.");
    }

    public function render()
    {
        $this->addScript();
        $content = $this->html();
        if ($content && $this->interactor instanceof Form) {
            return $this->interactor->addElementAttr($content, $this->selector);
        }
        return $this->html();
    }
}
