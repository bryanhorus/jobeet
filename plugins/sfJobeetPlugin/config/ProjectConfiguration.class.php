<?php

class ProjectConfiguration
{
    public function setup()
    {
        $this->enablePlugins(array(
            'sfDoctrinePlugin',
            'sfDoctrineGuardPlugin',
            'sfFormExtraPlugin',
            'sfJobeetPlugin'
        ));
    }
}