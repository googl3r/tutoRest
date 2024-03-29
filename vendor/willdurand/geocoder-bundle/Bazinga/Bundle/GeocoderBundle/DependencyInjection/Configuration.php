<?php

/**
 * This file is part of the BazingaGeocoderBundle package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Bazinga\Bundle\GeocoderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('bazinga_geocoder');

        $rootNode
            ->children()
            ->arrayNode('fake_ip')
                ->beforeNormalization()
                ->ifString()
                    ->then(function ($value) { return array('ip' => $value); })
                ->end()
                ->treatFalseLike(array('enabled' => false))
                ->treatTrueLike(array('enabled' => true))
                ->treatNullLike(array('enabled' => true))
                ->children()
                    ->booleanNode('enabled')
                        ->defaultTrue()
                    ->end()
                    ->scalarNode('ip')->defaultNull()->end()
                    ->scalarNode('priority')->defaultValue(0)->end()
                ->end()
            ->end()
            ->arrayNode('adapter')
                ->children()
                    ->scalarNode('class')->defaultNull()->end()
                ->end()
            ->end()
            ->arrayNode('providers')
                ->children()
                ->arrayNode('bing_maps')
                    ->children()
                        ->scalarNode('api_key')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                        ->scalarNode('locale')->defaultNull()->end()
                    ->end()
                ->end()
                ->arrayNode('cache')
                    ->children()
                        ->scalarNode('adapter')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('provider')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('locale')
                            ->defaultNull()
                        ->end()
                        ->scalarNode('lifetime')
                            ->defaultValue(86400)
                            ->validate()
                                ->ifTrue(function ($v) { return !is_integer($v); })
                                ->thenInvalid('Only integer are allowed!')
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('ip_info_db')
                    ->children()
                        ->scalarNode('api_key')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('cloudmade')
                    ->children()
                        ->scalarNode('api_key')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('google_maps')
                    ->children()
                        ->scalarNode('locale')->defaultNull()->end()
                        ->scalarNode('region')->defaultNull()->end()
                        ->booleanNode('use_ssl')->defaultFalse()->end()
                        ->scalarNode('api_key')->defaultNull()->end()
                    ->end()
                ->end()
                ->arrayNode('google_maps_business')
                    ->children()
                        ->scalarNode('client_id')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('api_key')->defaultNull()->end()
                        ->scalarNode('locale')->defaultNull()->end()
                        ->scalarNode('region')->defaultNull()->end()
                        ->booleanNode('use_ssl')->defaultFalse()->end()
                    ->end()
                ->end()
                ->arrayNode('openstreetmap')
                    ->children()
                        ->scalarNode('locale')->defaultNull()->end()
                    ->end()
                ->end()
                ->arrayNode('host_ip')->end()
                ->arrayNode('geoip')->end()
                ->arrayNode('free_geo_ip')->end()
                ->arrayNode('mapquest')
                    ->children()
                        ->scalarNode('api_key')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('oiorest')->end()
                ->arrayNode('geocoder_ca')->end()
                ->arrayNode('geocoder_us')->end()
                ->arrayNode('ign_openls')
                    ->children()
                        ->scalarNode('api_key')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('data_science_toolkit')->end()
                ->arrayNode('yandex')
                    ->children()
                        ->scalarNode('locale')->defaultNull()->end()
                        ->scalarNode('toponym')->defaultNull()->end()
                    ->end()
                ->end()
                ->arrayNode('geo_ips')
                    ->children()
                        ->scalarNode('api_key')->defaultNull()->end()
                    ->end()
                ->end()
                ->arrayNode('geo_plugin')->end()
                ->arrayNode('maxmind')
                    ->children()
                        ->scalarNode('api_key')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('maxmind_binary')
                    ->children()
                        ->scalarNode('binary_file')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                        ->scalarNode('open_flag')
                            ->defaultValue(null)
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('chain')
                    ->fixXmlConfig('provider')
                    ->children()
                        ->arrayNode('providers')
                            ->performNoDeepMerging()
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('tom_tom')
                    ->children()
                        ->scalarNode('api_key')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                        ->scalarNode('locale')->defaultNull()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
