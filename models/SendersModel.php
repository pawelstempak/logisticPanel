<?php
/* models/SendersModel.php */

namespace app\models;
use \PDO;
use app\core\Application;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class SendersModel
{
    public function loadSendersList()
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    SELECT *
                                    FROM senders
        ');
        $db_request->execute();
        
        $senderslist = $db_request->fetchAll(PDO::FETCH_ASSOC);

        return $senderslist;
    }

    public function loadNewSendersForm()
    {
        global $twig;
        $validator = Validation::createValidator();
        $formFactory = Forms::createFormFactoryBuilder()
        ->addExtension(new ValidatorExtension($validator))
        ->getFormFactory();
        $form = $formFactory->createBuilder(FormType::class, null, ['action'=> 'newsender', 'method'=>'POST'])
            ->add('name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('email', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Email(),
                    new NotBlank(),
                ],
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('city', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('address1', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('address2', TextType::class, ['required' => false])
            ->add('code', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->getForm();
            $form->handleRequest();
            $formfactory['render'] = $twig->render('newsender.php.twig', [
                'form' => $form->createView(),
            ]);
            $formfactory['form'] = $form;
        return $formfactory;
    }

    public function saveNewSender($getBody)
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    INSERT INTO `senders` (name, email, phone, address1, address2, city, code)
                                    VALUES (:name, :email, :phone, :address1, :address2, :city, :code)
        ');
        return $db_request->execute(
                    array(
                        "name" => $getBody['name'],
                        "email" => $getBody['email'],
                        "phone" => $getBody['phone'],
                        "address1" => $getBody['address1'],
                        "address2" => $getBody['address2'],
                        "city" => $getBody['city'],
                        "code" => $getBody['code']
                    )
                );
    }
    
    public function loadSender($getBody)
    {
        $db_request = Application::$core->con->pdo->prepare('
                                    SELECT id, name, email, description, signature, host, smtp_auth, username, password, port, from_field, replyto
                                    FROM `senders`
                                    WHERE id = :id
        ');
        $db_request->execute(array("id" => $getBody['block1']));
        
        $sender = $db_request->fetch(PDO::FETCH_ASSOC);

        return $sender;
    }    
}