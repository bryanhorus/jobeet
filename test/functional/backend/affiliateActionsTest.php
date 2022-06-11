<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  get('/sfJobeetAffiliate/index')->

  with('request')->begin()->
    isParameter('module', 'sfJobeetAffiliate')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('body', '!/This is a temporary page/')->
  end()
;

$browser = new JobeetTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
info('1 - Authentication')->
get('/sfJobeetAffiliate')->
click('Signin', array(
    'signin' => array('username' => 'admin', 'password' => 'admin'),
    array('_with_csrf' => true)
))->
with('response')->isRedirected()->
followRedirect()->

info('2 - When validating an sfJobeetAffiliate, an email must be sent with its token')->
click('Activate', array(), array('position' => 1))->
with('mailer')->begin()->
checkHeader('Subject', '/Jobeet sfJobeetAffiliate token/')->
checkBody('/Your token is symfony/')->
end()
;