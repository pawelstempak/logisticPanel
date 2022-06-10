<?php
/* core/Request.php */

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $path = substr($path,'1');
        $path = explode('/', $path);
        return $path;
    }

    public function Method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }    

    public function isGet()
    {
        return $this->Method() === 'get';
    }

    public function isPost()
    {
        return $this->Method() === 'post';
    }    

    public function getBody()
    {
        $body = [];
        if($this->Method() === 'get')
        {
            $GetPath = $this->getPath();            
            foreach($GetPath as $key => $value)
            {
                $body['block'.$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }        
        if($this->Method() === 'post')
        {
            foreach($_POST as $key => $value)
            {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }

    public function redirect($request)
    {
        header('Location: http://'.$_SERVER['SERVER_NAME'].'/'.$request);
    }
}