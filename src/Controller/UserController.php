<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class UserController extends AbstractController
{
    /**
     * @Route("/register/finalize/{token}/{serialized_email}", name="finalize_registration")
     */
    public function finalizeInscription($token, $serialized_email, Request $request){

        $token = urldecode($token);
        $email = urldecode($serialized_email);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['emailCanonical' => $email]);
        if($user !== null){

            $form = $this->createFormBuilder()
                ->add('plainPassword', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les deux champs doivent correspondre',
                    'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                    'first_options'  => ['label' => 'Mot de passe'],
                    'second_options' => ['label' => 'Confirmez votre mot de passe'],
                ])
                ->add('submit', SubmitType::class, ['label' => 'Valider'])
                ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                dump($request);
                dump($user);

                $data = $form->getData();
                $user->setPlainPassword($data['plainPassword']);
                $user->setEnabled(true);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('confirmation_inscription');

            }else{
                if($token == $user->getConfirmationToken() && $user->getPassword() == '' && $user->isEnabled() == false){
                    return $this->render('user/finalize.html.twig', [
                        'form' => $form->createView(),
                        'user' => $user
                    ]);
                }else{
                    return new Response("", 404);
                }
            }
        }else{
            return new Response("", 404);
        }
    }

    /**
     * @Route("/register/confirm", name="confirmation_inscription")
     */
    public function confirmRegister(){
        return $this->render('user/confirmation_inscription.html.twig');
    }

}
