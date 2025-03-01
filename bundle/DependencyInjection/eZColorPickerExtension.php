<?php


namespace Codein\eZColorPicker\DependencyInjection;

use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;


class eZColorPickerExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');
        $loader->load('fieldtype.yaml');
    }

    public function prepend(ContainerBuilder $container)
    {
        $coreExtensionConfigFile = realpath(__DIR__ . '/../Resources/config/prepend/ezplatform.yaml');
        $container->prependExtensionConfig('ibexa', Yaml::parseFile($coreExtensionConfigFile));
        $container->addResource(new FileResource($coreExtensionConfigFile));

        $twigExtensionConfigFile = realpath(__DIR__ . '/../Resources/config/prepend/twig.yaml');
        $container->prependExtensionConfig('twig', Yaml::parseFile($twigExtensionConfigFile));
        $container->addResource(new FileResource($twigExtensionConfigFile));
    }


}