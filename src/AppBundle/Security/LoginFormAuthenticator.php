<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\FormFactoryInterface;
use AppBundle\Form\LoginForm;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    private $formFactory;
    private $em;
    private $router;
    private $passwordEncoder;
    
    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router, UserPasswordEncoder $passwordEncoder)
    {
        $this->formFactory     = $formFactory;
        $this->em              = $em;
        $this->router          = $router;
        $this->passwordEncoder = $passwordEncoder;
    }
    
    
     /**
      * {@inheritDoc}
      * @see \Symfony\Component\Security\Guard\GuardAuthenticatorInterface::getCredentials()
      */
     public function getCredentials(Request $request)
     {
        $isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');
        
        if (!$isLoginSubmit) {
            // skip authentication
            return;
        }
        
        $form = $this->formFactory->create(LoginForm::class);
        $form->handleRequest($request);
        
        $data = $form->getData();
        $request->getSession()->set(Security::LAST_USERNAME, $data['_username']);
        
        return $data;
     }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Security\Guard\GuardAuthenticatorInterface::getUser()
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['_username'];
        
        return $this->em->getRepository('AppBundle:User')
            ->findOneBy(['email' => $username]);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Security\Guard\GuardAuthenticatorInterface::checkCredentials()
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];
        
        if ($this->passwordEncoder->isPasswordValid($user, $password)) {
            
            return true;
        }
        
        return false;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator::getLoginUrl()
     */
    protected function getLoginUrl()
    {
        return $this->router->generate('security_login');
    }
    
    /**
     * 
     */
    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('homepage');
    }
}

