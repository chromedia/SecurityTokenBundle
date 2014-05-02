<?php
namespace Chromedia\SecurityTokenBundle\Provider;

interface AccessTokenProviderInterface
{
    public function loadToken($token, $key=null);
    
    public function generateToken($salt=null);
}