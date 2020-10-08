<?php

namespace App\Controller;

use App\Form\LoginForm;
use App\Service\UserCommandUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Error\Error;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;
    /**
     * @var UserCommandUtil
     */
    private $userCommandUtil;

    /**
     * SecurityController constructor.
     * @param AuthenticationUtils $authenticationUtils
     * @param UserCommandUtil $userCommandUtil
     */
    public function __construct(AuthenticationUtils $authenticationUtils,UserCommandUtil $userCommandUtil)
    {
        $this->authenticationUtils = $authenticationUtils;
        $this->userCommandUtil = $userCommandUtil;
    }

    /**
     * @return Response
     * @Route("/login", name="login")
     */
    public function loginAction(): Response
    {
        $form = $this->createForm(LoginForm::class, [
            'email' => $this->authenticationUtils->getLastUsername(),
        ]);

        return $this->render('security/login.html.twig', [
            'last_username' => $this->authenticationUtils->getLastUsername(),
            'form' => $form->createView(),
            'error' => $this->authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response

     * @Route(path="/api/register",name="api_register",methods={"POST"})
     *
     */
    public function register(Request $request): Response
    {
        $newUserData['email']    = $request->get('username');
        $newUserData['password'] = $request->get('password');

        $this->userCommandUtil->create($newUserData['email'],$newUserData['password'],'ROLE_USER');

        return new Response(sprintf('User %s successfully created', $newUserData['email']));
    }

    /**
     * @Route("/logout", name="logout")
     * @Route("/api/logout", name="api_logout")
     */
    public function logoutAction(): void
    {
    }
}
