<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcd5d622c01664a4feef74ef9f49ade7f
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Toggle\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Toggle\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcd5d622c01664a4feef74ef9f49ade7f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcd5d622c01664a4feef74ef9f49ade7f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
