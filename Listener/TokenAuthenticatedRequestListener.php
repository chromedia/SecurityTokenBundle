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
use Chromedia\SecurityTokenBundle\Provider\AccessTokenProviderInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
/**
 * 
 */
class TokenAuthenticatedRequestListener
{
    /**
     * @var AccessTokenProviderInterface
     */
    private $tokenProvider;
    
    private $authorizationHeaderKey;
    
    private $accessKeyRequestParameter;
    
    private $accessTokenRequestParameter;
    
    public function setTokenProvider(AccessTokenProviderInterface $v)
    {
        $this->tokenProvider = $v;
    }
    
    public function setAuthorizationHeaderKey($v)
    {
        $this->authorizationHeaderKey = $v;
    }
    
    public function setAccessTokenRequestParameter($v)
    {
        $this->accessTokenRequestParameter = $v;
    }
    
    public function setAccessKeyRequestParameter($v)
    {
        $this->accessKeyRequestParameter = $v;
    }
    
    public function onKernelController(FilterControllerEvent $event) 
    {
        $controller = $event->getController();
        
        if (!is_array($controller)) {
        	return;
        }
        
        if ($controller[0] instanceof TokenAuthenticatedController) {

            $request = $event->getRequest();

            // key and token are in request parameters
            $accessKey = $request->get($this->accessKeyRequestParameter, null);
            $accessToken = $request->get($this->accessTokenRequestParameter, null);

            if (!$accessToken) {
                // check in headers
                if($headers = $request->headers->get($this->authorizationHeaderKey, ''))
                    list($accessKey,$accessToken) = $this->parseCustomHeaders($headers);
            }

            $verifiedToken = $this->tokenProvider->loadToken($accessToken, $accessKey);
            if ($verifiedToken) {
                return;
            }

            // request was not authenticated
            throw new AccessDeniedHttpException('Not authorized to access this resource');
        }
    }

    public function parseCustomHeaders($headers)
    {
        $authorization = base64_decode($headers);

        return explode(':',$authorization);
    }
}