<?php

namespace Ignite\Core\Scaffold\Theme;

use Ignite\Core\Scaffold\Theme\Exceptions\FileTypeNotFoundException;
use Ignite\Core\Scaffold\Theme\FileTypes\FileType;

class ThemeGeneratorFactory {

    /**
     * @param string $file
     * @param array $options
     * @return FileType
     * @throws FileTypeNotFoundException
     */
    public function make($file, array $options) {
        $class = 'Ignite\Core\Scaffold\Theme\FileTypes\\' . ucfirst($file);

        if (!class_exists($class)) {
            throw new FileTypeNotFoundException();
        }

        return new $class($options);
    }

}
