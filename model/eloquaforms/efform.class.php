<?php
class efForm extends xPDOSimpleObject {
	    
	public function save($cacheFlag= null) {
		$rt = parent :: save($cacheFlag);
        //$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'saving form formcode: '.$this->formcode);
        // if formcode exists, check for fields
        if(!empty($this->formcode)) {
        	$allFields = $this->getMany('Field');
        	$nfields = count($allFields);
        	
        	//$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'number of fields: '.$nfields);
        	//if there are no fields, attempt to parse the form code to create fields
        	if(!$nfields) {
        		$source = $this->formcode;
				$dom = new DOMDocument();
				if($dom->loadHTML($source)){
					$allInputs = $dom->getElementsByTagName('input');
					$allLabels = $dom->getElementsByTagName('label');
					foreach($allInputs as $input) {
						$fieldValues = array();
						$fieldValues['name'] = $input->getAttribute('name');
						//$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'input found, name= '.$fieldValues['name']);
						$fieldValues['type'] = $input->getAttribute('type');
						$fieldValues['element'] = 'input';
						$fieldValues['dbname'] = $input->getAttribute('name');
						$fieldValues['htmlId'] = $input->getAttribute('id');
						$fieldValues['value'] = $input->getAttribute('value');
						if($input->getAttribute('name') == 'C_EmailAddress') $fieldValues['email'] = 1;
						foreach($allLabels as $label){
							//$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'label for: '.$label->getAttribute('for'));
							if($label->getAttribute('for') == $fieldValues['name']) {
								$fieldValues['question'] = $label->nodeValue;
								//$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'field question: '.$label->nodevalue);
							}
						}
						$newField = $this->xpdo->newObject('efField',$fieldValues);
						$newField->addOne($this);
						$newField->save();
					}
				}else{
					$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'Eloqua Forms could not parse form source code, no fields created');
				}
        	}else{
        		if($this->clone_fields) {
        			//$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'clone validation from: '.$this->clone_validation);
        			if($cloneForm = $this->xpdo->getObject('efForm',$this->clone_fields)) {
        				//$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'found form to clone from: '.$cloneForm->name);
        				$myFields = $this->getMany('Field');
        				foreach($myFields as $myField) {
        					//$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'myfield '.$myField->name);
        					if(!empty($myField->name) && $cloneField = $this->xpdo->getObject('efField',array('form' => $cloneForm->id, 'name' => $myField->name))) {
        						//$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'found clone field: '.$cloneField->name);
        						//copy non-html attributes
        						$myField->set('dbname',$cloneField->get('dbname'));
        						$myField->set('prepop',$cloneField->get('prepop'));
        						$myField->set('email',$cloneField->get('email'));
        						$myField->set('honeytoken',$cloneField->get('honeytoken'));
        						$myField->set('answer',$cloneField->get('answer'));
        						$myField->set('channel',$cloneField->get('channel'));
        						$myField->set('dbname',$cloneField->get('dbname'));
        						$myField->set('value',$cloneField->get('value'));
        						//clear old rules
        						$oldRules = array_merge($myField->getMany('validationRules'), $myField->getMany('skipRules'));
        						foreach($oldRules as $oldRule) {
        							$oldRule->remove();
        						}
        						$cloneValidationRules = $cloneField->getMany('validationRules');
        						foreach($cloneValidationRules as $cloneRule) {
        							$newRule = $this->xpdo->newObject('efValidationRule',$cloneRule->toArray());
        							$newRule->addOne($myField);
        							$newRule->save();
        						}
        						$cloneSkipRules = $cloneField->getMany('skipRules');
        						foreach($cloneSkipRules as $cloneRule) {
        							$newRule = $this->xpdo->newObject('efSkipRule',$cloneRule->toArray());
        							$newRule->addOne($myField);
        							$newRule->save();
        						}
        						$myField->save();
        					}
        				}
        			}
        		}
        	}
        }else{
        	if($this->clone_fields) {
				//$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'clone validation from: '.$this->clone_validation);
				if($cloneForm = $this->xpdo->getObject('efForm',$this->clone_fields)) {
					//$this->xpdo->log(modX::LOG_LEVEL_ERROR, 'found form to clone from: '.$cloneForm->name);
					$myFields = $this->getMany('Field');
					foreach($myFields as $myField) {
						$myField->remove();
					}
					$cloneFields = $cloneForm->getMany('Field');
					foreach($cloneFields as $cloneField) {
						$newField = $this->xpdo->newObject('efField',$cloneField->toArray());
						$newField->addOne($this);
						$newField->save();
						$cloneValidationRules = $cloneField->getMany('validationRules');
						foreach($cloneValidationRules as $cloneRule) {
							$newRule = $this->xpdo->newObject('efValidationRule',$cloneRule->toArray());
							$newRule->addOne($newField);
							$newRule->save();
						}
						$cloneSkipRules = $cloneField->getMany('skipRules');
						foreach($cloneSkipRules as $cloneRule) {
							$newRule = $this->xpdo->newObject('efSkipRule',$cloneRule->toArray());
							$newRule->addOne($newField);
							$newRule->save();
						}
					}
				}
			}
        }
        return $rt;
    }
}