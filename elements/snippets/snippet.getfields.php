<?php
$packageName = 'eloquaforms';
$packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
$modelpath = $packagepath . 'model/';
$modx->addPackage($packageName, $modelpath, null);

/* setup default properties */
$formId = $modx->getOption('resourceId',$scriptProperties,0);
$tpl = $modx->getOption('tpl',$scriptProperties,'fields.tpl');
$validationRulesTpl = $modx->getOption('validationRulesTpl',$scriptProperties,'validation-rules.tpl');
$skipRulesTpl = $modx->getOption('skipRulesTpl',$scriptProperties,'skip-rules.tpl');
$sort = $modx->getOption('sort',$scriptProperties,'name');
$dir = $modx->getOption('dir',$scriptProperties,'DESC');
$where = $modx->getOption('where',$scriptProperties,'{}');
$limit = $modx->getOption('limit',$scriptProperties,0);
$offset = $modx->getOption('offset',$scriptProperties,0);

$r = $modx->newQuery('efField');

if($formId) {
    $r->where(array('form' => $formId));
}

if($limit || $offset) $r->limit($limit, $offset);

$r->sortby($sort,$dir);

$whereArray = $modx->fromJSON($where);
$r->where($whereArray);

$fields = $modx->getCollection('efField',$r);

$output = '';

foreach ($fields as $field) {
    $fieldArray = $field->toArray();
    $validation = '';
    if($validationRules = $field->getMany('validationRules')) {
    	foreach($validationRules as $validationRule) {
    		$validation .= $modx->getChunk($validationRulesTpl, $validationRule->toArray());
    	}
    }
    //remove trailing comma from last element in validation rules
    $validation = rtrim($validation, ',');
    $fieldArray['validationrules'] = $validation;
    $skip = '';
    if($skipRules = $field->getMany('skipRules')) {
    	foreach($skipRules as $skipRule) {
    		$skip .= $modx->getChunk($skipRulesTpl, $skipRule->toArray());
    	}
    }
    $skip = rtrim($skip,',');
    $fieldArray['skiprules'] = $skip;
    $output .= $modx->getChunk($tpl, $formArray);
}

return $output;