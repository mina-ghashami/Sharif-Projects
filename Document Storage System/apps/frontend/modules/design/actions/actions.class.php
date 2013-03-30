<?php

class designActions extends sfActions
{
  
  public function executeAll(){
  	$this->redirect('type/index');
	  	
  }
	public function executeIndex()
  {
    
  }
  
  public function executeNew(){
  	$docTypeName = $this->getRequestParameter('docTypeName');
  	
  	if($this->getRequest()->getMethod() == sfRequest::POST ){
  		
  		$this->getUser()->setAttribute('source','index');
  		
  		if($docTypeName == '' || $docTypeName == ' '){
  			$this->setFlash('valid','no');
  			$this->redirect('design/show?docTypeName='.$docTypeName);
  		}
  		if(!$this->typeExist($docTypeName)){
	  		$type = new Type();
	  		$type->setName($docTypeName);
	  		$type->save();
	  		$typeId = $type->getId();	
	  		$this->redirect('design/addField?typeId='.$typeId);
  		}
  		else{ // age type vujud dasht
			$this->setFlash('valid','yes');
			$this->redirect('design/show?docTypeName='.$docTypeName);	 
  		} 
  		
  	}
  }
  
  public function executeShow(){
  	
  	$docTypeName = $this->getRequestParameter('docTypeName');
  	$this->valid = $this->getFlash('valid');
  	
  	$this->docTypeName = $docTypeName;
  	
  	if($this->getRequest()->getMethod() == sfRequest::POST ){
  		
  		$this->getUser()->setAttribute('source','index');
  		
  		if($docTypeName == '' || $docTypeName == ' '){
  			$this->setFlash('valid','no');
  			$this->redirect('design/show?docTypeName='.$docTypeName);
  		}
  		if(!$this->typeExist($docTypeName)){
	  		$type = new Type();
	  		$type->setName($docTypeName);
	  		$type->save();
	  		$typeId = $type->getId();	
	  		$this->redirect('design/addField?typeId='.$typeId);
  		}
  		else{ // age type vujud dasht
			$this->setFlash('valid','yes');
			$this->redirect('design/show?docTypeName='.$docTypeName);	 
  		} 
  		
  	}
  }
  
  public function executeAddField(){
  	
  	
  	  $this->typeId = $this->getRequestParameter('typeId');
  	  $c = new Criteria();
	  $c->add(TypePeer::ID , $this->typeId);
	  $type = TypePeer::doSelectOne($c);
	  $this->docTypeName = $type->getName();
	
  }
  
  public function executeInput(){
  	$this->typeId = $this->getRequestParameter('typeId');
  }
  public function executeTextarea()
  {
  	$this->typeId = $this->getRequestParameter('typeId');

  }
  public function executeRadio(){
  	$this->typeId = $this->getRequestParameter('typeId');
  }
  public function executeCheckbox(){
  	$this->typeId = $this->getRequestParameter('typeId');
  }
  public function executeSelectTag(){
  	$this->typeId = $this->getRequestParameter('typeId');
  }
  
  public function typeExist($name){
  	$c = new Criteria();
  	$c->add(TypePeer::NAME , $name);
  	$res = TypePeer::doSelect($c);
  	
  	if(sizeof($res) != 0)
  		return true;
  	return false;	
  }
  
  public function attrExist($typeId , $name){
  	
  	$c = new Criteria();
  	$c->add(AttributePeer::TYPE_ID , $typeId);
  	$c->add(AttributePeer::NAME , $name);
  	$res = AttributePeer::doSelect($c);
  	
  	if(sizeof($res) != 0)
  		return true;
  	return false;
  }
  
