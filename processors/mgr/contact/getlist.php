<?php
/**
 * EloquaForms
 *
 * Copyright 2013 by Eli Snyder <freejung@gmail.com>
 */
/**
 * @package eloquaforms
 * @subpackage processors
 */

$start = $modx->getOption('start', $scriptProperties, 0);
$limit = $modx->getOption('limit', $scriptProperties, 0);
$relatedObjectId = $modx->getOption('object_id', $scriptProperties, 0);
$reqConfigs = $modx->getOption('reqConfigs', $scriptProperties, 0);
$search = $modx->getOption('search', $scriptProperties, '');

//$modx->log(modX::LOG_LEVEL_ERROR, print_r($scriptProperties,true));
$config = $modx->migx->customconfigs;

$prefix = !empty($config['prefix']) ? $config['prefix'] : null;

$packageName = $config['packageName'];
$packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
$modelpath = $packagepath . 'model/';
$modx->addPackage($packageName, $modelpath, $prefix);

$c = $modx->newQuery('efContact');

if($start || $limit){
	$c->limit($limit, $start);
}

if(!empty($search)){
	$c->where(array(
        'name:LIKE' => '%'.$search.'%',
        'OR:category:LIKE' => '%'.$search.'%',
        'OR:phone:LIKE' => '%'.$search.'%',
        'OR:email:LIKE' => '%'.$search.'%',
    ));
}

$allContacts = $modx->getCollection('efContact',$c);

$formId = 0;

if($relatedObjectId && $reqConfigs == 'efforms') {
	$formId = $relatedObjectId;
}

$rows = array();
$row = array();

foreach($allContacts as $contact) {
	$row = $contact->toArray();
	$row['contactPoint_active'] = 0;
	$row['Joined_active'] = 0;
	if($formId) {
		$contactPoints = $contact->getMany('ContactPoint');
		foreach($contactPoints as $contactPoint){
			if($contactPoint->get('form') == $formId){
				$row['contactPoint_active'] = 1;
				$row['Joined_active'] = 1;
			}
		}
	}
	$rows[]=$row;
}

$count = count($allContacts);
$rows = $modx->migx->checkRenderOptions($rows);