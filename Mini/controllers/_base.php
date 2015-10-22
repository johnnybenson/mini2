<?php

namespace Mini\controllers;

use ReflectionClass;

class _base
{
    use \Mini\helpers\String;
    use \Mini\helpers\Options;

    public $template = '';
    public $template_data = array();

    public $format = 'HTML';

    public function __construct($opt)
    {
        $this->app = self::get($opt, 'app', false);
        $this->request_params = self::get($opt, 'request_params', array());

        if (!$this->app) {
            echo "Something awful happened...";
            exit;
        }

        $this->view();
        $this->render();
    }

    public function view()
    {

    }

    protected function get_template()
    {
        if (!empty($this->template)) {
            return $this->template;
        }
        // TODO: Check if view exists or 404
        $reflect = new ReflectionClass($this);
        return self::camel2whatever($reflect->getShortName(), '-') . '.twig';
    }

    protected function get_template_data()
    {
        if (!empty($this->template_data)) {
            return $this->template_data;
        }
        return array();
    }

    public function render()
    {
        if ($this->format === 'HTML') {
            $this->app->render(
                $this->get_template(),
                $this->get_template_data()
            );
        } elseif ($this->format === 'JSON') {
            $this->app->contentType('application/json;charset=utf-8');
            echo json_encode($this->get_template_data());
            exit;
        }
    }
}
