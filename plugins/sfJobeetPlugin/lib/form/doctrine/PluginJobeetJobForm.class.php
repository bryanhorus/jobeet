<?php

class PluginJobeetJobForm extends BaseJobeetJobForm
{
    public function configure()
    {
        $this->disableLocalCSRFProtection();
    }
}