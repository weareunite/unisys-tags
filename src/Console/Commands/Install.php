<?php

namespace Unite\Tags\Console\Commands;

use Unite\UnisysApi\Console\InstallModuleCommand;

class Install extends InstallModuleCommand
{
    protected $moduleName = 'tags';

    protected function install()
    {
        $this->call('vendor:publish', [
            '--provider' => 'Unite\\Tags\\TagsServiceProvider'
        ]);

        $this->call('migrate');
    }
}