  public function executeInputForm()
  {
  	  $name = $this->getRequestParameter('name');
	  $required = $this->getRequestParameter('required');
	  $rank = $this->getRequestParameter('rank');
	  $inReport = $this->getRequestParameter('inReport');
	  $inSearch = $this->getRequestParameter('inSearch');
	  $content = $this->getRequestParameter('content');
	  if($content == "digit")
	  {
	  	$from = $this->getRequestParameter('from');
	  	$to = $this->getRequestParameter('to');
	  }
	  
	  $length = $this->getRequestParameter('length');
	  
  	if($this->hasRequestParameter('typeId')){
  		
	  $this->setFlash('edit','no');
	  $typeId = $this->getRequestParameter('typeId');
	  $this->typeId = $typeId;
	  
	  $c = new Criteria();
	  $c->add(TypePeer::ID ,  $this->typeId);
	  $type = TypePeer::doSelectOne($c);
	  $this->docTypeName = $type->getName();

	  $attr = new Attribute();
	  $attr->setName($name);
	  $attr->setRequired($required=='yes' ?1:0);
	  $attr->setRank($rank);
	  $attr->setInreport($inReport=='yes' ? 1:0);
	  $attr->setInsearch($inSearch=='yes' ?1:0);
	  $attr->setTypeId($typeId);
	  $attr->setTag("input");
	  
	  if(!$this->attrExist($typeId,$name)){
		  $attr->save();
		  
		  $attrId = $attr->getId();
		  
		  $limit = new Limit();
		  $limit->setAttrId($attrId);
		  	
		  $limitation = $content;
		  if($content == 'digit')
		  {
		  	$limitation .= '-from'.$from.'-to'.$to;
		  }
			
		  $limitation .= '-len'.$length;	
		  
		  $limit->setLimitation($limitation);
		  $limit->save();	
	  }
	  else{
	  	$this->setFlash('tag','input');
	  	$this->redirect('design/same?typeId='.$typeId);
	  }
  	}
  	
  	else if($this->hasRequestParameter('id')){
  		
  		$this->setFlash('edit','yes');
  		$id = $this->getRequestParameter('id');
  		$c = new Criteria();
  		$c->add(AttributePeer::ID , $id);
  		$atr = AttributePeer::doSelectOne($c);
  		
  		$this->typeId = $atr->getTypeId();
  		$c = new Criteria();
  		$c->add(TypePeer::ID , $this->typeId);
  		$type = TypePeer::doSelectOne($c);
  		$this->docTypeName = $type->getName();
		
		$c = new Criteria();
		$c->add(AttributePeer::TYPE_ID , $this->typeId);
		$this->res = AttributePeer::doSelect($c);
  		
  		$atr->setName($name);
  		$atr->setRank($rank);
  		$atr->setRequired($required=='yes' ?1:0);
  		$atr->setInReport($inReport=='yes' ?1:0);
  		$atr->setInSearch($inSearch=='yes' ?1:0);
  		$atr->save();
  		
  		$c = new Criteria();
  		$c->add(LimitPeer::ATTR_ID , $id);
  		$limit = LimitPeer::doSelectOne($c);
  		
  		$limitation = $content; 
  		if($content == 'digit')
		  {
		  	$limitation .= '-from'.$from.'-to'.$to;
		  }
			
	    $limitation .= '-len'.$length;
	    $limit->setLimitation($limitation);
	    $limit->save();
		
  	}
  }

