<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use phpDocumentor\Reflection\Type;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration/utilisateurs/", name="users")
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('administration/users.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/administration/utilisateurs/ajout/", name="user_add")
     */
    public function register(Swift_Mailer $mailer, Request $request, TokenGeneratorInterface $tokenGenerator){

        $form = $this->createFormBuilder()
            ->add('username', null, ['label' => 'Nom d\'utilisateur', 'required' => true])
            ->add('email', EmailType::class, ['label' => 'Adresse Email', 'required' => true])
            ->add('admin', CheckboxType::class, ['label' => 'Administrateur', 'required' => false])
            ->add('submit', SubmitType::class, ['label' => 'Ajouter'])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            dump($data);
            if(count($this->getDoctrine()->getRepository(User::class)->findBy(['emailCanonical' => $data['email']])) == 0){
                $user = new User();
                $user->setEnabled(false);
                $user->setEmail($data['email']);
                $user->setEmailCanonical($user->getEmail());
                $user->setUsername($data['username']);
                $user->setEmailCanonical($user->getUsername());
                $user->setPassword('');
                $user->setConfirmationToken($tokenGenerator->generateToken());

                if($data['admin']){
                    $user->setRoles(['ROLE_ADMIN']);
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);

                $em->flush();

                $message = (new \Swift_Message('Création de votre compte sur le dashboard KPI'))
                    ->setFrom(getenv('EMAIL'))
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->renderView(
                            'emails/create_account.html.twig',[
                                'username' => $user->getUsername(),
                                'token' => urlencode($user->getConfirmationToken()),
                                'serializedEmail' => urlencode($user->getEmailCanonical()),
                                'site_name' => getenv('SITENAME')
                            ]
                        ), 'text/html'
                    );
                $mailer->send($message);

                return $this->redirectToRoute('users');

            }else{
                $form->addError(new FormError('Cet adresse Email est déjà enregistrée.'));
            }
        }
        return $this->render('administration/add_user.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/utilisateurs/{id}/delete", name="user_delete")
     */
    public function delete($id)
    {

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $em = $this->getDoctrine()->getManager();

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('users');
    }

    /**
     * @Route("/administration/utilisateurs/{id}/edit", name="user_edit")
     */
    public function edit($id, Request $request){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $form = $this->createFormBuilder()
            ->add('username', null, [
                'label' => 'Nom d\'utilisateur',
                'required' => true,
                'attr' => [
                    'value' => $user->getUsername()
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse Email',
                'required' => true,
                'attr' => [
                    'value' => $user->getEmail()
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ]);

        if($user !== $this->getUser()){
            $form->add('admin', CheckboxType::class, [
                'label' => 'Administrateur',
                'required' => false,
                'attr' => [
                    'checked' => $user->hasRole('ROLE_ADMIN')
                ]
            ]);
        }
        $form = $form->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $user->setEmail($data['email']);
            $user->setEmailCanonical($data['email']);
            $user->setUsername($data['username']);
            $user->setUsernameCanonical($data['username']);

            if(isset($data['admin'])) {
                if ($data['admin']){
                    $user->addRole('ROLE_ADMIN');
                }else{
                    $user->removeRole('ROLE_ADMIN');
                }
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('users');
        }

        return $this->render('administration/edit_user.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
