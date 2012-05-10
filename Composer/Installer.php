<?php

namespace li3_composer\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class Installer extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $prefix = substr($package->getPrettyName(), 0, 23);
        $path = explode('/', $package->getPrettyName());
        return $path[1];
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'li3-libraries' === $packageType;
    }
}