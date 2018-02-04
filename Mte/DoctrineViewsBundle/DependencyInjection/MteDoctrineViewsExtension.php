<?php
/**
 * Created by PhpStorm.
 * User: teintum
 * Date: 14/12/2017
 * Time: 22:50
 */

namespace Mte\DoctrineViewsBundle\DependencyInjection;

use Mte\DoctrineViewsBundle\Doctrine\View\ViewManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;

class MteDoctrineViewsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if(!$container->hasParameter('mte.doctrine_views.manager.class')) {
            $container->setParameter('mte.doctrine_views.manager.class', ViewManager::class);
        }

        if(isset($config['dbal'])) {
            /*
            if(!$container->hasDefinition('app.dovecot_views.generator')) {
                $definition = new Definition(Views::class);
            }
            */
            foreach ($config['dbal'] as $name => $dbal) {
                //echo $name.' > '.$dbal;
                $definition = new Definition(
                    $container->getParameter('mte.doctrine_views.manager.class'),
                    [ new Reference($dbal) ]
                );

                $container->setDefinition('mte.doctrine_views.manager.'.$name, $definition);
            }
        }
    }

}