<?php
/* core/Router.php */

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }    

    public function resolve()
    {
        $params = [];
        $getPath = $this->request->getPath();
        $path = '/'.$getPath[0];
        $method = $this->request->Method();  
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false) 
        {   
            Application::$core->layout = 'auth';
            $this->response->setStatusCode(404);
            return $this->renderView('_404', $params);
        }       

        if(is_string($callback))
        {
            return $this->renderView($callback, $params);
        }
        if(is_array($callback))
        {
            Application::$core->controller = new $callback[0]();
            $callback[0] = Application::$core->controller;
        }
        return call_user_func($callback, $this->request);
    }

    protected function layoutContent()
    {
        $layout = Application::$core->layout;
        if(Application::$core->controller) {
            $layout = Application::$core->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }
    
    protected function renderOnlyView($view, $params = [])
    {
        foreach($params as $key => $value) {
            $$key = $value; //double $ sign meaning that the value of $key, some string ex. 'email' is automaticaly a name of new variable $email
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
}