  public function executeTextareaForm()
  {
	  $name = $this->getRequestParameter('name');
	  $required = $this->getRequestParameter('required');
	  $rank = $this->getRequestParameter('rank');
	  $inReport = $this->getRequestParameter('inReport');
	  $inSearch = $this->getRequestParameter('inSearch');
	  
	  if($this->hasRequestParameter('typeId')){
			
	  	  $this->setFlash('edit','no');
	  	  $typeId = $this->getRequestParameter('typeId');
		  $this->typeId = $typeId;
		  
		  $c = new Criteria();
		  $c->add(TypePeer::ID , $this->typeId);
		  $type = TypePeer::doSelectOne($c);
		  $this->docTypeName = $type->getName();
		  
		  $attr = new Attribute();
		  $attr->setName($name);
		  $attr->setRequired($required=='yes' ?1:0);
		  $attr->setRank($rank);
		  $attr->setInreport($inReport=='yes' ? 1:0);
		  $attr->setInsearch($inSearch=='yes' ?1:0);
		  $attr->setTypeId($typeId);
		  $attr->setTag("textarea");
		  
		  if(!$this->attrExist($typeId,$name))
		  	$attr->save();
		  else{
		  	$this->setFlash('tag','textarea');
		  	$this->redirect('design/same?typeId='.$typeId);
		  }
  	  }
	else if($this->hasRequestParameter('id')){
		
		$this->setFlash('edit','yes');
	  	$id = $this->getRequestParameter('id');

		$c = new Criteria();
  		$c->add(AttributePeer::ID , $id);
  		$atr = AttributePeer::doSelectOne($c);
  		
  		$this->typeId = $atr->getTypeId();
  		$c = new Criteria();
  		$c->add(TypePeer::ID , $this->typeId);
  		$type = TypePeer::doSelectOne($c);
  		$this->docTypeName = $type->getName();
		
		$c = new Criteria();
		$c->add(AttributePeer::TYPE_ID , $this->typeId);
		$this->res = AttributePeer::doSelect($c);
  		
  		$atr->setName($name);
  		$atr->setRank($rank);
  		$atr->setRequired($required=='yes' ?1:0);
  		$atr->setInReport($inReport=='yes' ?1:0);
  		$atr->setInSearch($inSearch=='yes' ?1:0);
  		$atr->save();
	}
  }

  public function executeSame(){
  	$typeId = $this->getRequestParameter('typeId');
  	$c = new Criteria();
	$c->add(TypePeer::ID , $typeId);
	$type = TypePeer::doSelectOne($c);
	$this->docTypeName = $type->getName(); 
  }
  public function executeSelectTagForm()
  {
  	  $name = $this->getRequestParameter('name');
	  $required = $this->getRequestParameter('required');
	  $rank = $this->getRequestParameter('rank');
	  $inReport = $this->getRequestParameter('inReport');
	  $inSearch = $this->getRequestParameter('inSearch');
	  $content = $this->getRequestParameter('values');
	  $arr = split('-',$content);

	  if($this->hasRequestParameter('typeId')){

		  $this->setFlash('edit','no');
		  $typeId = $this->getRequestParameter('typeId');
		  $this->typeId = $typeId;
		  
		   $c = new Criteria();
		  $c->add(TypePeer::ID , $this->typeId);
		  $type = TypePeer::doSelectOne($c);
		  $this->docTypeName = $type->getName();
		  
		  $attr = new Attribute();
		  $attr->setName($name);
		  $attr->setRequired($required=='yes' ?1:0);
		  $attr->setRank($rank);
		  $attr->setInreport($inReport=='yes' ? 1:0);
		  $attr->setInsearch($inSearch=='yes' ?1:0);
		  $attr->setTypeId($typeId);
		  $attr->setTag("selectTag");
		  
		  if(!$this->attrExist($typeId,$name)){
		  	  $attr->save();	  
			  $attrId = $attr->getId(); 
			  
			  foreach ($arr as $a){
				  $limit = new Limit();
				  $limit->setAttrId($attrId);
				  $limit->setLimitation($a);
				  $limit->save();
			  }
		  }
		  else{
		  	$this->setFlash('tag','selectTag');
		  	$this->redirect('design/same?typeId='.$typeId);
		  }	
	  }
	
	else if($this->hasRequestParameter('id')){
	  	
	  	  $this->setFlash('edit','yes');	  	
		  $id = $this->getRequestParameter('id');
		  $c = new Criteria();
		  $c->add(AttributePeer::ID , $id);
		  $attr = AttributePeer::doSelectOne($c);
		  
		  $this->typeId = $attr->getTypeId();
  		  $c = new Criteria();
  		  $c->add(TypePeer::ID , $this->typeId);
  		  $type = TypePeer::doSelectOne($c);
  		  $this->docTypeName = $type->getName();
		
		  $c = new Criteria();
		  $c->add(AttributePeer::TYPE_ID , $this->typeId);
		  $this->res = AttributePeer::doSelect($c);
		  
		  $attr->setName($name);		  
		  $attr->setRank($rank);
		  $attr->setInReport($inReport=='yes' ? 1:0);
		  $attr->setInSearch($inSearch=='yes' ? 1:0);
		  $attr->save();
		  
		  $c = new Criteria();
		  $c->add(LimitPeer::ATTR_ID , $id);
		  $limits = LimitPeer::doSelect($c);
		  foreach ($limits as $l)
		  	$l->delete();
	 	  foreach ($arr as $a){
			  $limit = new Limit();
			  $limit->setAttrId($id);
			  $limit->setLimitation($a);
			  $limit->save();
		  }
	  
	}
  }
  	
