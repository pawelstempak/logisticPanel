<?php
/* core/Controller.php */

namespace app\core;

class Controller 
{
    public string $layout = 'main';
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$core->router->renderView($view, $params);
    }
}