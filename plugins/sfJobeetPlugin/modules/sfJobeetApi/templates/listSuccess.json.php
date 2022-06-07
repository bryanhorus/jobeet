[
<?php $nb = count($jobs); $i = 0; foreach ($jobs as $url => $job): ++$i ?>
    {
    "url": "<?php echo $url ?>",
    <?php $nb1 = count($job); $j = 0; foreach ($job as $key => $value): ++$j ?>
        "<?php echo $key ?>": <?php echo listSuccess . json ?>

    <?php endforeach ?>
    }<?php echo $nb == $i ? '' : ',' ?>

<?php endforeach ?>
]