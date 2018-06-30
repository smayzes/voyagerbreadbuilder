<?php

namespace Codelabs\VoyagerBreadBuilder\Tests\Integration;

use Illuminate\Contracts\Console\Kernel;

trait TestHelper
{
    public function removeDir($path)
    {
//        $files = array_diff(scandir($path), ['.', '..']);
//        foreach ($files as $file) {
//            if (is_dir("$path/$file")) {
//                $this->removeDir("$path/$file");
//            } else {
//                @chmod("$path/$file", 0777);
//                @unlink("$path/$file");
//            }
//        }
//
//        return rmdir($path);
    }
}
