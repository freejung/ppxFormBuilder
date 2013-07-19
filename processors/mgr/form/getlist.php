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
$resourceId = $modx->getOption('resource_id', $scriptProperties, 0);
$reqConfigs = $modx->getOption('reqConfigs', $scriptProperties, 0);
$search = $modx->getOption('search', $scriptProperties, '');

$modx->log(modX::LOG_LEVEL_ERROR, 'calling custom form list processor: '.print_r($scriptProperties,true));
$config = $modx->migx->customconfigs;

$prefix = !empty($config['prefix']) ? $config['prefix'] : null;

$packageName = $config['packageName'];
$packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
$modelpath = $packagepath . 'model/';
$modx->log(modX::LOG_LEVEL_ERROR, 'packageName:'. $packageName.' modelpath: '.$modelpath.' prefix: '.$prefix);
$modx->addPackage($packageName, $modelpath, $prefix);

$c = $modx->newQuery('efForm');

if($start || $limit){
	$c->limit($limit, $start);
}

if(!empty($search)){
	$c->where(array(
        'name:LIKE' => '%'.$search.'%',
        'OR:description:LIKE' => '%'.$search.'%',
        'OR:cta:LIKE' => '%'.$search.'%',
        'OR:header:LIKE' => '%'.$search.'%',
        'OR:formid:LIKE' => '%'.$search.'%',
    ));
}

$allForms = $modx->getCollection('efForm',$c);

$rows = array();
$row = array();

foreach($allForms as $form) {
	//$modx->log(modX::LOG_LEVEL_ERROR, 'listing form: '. $form->id.', '.$form->name);
	$row = $form->toArray();
	$row['form_active'] = 0;
	$row['Joined_active'] = 0;
	
	if($resourceId) {
		if($resourceRelations = $form->getMany('ResourceRelation')) {
			foreach($resourceRelations as $resourceRelation){
				if($resourceRelation->get('resource') == $resourceId){
					$row['form_active'] = 1;
					$row['Joined_active'] = 1;
				}
			}
		}
	}
	//$modx->log(modX::LOG_LEVEL_ERROR, 'form row: '. print_r($row,true));
	$rows[]=$row;
}

$count = count($allForms);
$rows = $modx->migx->checkRenderOptions($rows);