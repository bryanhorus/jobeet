<?php

class JobeetJobPeer
{
    public function getLuceneIndex()
    {
        ProjectConfiguration::registerZend();

        if (file_exists($index = $this->getLuceneIndexFile()))
        {
            return Zend_Search_Lucene::open($index);
        }
        else
        {
            return Zend_Search_Lucene::create($index);
        }
    }

    public function getLuceneIndexFile()
    {
        return sfConfig::get('sf_data_dir').'/job.'.sfConfig::get('sf_environment').'.index';
    }

    public static function doDeleteAll($con = null)
    {
        if (file_exists($index = self::getLuceneIndexFile()))
        {
            sfToolkit::clearDirectory($index);
            rmdir($index);
        }

        return parent::doDeleteAll($con);
    }
}