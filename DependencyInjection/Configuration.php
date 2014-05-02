<?php

namespace Chromedia\SecurityTokenBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('chromedia_security_token');
        
        $rootNode->children()
            ->enumNode('encryption')
                ->values(array('md5', 'sha256'))
            ->end()
            ->scalarNode('token_provider')
                ->isRequired()
                ->cannotBeEmpty()
            ->end()
            ->scalarNode('authorization_header_key')
                ->isRequired()
                ->cannotBeEmpty()
            ->end()
            ->scalarNode('access_key_request_parameter')
                ->defaultValue('access_key')
            ->end()
            ->scalarNode('access_token_request_parameter')
                ->defaultValue('access_token')
            ->end()
        ;
        return $treeBuilder;
    }
}
