<?php
/*
 * @author Allejo Chris G. Velarde
 */
namespace Chromedia\SecurityTokenBundle\Listener;

use Chromedia\SecurityTokenBundle\Provider\TokenProvider;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpFoundation\Request;
use Chromedia\SecurityTokenBundle\Controller\TokenAuthenticatedController;
/**
 * 
 */
class TokenAuthenticatedRequestListener
{
    /**
     * @var TokenProvider
     */
    private $tokenProvider;
    
    private $authorizationHeaderKey;
    
    public function setTokenProvider(TokenProvider $tokenProvider)
    {
        $this->tokenProvider = $tokenProvider;
    }
    
    public function setAuthorizationHeaderKey($v)
    {
        $this->authorizationHeaderKey = $v;
    }
    
    public function onKernelController(FilterControllerEvent $event) 
    {
        $controller = $event->getController();
        
        if (!is_array($controller)) {
        	return;
        }
        
        if ($controller[0] instanceof TokenAuthenticatedController) {
        	
            $request = $event->getRequest();
        }
    }
}