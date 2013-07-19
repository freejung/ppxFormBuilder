<?php
$packageName = 'eloquaforms';
$packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
$modelpath = $packagepath . 'model/';
$modx->addPackage($packageName, $modelpath, null);

/* setup default properties */
$resourceId = $modx->getOption('resourceId',$scriptProperties,0);
$tpl = $modx->getOption('tpl',$scriptProperties,'forms.tpl');
$sort = $modx->getOption('sort',$scriptProperties,'name');
$dir = $modx->getOption('dir',$scriptProperties,'DESC');
$where = $modx->getOption('where',$scriptProperties,'{}');
$limit = $modx->getOption('limit',$scriptProperties,0);
$offset = $modx->getOption('offset',$scriptProperties,0);
$includeSpecialFields = $modx->getOption('includeSpecialFields',$scriptProperties,0);

$r = $modx->newQuery('efResourceRelation');

$r->innerJoin('efForm', 'Form');

if($resourceId) {
    $r->where(array('resource' => $resourceId));
}

if($limit || $offset) $r->limit($limit, $offset);

$r->sortby($sort,$dir);

$whereArray = $modx->fromJSON($where);
$r->where($whereArray);

$resourceRelations = $modx->getCollection('efResourceRelation',$r);

$output = '';
$pattern = '/id="(.*?)"/';
foreach ($resourceRelations as $resourceRelation) {
    $form = $resourceRelation->getOne('Form');
    $formArray = $form->toArray();
    //make sure all form elements in form code have a unique id
    $formArray['formcode'] = preg_replace($pattern, 'id="form'.$formArray['id'].'-$1"', $formArray['formcode']);
    if($includeSpecialFields) {
    	$formArray['emailField'] = '';
    	$formArray['honeytoken'] = '';
    	$formArray['answer'] = '';
    	$formArray['channelField'] = '';
    	$formArray['nfields'] = 0;
    	if($fields = $form->getMany('Field')) {
    		$formArray['nfields'] = count($fields);
	    	foreach($fields as $field) {
	    		if($field->email) $formArray['emailField'] = $field->name;
	    		if($field->channel) $formArray['channelField'] = $field->name;
	    		if($field->honeytoken) {
	    			$formArray['honeytoken'] = $field->name;
	    			$formArray['answer'] = $field->answer;
	    		}
	    	}
	    }
    }
    $output .= $modx->getChunk($tpl, $formArray);
}

return $output;