<?php


namespace App\Controller\Security;


use App\Entity\User;
use App\Form\RegisterType;
use App\Security\LoginAuthenticator;
use App\Services\Users\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegisterController extends AbstractController
{

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param LoginAuthenticator $loginAuthenticator
     * @param UserService $userService
     * @param GuardAuthenticatorHandler $guardAuthenticatorHandler
     * @return Response
     */
    public function registration(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        LoginAuthenticator $loginAuthenticator,
        UserService $userService,
        GuardAuthenticatorHandler $guardAuthenticatorHandler): Response {

        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        $user = new User();
        $register_form = $this->createForm(RegisterType::class, $user);
        $register_form->handleRequest($request);

        if($register_form->isSubmitted() && $register_form->isValid()) {

                $hash = $passwordEncoder->encodePassword($user, $user->getPassword());

                $userService
                    ->registerUser($user, $hash);

                $guardAuthenticatorHandler
                    ->authenticateUserAndHandleSuccess($user, $request, $loginAuthenticator, 'main');

                return $this->redirectToRoute('home');
        }

        return $this->render('security/register.html.twig', [
            'controller_name' => 'Inscription',
            'registerForm' => $register_form->createView()
        ]);

    }

}