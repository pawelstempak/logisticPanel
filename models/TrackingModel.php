<?php
/* models/TrackingModel.php */

namespace app\models;
use \PDO;
use app\core\Application;
use app\models\SendersModel;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Regex;
use GuzzleHttp\Client;


class TrackingModel
{
    public $senders;

    public function loadTrackingList()
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    SELECT *
                                    FROM orders
        ');
        $db_request->execute();
        
        $trackinglist = $db_request->fetchAll(PDO::FETCH_ASSOC);

        return $trackinglist;
    }

    public function loadNewTrackingForm()
    {
        global $twig;
        
        $this->senders = new SendersModel();
        $senders = $this->senders->loadSendersList();
        foreach($senders as $sender)
        {
            $senders_list[$sender['name']] = $sender['sender_id'];
        }
        $validator = Validation::createValidator();
        $formFactory = Forms::createFormFactoryBuilder()
        ->addExtension(new ValidatorExtension($validator))
        ->getFormFactory();
        $form = $formFactory->createBuilder(FormType::class, null, ['action'=> 'newtracking', 'method'=>'POST'])
            ->add('tracking', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '^GK[0-9]{9}^'
                    ]),
                ],
            ])
            ->add('sender_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '^SN[0-9]{9}^'
                    ]),
                ],
            ])
            ->add('sender_id', ChoiceType::class, [
                'choices'  => $senders_list,
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                ],
            ])                         
            ->add('recipient_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '^RN[0-9]{9}^'
                    ]),
                ],
            ])
            ->add('customer_number', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex([
                        'pattern' => '^CN[0-9]{9}^'
                    ]),
                ],
            ])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Create' => '1',
                    'Transport' => '2',
                    'Relisation' => '3',
                    'Cancel' => '4',
                    'Complete' => '5',
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                ],
            ])            
            ->getForm();
            $form->handleRequest();
            $formfactory['render'] = $twig->render('newtracking.php.twig', [
                'form' => $form->createView(),
                'senderslist' => $this->senders->loadSendersList()
            ]);
            $formfactory['form'] = $form;
        return $formfactory;
    }

    public function deleteTracking($getBody)
    {
        $db_request = Application::$core->con->pdo->prepare('
                                                            DELETE FROM `orders`
                                                            WHERE id=:id
        ');
        return $db_request->execute(["id" => $getBody['block1']]);
    }
   
    public function SaveNewTracking($getBody)
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    INSERT INTO `orders` (tracking, sender_number, sender_id, recipient_number, customer_number, status)
                                    VALUES (:tracking, :sender_number, :sender_id, :recipient_number, :customer_number, :status)
        ');
        $db_request->execute(
                    array(
                        "tracking" => $getBody['tracking'],
                        "sender_number" => $getBody['sender_number'],
                        "sender_id" => $getBody['sender_id'],
                        "recipient_number" => $getBody['recipient_number'],
                        "customer_number" => $getBody['customer_number'],
                        "status" => $getBody['status']
                    )
                );
        
        $db_request = Application::$core->con->pdo->prepare('
                                                            SELECT LAST_INSERT_ID()
                                                            ');
        $db_request->execute();
        
        $last_tracking_id = $db_request->fetch();
        return $last_tracking_id;
    }    

    public function senderPhone($id) //Phone number from `senders` database table
    {
        $phone = '+48166753492';
        return $phone;
    }

    public function sendNewStatus($status, $last_id)
    { 
        $db_request = Application::$core->con->pdo->prepare('
                SELECT *
                FROM `orders`
                WHERE id = :id
        ');
        $db_request->execute(["id" => $last_id]);

        $order = $db_request->fetch(PDO::FETCH_ASSOC);

        if($order['sender_sub']==1)
        {
            $client = new Client([
                'base_uri' => 'http://httpbin.org',
                'timeout'  => 2.0,
            ]);
            $response = $client->request('GET', 'http://httpbin.org/get', [
                'form_params' => [
                    'status' => $status,
                    'sender_phone' => $this->senderPhone($last_id)
                ]
            ]);            
        }
        if($order['recipient_sub']==1)
        {
            $client = new Client([
                'base_uri' => 'http://httpbin.org',
                'timeout'  => 2.0,
            ]);
            $response = $client->request('GET', 'http://httpbin.org/get', [
                'form_params' => [
                    'status' => $status,
                    'sender_phone' => $this->senderPhone($last_id)
                ]
            ]);            
        }     
        if($order['customer_sub']==1)
        {
            $client = new Client([
                'base_uri' => 'http://httpbin.org',
                'timeout'  => 2.0,
            ]);
            $response = $client->request('GET', 'http://httpbin.org/get', [
                'form_params' => [
                    'status' => $status,
                    'sender_phone' => $this->senderPhone($last_id)
                ]
            ]);            
        }              
    }
}