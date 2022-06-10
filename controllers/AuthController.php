<?php
/* controllers/AuthController.php */

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;
use app\core\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->isPost())
        {
            $user = new Auth();
            $user->SignIn($request->getBody());
            header('Location: /');    
        }

        $this->setLayout('auth');
        return $this->render('login');
    }

    public function logout()
    {
        $user = new Auth();
        $user->SignOut();
        header('Location: /');       
    }     

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();
        if($request->isPost())
        {
            $registerModel->loadData($request->getBody());

            if($registerModel->validate() && $registerModel->register())
            {
                return 'Success';
            }
            
            // echo "<pre>";
            // var_dump($registerModel->errors);
            // echo "</pre>";
            // exit;

            // $firstname = $request->getBody()['firstname'];
            // if(!$firstname)
            // {
            //     $errors['firstname'] = 'This field is required.';
            // }
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }    
}