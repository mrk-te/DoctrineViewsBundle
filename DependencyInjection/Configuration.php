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
        $rootNode       = $treeBuilder->root('mte_doctrine_views');

        $rootNode->children()
            ->arrayNode('dbal')
                ->example(['default' => 'database_connection'])
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