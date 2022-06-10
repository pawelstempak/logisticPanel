<?php
/* core/Application.php */

namespace app\core;
use app\core\Database;

class Application
{
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $con;
    
    public static Application $core;
    public ?Controller $controller = null;
    public Auth $auth;


    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        
        self::$core = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->auth = new Auth();
       
        $this->con = new Database();
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function getController()
    {
        $this->controller;
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function isAuth()
    {
        return $this->auth->Auth();
    }
}