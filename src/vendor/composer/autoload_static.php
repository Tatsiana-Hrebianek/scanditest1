<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit84b10c7a275e70c622dfdb4c303c9501
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit84b10c7a275e70c622dfdb4c303c9501::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit84b10c7a275e70c622dfdb4c303c9501::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit84b10c7a275e70c622dfdb4c303c9501::$classMap;

        }, null, ClassLoader::class);
    }
}
