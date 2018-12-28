<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6c1cca03a91e921fa409cf0c1b50f9be
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/../twig' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/../twig' . '/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6c1cca03a91e921fa409cf0c1b50f9be::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6c1cca03a91e921fa409cf0c1b50f9be::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit6c1cca03a91e921fa409cf0c1b50f9be::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
