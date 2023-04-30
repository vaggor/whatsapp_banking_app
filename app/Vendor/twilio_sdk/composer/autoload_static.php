<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5b394abb050c5f6c15ecd5be8b54c14b
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
            0 => __DIR__ . '/..' . '/twilio/sdk/Twilio',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5b394abb050c5f6c15ecd5be8b54c14b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5b394abb050c5f6c15ecd5be8b54c14b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}