  public function executeCheckboxForm()
  {
  	  $name = $this->getRequestParameter('name');
	  $rank = $this->getRequestParameter('rank');
	  $inReport = $this->getRequestParameter('inReport');
	  $inSearch = $this->getRequestParameter('inSearch');
	  $content = $this->getRequestParameter('values');
	  $arr = split('-',$content);
	 
	  
	  if($this->hasRequestParameter('typeId')){
	  		
		  $typeId = $this->getRequestParameter('typeId');
		  $this->typeId = $typeId;
		  $this->setFlash('edit','no');
		  
		  $c = new Criteria();
	      $c->add(TypePeer::ID , $this->typeId);
	      $type = TypePeer::doSelectOne($c);
	      $this->docTypeName = $type->getName();
		  
		   	  	
		  $attr = new Attribute();
		  $attr->setName($name);
		  $attr->setRequired(1); // man checkbox ro required gereftam
		  $attr->setRank($rank);
		  $attr->setInReport($inReport=='yes' ? 1:0);
		  $attr->setInSearch($inSearch=='yes' ?1:0);
		  $attr->setTypeId($typeId);
		  $attr->setTag("checkbox");
		  
		  if(!$this->attrExist($typeId,$name)){
		  	  $attr->save();
			  $attrId = $attr->getId(); 
			  
			  foreach ($arr as $a){
				  $limit = new Limit();
				  $limit->setAttrId($attrId);
				  $limit->setLimitation($a);
				  $limit->save();
			  }
		  }
		  else{
		  	$this->setFlash('tag','checkbox');
		  	$this->redirect('design/same?typeId='.$typeId);
		  }
	  }
	  else if($this->hasRequestParameter('id')){
	  	
		  $this->setFlash('edit','yes');	  	
		  $id = $this->getRequestParameter('id');
		  $c = new Criteria();
		  $c->add(AttributePeer::ID , $id);
		  $attr = AttributePeer::doSelectOne($c);
		  
		  $this->typeId = $attr->getTypeId();
  		  $c = new Criteria();
  		  $c->add(TypePeer::ID , $this->typeId);
  		  $type = TypePeer::doSelectOne($c);
  		  $this->docTypeName = $type->getName();
		
		  $c = new Criteria();
		  $c->add(AttributePeer::TYPE_ID , $this->typeId);
		  $this->res = AttributePeer::doSelect($c);
		  
		  $attr->setName($name);		  
		  $attr->setRank($rank);
		  $attr->setInReport($inReport=='yes' ? 1:0);
		  $attr->setInSearch($inSearch=='yes' ? 1:0);
		  $attr->save();
		  
		  $c = new Criteria();
		  $c->add(LimitPeer::ATTR_ID , $id);
		  $limits = LimitPeer::doSelect($c);
		  foreach ($limits as $l)
		  	$l->delete();
	 	  foreach ($arr as $a){
			  $limit = new Limit();
			  $limit->setAttrId($id);
			  $limit->setLimitation($a);
			  $limit->save();
		  }
	  }
  }

