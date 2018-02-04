<?php
/**
 * Created by PhpStorm.
 * User: teintum
 * Date: 14/12/2017
 * Time: 22:41
 */

namespace Mte\DoctrineViewsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder    = new TreeBuilder();
        $rootNode       = $treeBuilder->root('doctrine_views');

        $rootNode->children()
            ->arrayNode('dbal')
                ->example(
                    'ViewManager name => Doctrine\DBAL\Connection service'."\n".
                    '# \'default\' => \'database_connection\''."\n".
                    '# Generates a service mte.doctrine_views.manager.default connected to the database_connection DBAL service'
                )
                ->useAttributeAsKey('name')
                ->prototype('scalar')->end()->requiresAtLeastOneElement()
                ->defaultValue([
                    'default' => 'database_connection'
                ])
            ->end()
        ->end();

        return $treeBuilder;
    }
}