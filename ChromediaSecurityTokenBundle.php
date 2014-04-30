<?php

namespace Chromedia\SecurityTokenBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Chromedia\SecurityTokenBundle\DependencyInjection\Compiler\ConfigurationCheckPass;

class ChromediaSecurityTokenBundle extends Bundle
{
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\HttpKernel\Bundle\Bundle::build()
     */
    public function build(ContainerBuilder $container)
    {
        //$container->addCompilerPass(new ConfigurationCheckPass());
    }
}
