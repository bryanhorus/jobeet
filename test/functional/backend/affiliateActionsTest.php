<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  get('/affiliate/index')->

  with('request')->begin()->
    isParameter('module', 'affiliate')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('body', '!/This is a temporary page/')->
  end()
;

$browser->
info('1 - Authentication')->
get('/affiliate')->
click('Signin', array(
    'signin' => array('username' => 'admin', 'password' => 'admin'),
    array('_with_csrf' => true)
))->
with('response')->isRedirected()->
followRedirect()->

info('2 - When validating an affiliate, an email must be sent with its token')->
click('Activate', array(), array('position' => 1))->
with('mailer')->begin()->
checkHeader('Subject', '/Jobeet affiliate token/')->
checkBody('/Your token is symfony/')->
end()
;