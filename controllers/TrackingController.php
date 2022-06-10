<?php
/* controllers/SendersController.php */

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Auth;
use app\models\TrackingModel;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class TrackingController extends Controller
{
    public $tracking;
    
    public function __construct()
    {
        $this->tracking = new TrackingModel();
    }

    public function trackinglist()
    {   
        $trackingList = $this->tracking->loadtrackingList();
        $params = [
            'trackinglist' => $trackingList
        ];
        return $this->render('trackinglist', $params);
    }

    public function edittracking(Request $request)
    {   
        $tracking = $this->tracking->loadTracking($request->getBody());
        $params = [
            'tracking' => $tracking
        ];
        return $this->render('edittracking', $params);
    }    

    public function deleteTracking(Request $request)
    {   
        $this->tracking->deleteTracking($request->getBody());
        $request->redirect('trackinglist');
    }        

    public function newtracking(Request $request)
    {  
        $trackingform = $this->tracking->loadNewTrackingForm();
        $form = $trackingform['form'];
        if($form->isSubmitted() && $form->isValid())
        {   
                $last_id = $this->tracking->saveNewTracking($form->getData());
                if($request->isPost())
                {
                    $data = $form->getData();
                    $response = $this->tracking->sendNewStatus($data['status'], $last_id['LAST_INSERT_ID()']);
                    var_dump($response);
                }
                $request->redirect('trackinglist');
        }
        $params = [
            'trackingform' => $trackingform['render']
        ];                    
        return $this->render('newtracking', $params);
    }  
}