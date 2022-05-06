<?php

namespace App\Admin\XxActions;

use Encore\Admin\Actions\Interactor\Form;
use Encore\Admin\Form\Field;

class XxForm extends Form
{
    public static $elements =  [
        'success', 'error', 'warning', 'info', 'question', 'confirm',
        'text', 'email', 'integer', 'ip', 'url', 'password', 'mobile',
        'textarea', 'select', 'multipleSelect', 'checkbox', 'radio',
        'file', 'image', 'date', 'datetime', 'time', 'hidden', 'multipleImage',
        'multipleFile', 'modalLarge', 'modalSmall',
    ];

    public static $elements_enhance =  [
        'divider',
        'decimal',
        'currency',
        // 'display',
        'xx_html',
    ];

    public function divider($title = '')
    {
        $field = new Field\Divider($title);
        $this->addField($field);
        return $field;
    }

    public function decimal($column, $label = '')
    {
        $field = new Field\Decimal($column, $label);
        $this->addField($field);
        return $field;
    }

    public function currency($column, $label = '')
    {
        $field = new Field\Currency($column, $label);
        $this->addField($field);
        return $field;
    }

    // public function display($column, $label = '')
    // {
    //     $field = new Field\Display($column, $label);
    //     $this->addField($field);
    //     return $field;
    // }

    public function xx_html($html, $arguments)
    {
        $field = new Field\Html($html, $arguments);
        $this->addField($field);
        return $field;
    }

    protected function addField(Field $field)
    {
        $elementClass = array_merge(['action'], $field->getElementClass());
        $field->addElementClass($elementClass);
        $field->setView($this->resolveView(get_class($field)));
        array_push($this->fields, $field);
        return $field;
    }

    protected function resolveView($class)
    {
        $path = explode('\\', $class);
        $name = strtolower(array_pop($path));
        if (in_array($name, Form::$elements)) {
            return "admin::actions.form.{$name}";
        } else {
            return '';
        }
    }
}
