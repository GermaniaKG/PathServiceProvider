<?php
namespace tests;

use Pimple\Container as PimpleContainer;
use Germania\PathServiceProvider\PathServiceProvider;

class PathServiceProviderTest extends \PHPUnit\Framework\TestCase
{


    /**
     * @dataProvider provideCtorArguments
     */
    public function testSimple( $paths, $prefixer )
    {
        $sut = is_null($prefixer)
        ? new PathServiceProvider($paths)
        : new PathServiceProvider($paths, $prefixer);

        $dic = new PimpleContainer;
        $dic->register( $sut );

        $this->assertEquals( $paths, $dic['Paths']);

        $prefixer = $dic['Paths.Prefixer'];
        $this->assertTrue( is_callable($prefixer) );

        $prefixed = $prefixer( $paths );
        $absolutes = $dic['Paths.absolute'];
        $this->assertEquals( $prefixed, $absolutes);
    }

    public function provideCtorArguments()
    {
        $paths = [
            'var',
            'templates'
        ];

        return array(
            [ $paths, null ]
        );
    }
}
