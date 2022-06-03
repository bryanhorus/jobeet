<?php echo sfYaml::dump(array(
    'error'       => array(
        'code'      => $code,
        'message'   => $message,
        'debug'     => array(
            'name'    => $name,
            'message' => $message,
            'traces'  => $traces,
        ),
    )), 4) ?>

    // config/error/error.yaml.php
<?php echo sfYaml::dump(array(
    'error'       => array(
        'code'      => $code,
        'message'   => $message,
    ))) ?>