<?php

class JobeetJob
{
    public function save(PropelPDO $con = null)
    {
        // ...

        if (is_null($con))
        {
            $con = Propel::getConnection(JobeetJobPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try
        {
            $ret = parent::save($con);

            $this->updateLuceneIndex();

            $con->commit();

            return $ret;
        }
        catch (Exception $e)
        {
            $con->rollBack();
            throw $e;
        }
    }

    public function updateLuceneIndex()
    {
        $index = JobeetJobPeer::getLuceneIndex();

        // remove an existing entry
        if ($hit = $index->find('pk:'.$this->getId()))
        {
            $index->delete($hit->id);
        }

        // don't index expired and non-activated jobs
        if ($this->isExpired() || !$this->getIsActivated())
        {
            return;
        }

        $doc = new Zend_Search_Lucene_Document();

        // store job primary key URL to identify it in the search results
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('pk', $this->getId()));

        // index job fields
        $doc->addField(Zend_Search_Lucene_Field::UnStored('position', $this->getPosition(), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('company', $this->getCompany(), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('location', $this->getLocation(), 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('description', $this->getDescription(), 'utf-8'));

        // add job to the index
        $index->addDocument($doc);
        $index->commit();
    }

    public function delete(PropelPDO $con = null)
    {
        $index = JobeetJobPeer::getLuceneIndex();

        if ($hit = $index->find('pk:'.$this->getId()))
        {
            $index->delete($hit->id);
        }

        return parent::delete($con);
    }

}