<?php
/* controllers/SendersController.php */

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Auth;
use app\models\SendersModel;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
//use Symfony\Component\HttpFoundation\Request;

class SendersController extends Controller
{
    public $senders;
    
    public function __construct()
    {
        $this->senders = new SendersModel();
    }

    public function sendersList()
    {   
        $sendersList = $this->senders->loadSendersList();
        $params = [
            'senderslist' => $sendersList
        ];
        return $this->render('senderslist', $params);
    }

    public function editSender(Request $request)
    {   
        $sender = $this->senders->loadSender($request->getBody());
        $params = [
            'sender' => $sender
        ];
        return $this->render('editsender', $params);
    }    

    public function newSender(Request $request)
    {  
        $senderform = $this->senders->loadNewSendersForm();
        $form = $senderform['form'];
        if($form->isSubmitted() && $form->isValid())
        {   
                $this->senders->saveNewSender($form->getData());
                $request->redirect('senderslist');
        }
        $params = [
            'senderform' => $senderform['render']
        ];                    
        return $this->render('newsender', $params);
    }  
}