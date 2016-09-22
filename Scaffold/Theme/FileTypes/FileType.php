<?php

namespace Ignite\Core\Scaffold\Theme\FileTypes;

interface FileType {

    /**
     * Generate the current file type
     * @return string
     */
    public function generate();
}
