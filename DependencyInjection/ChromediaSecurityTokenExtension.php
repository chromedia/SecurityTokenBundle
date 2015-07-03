<?php

namespace Chromedia\SecurityTokenBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ChromediaSecurityTokenExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('listeners.yml');

        // add the authorization header key parameter
        $container->setParameter($this->getAlias().'.authorization_header_key', $config['authorization_header_key']);

        $container->setParameter($this->getAlias().'.access_key_request_parameter', $config['access_key_request_parameter']);
        $container->setParameter($this->getAlias().'.access_token_request_parameter', $config['access_token_request_parameter']);

        $container->setParameter($this->getAlias().'.dev_access_key', $config['dev_access_key']);
        $container->setParameter($this->getAlias().'.dev_access_token', $config['dev_access_token']);

        // add service for token_provider, set it an alias since we require that this will be a defined service already
        $container->setAlias($this->getAlias().'.token_provider', $config['token_provider']);

        $container->setParameter($this->getAlias().'.token_expiration', (int)$config['token_expiration']);
    }
}