  public function executeRadioForm()
  {
  	  $name = $this->getRequestParameter('name');
	  $rank = $this->getRequestParameter('rank');
	  $inReport = $this->getRequestParameter('inReport');
	  $inSearch = $this->getRequestParameter('inSearch');
	  $content = $this->getRequestParameter('values');
	  $arr = split('-',$content);
	  
	  if($this->hasRequestParameter('typeId')){
	  	
		  $this->setFlash('edit','no');
		  $typeId = $this->getRequestParameter('typeId');
		  $this->typeId = $typeId;
		  
		  $c = new Criteria();
	      $c->add(TypePeer::ID , $this->typeId);
	      $type = TypePeer::doSelectOne($c);
	      $this->docTypeName = $type->getName();
		  
		  $attr = new Attribute();
		  $attr->setName($name);
		  $attr->setRequired(1); // man radio ro required gereftam
		  $attr->setRank($rank);
		  $attr->setInreport($inReport=='yes' ? 1:0);
		  $attr->setInsearch($inSearch=='yes' ?1:0);
		  $attr->setTypeId($typeId);
		  $attr->setTag("radio");
		  
		  if(!$this->attrExist($typeId,$name)){
			  $attr->save();
			  $attrId = $attr->getId();
			   
			  foreach ($arr as $a){
				  $limit = new Limit();
				  $limit->setAttrId($attrId);
				  $limit->setLimitation($a);
				  $limit->save();
			  }
		  }
		  else{
		  	  $this->setFlash('tag','radio');
		  	  $this->redirect('design/same?typeId='.$typeId);
		  }
	  }
	  else if($this->hasRequestParameter('id')){
	  	
	  	  $this->setFlash('edit','yes');	  	
		  $id = $this->getRequestParameter('id');
		  $c = new Criteria();
		  $c->add(AttributePeer::ID , $id);
		  $attr = AttributePeer::doSelectOne($c);
		  
		  $this->typeId = $attr->getTypeId();
  		  $c = new Criteria();
  		  $c->add(TypePeer::ID , $this->typeId);
  		  $type = TypePeer::doSelectOne($c);
  		  $this->docTypeName = $type->getName();
		
		  $c = new Criteria();
		  $c->add(AttributePeer::TYPE_ID , $this->typeId);
		  $this->res = AttributePeer::doSelect($c);
		  
		  $attr->setName($name);		  
		  $attr->setRank($rank);
		  $attr->setInReport($inReport=='yes' ? 1:0);
		  $attr->setInSearch($inSearch=='yes' ? 1:0);
		  $attr->save();
		  
		  $c = new Criteria();
		  $c->add(LimitPeer::ATTR_ID , $id);
		  $limits = LimitPeer::doSelect($c);
		  foreach ($limits as $l)
		  	$l->delete();
	 	  foreach ($arr as $a){
			  $limit = new Limit();
			  $limit->setAttrId($id);
			  $limit->setLimitation($a);
			  $limit->save();
		  }
	  }
  }
  
  public function executeDate()
  {
  	$this->typeId = $this->getRequestParameter('typeId');
  }
  
