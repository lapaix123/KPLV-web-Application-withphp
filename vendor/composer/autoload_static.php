<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb904b167a8b59a4ae3c81de212bce117
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb904b167a8b59a4ae3c81de212bce117::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb904b167a8b59a4ae3c81de212bce117::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb904b167a8b59a4ae3c81de212bce117::$classMap;

        }, null, ClassLoader::class);
    }
}
