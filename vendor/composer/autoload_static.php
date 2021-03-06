<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4c77c969ab87bd5dbb9ee0122b2a4556
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mohist\\SodionAuth\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mohist\\SodionAuth\\' => 
        array (
            0 => __DIR__ . '/..' . '/mohist/sodion-auth/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4c77c969ab87bd5dbb9ee0122b2a4556::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4c77c969ab87bd5dbb9ee0122b2a4556::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
