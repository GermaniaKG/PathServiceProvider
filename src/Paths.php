<?php
namespace Germania\PathServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;


class PathServiceProvider implements ServiceProviderInterface
{

    /**
     * @var Callable
     */
    public $prefixer;


    /**
     * @var array
     */
    public $paths = [];


    /**
     * @var Container
     */
    public $dic;


    /**
     * @param array         $paths    Array with paths
     * @param Callable|null $prefixer Optional callable that prefixes the paths.
     */
    public function __construct ( array $paths, Callable $prefixer = null)
    {
        $this->paths = $paths;
        $this->prefixer = $prefixer ?: function( $p ) { return $p; } ;
    }


    /**
     * @implements ServiceProviderInterface
     */
    public function register(Container $dic)
    {

        /**
         * @return array
         */
        $dic['Paths'] = function($dic) {
            return $this->paths;
        };


        /**
         * @return Callable
         */
        $dic['Paths.Prefixer'] = function($dic) {
            return $this->prefixer;
        };


        /**
         * @return array
         */
        $dic['Paths.absolute'] = function ($dic) {
            $paths = $dic['Paths'];
            $prefixer = $dic['Paths.Prefixer'];

            return $prefixer( $paths );
        };

    }
}

