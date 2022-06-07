
    <title>Jobeet</title>
    <subtitle>Latest Jobs</subtitle>
    <link href="<?php echo url_for('sfJobeetjob', array('sf_format' => 'atom'), true) ?>" rel="self"/>
    <link href="<?php echo url_for('homepage', true) ?>"/>
    <updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', Doctrine_Core::getTable('JobeetJob')->getLatestPost()->getDateTimeObject('created_at')->format('U')) ?></updated>
    <author>
        <name>Jobeet</name>
    </author>
    <id><?php echo sha1(url_for('job', array('sf_format' => 'atom'), true)) ?></id>

    <?php foreach ($categories as $category): ?>
        <?php include_partial('sfJobeetJob/list', array('jobs' => $category->getActiveJobs(sfConfig::get('app_max_jobs_on_homepage')))) ?>
    <?php endforeach ?>
</feed>