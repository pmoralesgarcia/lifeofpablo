<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitca595f69ec70f856cc8a95d608499764
{
    public static $files = array (
        'fbc4428972f06a5eca49dba8e23d63f6' => __DIR__ . '/..' . '/phpish/http/http.php',
        '1984e4722b8b43f28bc5fd137c755104' => __DIR__ . '/..' . '/phpish/link_header/link_header.php',
        '738dbba06e2589aabc0c19f2064e4c0f' => __DIR__ . '/../..' . '/webmention.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitca595f69ec70f856cc8a95d608499764::$classMap;

        }, null, ClassLoader::class);
    }
}