  public function executeDateForm()
  {
  	  $name = $this->getRequestParameter('name');
	  $rank = $this->getRequestParameter('rank');
	  $required = $this->getRequestParameter('required');
	  $inReport = $this->getRequestParameter('inReport');
	  $inSearch = $this->getRequestParameter('inSearch');

	if($this->hasRequestParameter('typeId')){
		  $this->setFlash('edit','no');
		  $typeId = $this->getRequestParameter('typeId');	  
	      $this->typeId = $typeId;
	      
	      $c = new Criteria();
	      $c->add(TypePeer::ID , $this->typeId);
	      $type = TypePeer::doSelectOne($c);
	      $this->docTypeName = $type->getName();
		  
		  $attr = new Attribute();
		  $attr->setName($name);
		  $attr->setRequired($required=='yes' ? 1:0); 
		  $attr->setRank($rank);
		  $attr->setInreport($inReport=='yes' ? 1:0);
		  $attr->setInsearch($inSearch=='yes' ?1:0);
		  $attr->setTypeId($typeId);
		  $attr->setTag("date");
		  
		  if(!$this->attrExist($typeId,$name)){
			  $attr->save();
			  $attrId = $attr->getId(); 
		  }
		  else{
		  	  $this->setFlash('tag','date');
		  	  $this->redirect('design/same?typeId='.$typeId);
		  }
	}

	else if($this->hasRequestParameter('id')){
		$this->setFlash('edit','yes');
	  	$id = $this->getRequestParameter('id');

		$c = new Criteria();
  		$c->add(AttributePeer::ID , $id);
  		$atr = AttributePeer::doSelectOne($c);
  		
  		$this->typeId = $atr->getTypeId();
  		$c = new Criteria();
  		$c->add(TypePeer::ID , $this->typeId);
  		$type = TypePeer::doSelectOne($c);
  		$this->docTypeName = $type->getName();
		
		$c = new Criteria();
		$c->add(AttributePeer::TYPE_ID , $this->typeId);
		$this->res = AttributePeer::doSelect($c);
  		
  		$atr->setName($name);
  		$atr->setRank($rank);
  		$atr->setRequired($required=='yes' ?1:0);
  		$atr->setInReport($inReport=='yes' ?1:0);
  		$atr->setInSearch($inSearch=='yes' ?1:0);
  		$atr->save();
	}
  }
  
  public function executeEdit()
  {
  	//$this->setFlash('action','edit');
  }
  
  public function executeDelete()
  { 	
  	//$this->setFlash('action','delete');
  }
  
  public function getNumDoc($docTypeName)
  {
  	$c = new Criteria();
  	$c->add(TypePeer::NAME , $docTypeName);
  	$res = TypePeer::doSelectOne($c);
  	$id = $res->getId();
  	
  	$c1 = new Criteria();
  	$c1->add(DocumentPeer::TYPE_ID , $id);
  	$docs = DocumentPeer::doSelect($c1);
  	return sizeof($docs);	
  	
  }
  
  public function executeDeleteAssure(){
  	
 	    $docTypeName = $this->getRequestParameter('docTypeName');
  		$this->docTypeName = $docTypeName;
  		
  		if(!$this->typeExist($docTypeName)){
	  		$this->setFlash('typeExist','no');
	  		$this->nearest = $this->getNearest($docTypeName);
  		}
  		else{
			$this->setFlash('typeExist','yes');
			 $c = new Criteria();
		  	 $c->add(TypePeer::NAME , $docTypeName);
		  	 $type = TypePeer::doSelectOne($c);
		  	 $type->delete();
  		} 
  		
  	}

  public function getNearest($docTypeName)
  {
  	$c = new Criteria();
  	$c->add(TypePeer::NAME , "%".$docTypeName."%" ,Criteria::LIKE);
  	$res = TypePeer::doSelect($c);
  	
  	$arr = array();
  	foreach ($res as $r)
  		$arr[]=$r->getName();
  	
  	return $arr;
  }
  
