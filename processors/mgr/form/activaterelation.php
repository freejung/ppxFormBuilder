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

$modx->log(modX::LOG_LEVEL_ERROR, 'activaterelation called, properties = '.print_r($scriptProperties,true));

if (empty($scriptProperties['object_id'])) {

    return $modx->error->failure($modx->lexicon('quip.thread_err_ns'));

}

$config = $modx->migx->customconfigs;
$modx->setOption(xPDO::OPT_AUTO_CREATE_TABLES, $config['auto_create_tables']);

$prefix = $config['prefix'];
$packageName = $config['packageName'];

$packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
$modelpath = $packagepath . 'model/';

$modx->addPackage($packageName, $modelpath, $prefix);
$classname = $config['classname'];

//$joinalias = isset($config['join_alias']) ? $config['join_alias'] : '';
$joinclass = 'efResourceRelation';

if ($modx->lexicon) {
    $modx->lexicon->load($packageName . ':default');
}

   switch ($scriptProperties['task']) {
        case 'activate':
            if ($joinobject = $modx->getObject($joinclass, array('form' => $scriptProperties['object_id'], 'resource' => $scriptProperties['resource_id']))) {
                break;
            } else {
                $joinobject = $modx->newObject($joinclass);
                $joinobject->set('form', $scriptProperties['object_id']);
                $joinobject->set('resource', $scriptProperties['resource_id']);
            }
            $joinobject->save();
            break;
        case 'deactivate':
            if ($joinobject = $modx->getObject($joinclass, array('form' => $scriptProperties['object_id'], 'resource' => $scriptProperties['resource_id']))) {
                $joinobject->remove();
            }
            break;
        default:
            break;
    }

return $modx->error->success();