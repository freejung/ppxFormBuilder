<?php
$xpdo_meta_map['efContactPoint']= array (
  'package' => 'eloquaforms',
  'version' => '1.1',
  'table' => 'ef_contactpoints',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'form' => 0,
    'contact' => 0,
  ),
  'fieldMeta' => 
  array (
    'form' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'contact' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'indexes' => 
  array (
    'form' => 
    array (
      'alias' => 'form',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'form' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'contact' => 
    array (
      'alias' => 'contact',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'contact' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Form' => 
    array (
      'class' => 'efForm',
      'local' => 'form',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Contact' => 
    array (
      'class' => 'efContact',
      'local' => 'contact',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