  public function executeEditForm()
  {
	//$this->setFlash('source','editform');
	$this->getUser()->setAttribute('source','editform');
	if($this->hasRequestParameter('docTypeName')){
		
		$docTypeName = $this->getRequestParameter('docTypeName');
		$this->docTypeName = $docTypeName;
		$c = new Criteria();
		$c->add(TypePeer::NAME , $docTypeName);
		$type = TypePeer::doSelectOne($c);
		$this->typeId = $type->getId();
	}
	else if($this->hasRequestParameter('id')){
		
		$id = $this->getRequestParameter('id');
		$this->typeId = $id;
		$c = new Criteria();
		$type = TypePeer::retrieveByPK($id);
		$this->docTypeName = $type->getName();
	}
	
	$c = new Criteria();
	$c->add(AttributePeer::TYPE_ID , $this->typeId);
	$this->res = AttributePeer::doSelect($c);
	
	
  }
  public function executeSave()
  {
  	$typeId = $this->getRequestParameter('typeId');
  	$newName = $this->getRequestParameter('newName');
  	$this->newName = $newName;
  	$c = new Criteria();
	$c->add(TypePeer::ID , $typeId);
	$type = TypePeer::doSelectOne($c);
	$this->preName = $type->getName();
	
	if($newName != '' && $newName != ' '){	
		$type->setName($newName);
		$type->save();
		$this->setFlash('docTypeName',$newName);
  	}
	else
		$this->setFlash('docTypeName',$this->preName);
  }
  
  public function executeEditAtr()
  {
  	$this->getUser()->setAttribute('source','editAtr');
  	
  	$id = $this->getRequestParameter('id');
  	$this->id = $id;
  	$c = new Criteria();
	$c->add(AttributePeer::ID , $id);
	$atr = AttributePeer::doSelectOne($c);
  	$this->tag = $atr->getTag();
  	$this->name = $atr->getName();
  	$this->required = $atr->getRequired();
  	$this->rank = $atr->getRank();
  	$this->inReport = $atr->getInReport();
  	$this->inSearch = $atr->getInSearch();
  	
  	$typeId = $atr->getTypeId();
  	$type = TypePeer::retrieveByPK($typeId);
  	$this->docTypeName = $type->getName();
  	
  	if($this->tag == 'input'){
  		$c = new Criteria();
		$c->add(LimitPeer::ATTR_ID , $id);
		$limit = LimitPeer::doSelectOne($c);
		$res = split('-',$limit->getLimitation());
		$this->from = '';
		$this->to = '';
		
		foreach ($res as $r){
			$r = trim($r);
			
			if($r == 'all' || $r == 'digit' || $r == 'letter')
				$this->content = $r;
				
			if(substr($r,0,4) == 'from')
				$this->from = substr($r,4);
				
			if(substr($r,0,2) == 'to')
				$this->to = substr($r,2);
					
			if(substr($r,0,3) == 'len')
				$this->length = substr($r,3);
		}
  	}
  	if($this->tag == 'checkbox' || $this->tag == 'radio' || $this->tag == 'selectTag' ){
  		$c = new Criteria();
		$c->add(LimitPeer::ATTR_ID , $id);
		$limit = LimitPeer::doSelect($c);
		$values = '';
		foreach ($limit as $l){
			if($values == '')
				$values = $l->getLimitation();
			else	
				$values = $values.'-'.$l->getLimitation();
		}
		$this->values = $values;
		
  	}
  }
  
  public function executeDelAtr(){
  	$atrid = $this->getRequestParameter('atrid');
  	$c = new Criteria();
  	$c->add(AttributePeer::ID , $atrid);
  	$atr = AttributePeer::doSelectOne($c);
  	$this->atrname = $atr->getName();
  	$this->typeId = $atr->getTypeId();
  	$atr->delete();
  	
  	$c = new Criteria();
  	$c->add(AttributePeer::TYPE_ID , $this->typeId);
  	$this->res = AttributePeer::doSelect($c);
  	$this->setFlash('source','editform');
  }

  public function executeSearch()
  {
  	
  }
  
  public function executeShowResult()
  {
  	$name = $this->getRequestParameter('name');
  	$radio = $this->getRequestParameter('radio');
  	
 	 $c = new Criteria();
  	 if($name != ''){
  		if($radio == 'wholeWord')
  			$c->add(TypePeer::NAME , $name);
  		else
  			$c->add(TypePeer::NAME , '%'.$name.'%' , Criteria::LIKE );	
  	}
  	
  	$res = TypePeer::doSelect($c);
  	$this->res = $res;
  	
  	$this->size = sizeof($res);
  }
  
}
 



