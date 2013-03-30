<?php 
	sfLoader::loadHelpers('Javascript');
	sfLoader::loadHelpers('Text');
  	sfLoader::loadHelpers('Helper');
  	sfLoader::loadHelpers('Tag');
  	sfLoader::loadHelpers('Form');
  	sfLoader::loadHelpers('Object');
	sfLoader::loadHelpers('Url');
	sfLoader::loadHelpers('Date');
	sfLoader::loadHelpers('I18N');  	  	  	

class documentActions extends sfActions
{
  
  public function executeIndex(){
  	$this ->redirect('document/selectUser');
  }
  
  public function executeSelectUser(){
  	
  	$uid = $this ->getUser()->getAttribute('uid');
  	//echo $uid."uid"; 
    $user = UserPeer::retrieveByPK($uid);
  	//$uid = $this ->getUser()->getAttribute($uid);
  	$this->uid = $uid; 
  	
  	if($user->getCredential()  == 'user'){
  		$this -> users = UserPeer::retrieveByPKs( array($user->getId()));	
  	}else{
  		$this -> users = UserPeer::doSelect(new Criteria());
  	}
  	
  	$c = new Criteria();
  	$c -> add(DocumentPeer::USER_ID,$uid,Criteria::EQUAL);
  	$this -> docs = DocumentPeer::doSelect($c);
  	
  	$c = new Criteria();
	$c -> add(SharedPeer::USER_ID,$uid,Criteria::EQUAL);
	
	$shareds = SharedPeer::doSelect($c);
	$pks = $this -> getPKs($shareds);
	$this ->shareds = DocumentPeer::retrieveByPKs($pks);

  }
  
  public function executeShare(){
  	if( $this -> getRequest()->getMethod() != sfRequest::POST){
	  	//echo 'shootz';
  		$this->docid = $this->getRequestParameter('docid');
	  	$this -> users = UserPeer::doSelect(new Criteria());
  	}else {
  		//echo 'nitz';
  		$this -> docid = $this->getRequestParameter('docid');
  		$users = UserPeer::doSelect(new Criteria());
  		foreach ($users as $user){
  			//echo $user ->getId()." ".$user->getFullName()."<br>";
  			if ( $this->getRequestParameter($user->getId()) == $user ->getFullName()){
  				//echo "yes <br>";

  				// shayad khodash owner bashad
  				$owner = DocumentPeer::retrieveByPK( $this->docid );
  				
  				// shayad ghablan dar eshterak bashad  				
  				$c = new Criteria();
  				$c -> add(SharedPeer::DOC_ID,$this->docid,Criteria::EQUAL);
  				$c -> add(SharedPeer::USER_ID,$user -> getId(),Criteria::EQUAL);
  				$hit = SharedPeer::doSelectOne($c);
  				
				if ( $owner -> getUserId() != $user->getId() && $hit == NULL){
				  				  
	  				$temp = new Shared();
	  				$temp ->setDocId($this -> docid);
	  				$temp ->setUserId($user->getId());
	  				$temp ->save();
				}

  			}
  		}
  		$this -> setFlash('share','سند با موفقیت به اشتراک گذاشته شد'); 
  		$this -> redirect('document/selectUser');
  		
  	}
  	
  }
  
  public function executeFindUser(){
  	
  		$this -> docid = $this->getRequestParameter('docid');
  		$name = $this->getRequestParameter('username');
  		$name = trim($name);
  		//echo $name."<br>";
  		$name_arr = split(" ",$name);
  		foreach ($name_arr as $name)
  			trim($name);
		$name_arr = array_unique($name_arr);
		  			
  		$resArr = array();
  		foreach ($name_arr as $name){
//  			echo 'hits '.$name."<br>";
	  		$c = new Criteria();
	  		$c->add(UserPeer::FIRST_NAME,'%'.$name.'%',Criteria::LIKE);
	  		$userByFName = UserPeer::doSelect($c);
			$resArr = array_merge($userByFName,$resArr);
			
	  		$c = new Criteria();
	  		$c->add(UserPeer::LAST_NAME,'%'.$name.'%',Criteria::LIKE);
	  		$userByLName = UserPeer::doSelect($c);
	  		$resArr = array_merge($userByLName,$resArr);
  		}
  		//$this -> users = array_merge($userByFName,$userByLName);
  		
  		$this -> users = $resArr;
  		
  }
  
  public function executeList(){
  	$this->setLayout(false);
	$userid = $this -> getRequestParameter('users');
	//$this -> uid = $userid;
	$this -> user = UserPeer::retrieveByPK($userid);
	$c = new Criteria();
	$c -> add(DocumentPeer::USER_ID,$userid,Criteria::EQUAL);
	
	$this -> docs = DocumentPeer::doSelect($c);
	
	
	$c = new Criteria();
	$c -> add(SharedPeer::USER_ID,$userid,Criteria::EQUAL);
	
	$shareds = SharedPeer::doSelect($c);
	$pks = $this -> getPKs($shareds);
	//echo 'num pks '.count($pks);
	//echo 'oh <br>'.$pks[0].'<br>';
	$this ->shareds = DocumentPeer::retrieveByPKs($pks);
	//echo 'num chared '.count($this ->shareds);
 
  }
  
  public function executeSave(){
  	
  	$notValid = false ;
  	$msg = ""; 
  	//$this ->getUser()->setParameter()
  	
  	$docid = $this->getRequestParameter('docid');
  	
  	$c = new Criteria();
  	$c -> add(DocumentPeer::ID,$docid,Criteria::EQUAL);
  	$doc =  DocumentPeer::doSelectOne($c);
  	$typeId = $doc -> getTypeId();
  	
  	$c = new Criteria();
  	$c->add(AttributePeer::TYPE_ID,$typeId,Criteria::EQUAL);
  	$attrs = AttributePeer::doSelect($c);
  	
  	foreach ($attrs as $attr){
  		$value = $this -> getFormValue($attr,$docid,$typeId);
  		$isRequired = $attr -> getRequired();
  		//echo $attr->getName()."<br>";
  		//echo "val : ".$value."<br>";
  		if( $value == ''){
  			if($isRequired){
  				$notValid = true; 
				$msg = $msg ."فیلد \"".$attr->getName(). " \" را پر نکرده اید. <br> ";
  			}
  			
  		}
  		
  		else {
  			
 			if( $this -> validInput($attr,$value)){ 
				  			 	
	 			 $v = new Value();
	  			 $v ->setAttrId($attr->getId());
	  			 $v->setVal($value);
	  			 $v->setDocId($docid);
	  			 $v->save();
 			}else {
 				$notValid = true;
 				$msg = $msg . "مقدار فیلد \" ".$attr->getName()."  \" معتبر نمی باشد.";
 			}
  		}
  		
  	}
  	
  	if($notValid){
  		$c = new Criteria();
  		$c -> add(ValuePeer::DOC_ID,$docid,Criteria::EQUAL);
  		$vals = ValuePeer::doSelect($c);
  		foreach ($vals as $val){
  			$val-> delete();
  		}
  		$this->setFlash('required',$msg);
  		$this->redirect('document/addField?docid='.$docid);
  	}
  	$this->redirect('document/selectUser');
  }
  
  public function  executeCreate(){
  	$this->types = TypePeer::doSelect(new Criteria());
	  	
  }
  
  
  public function executeDelete(){
  	$docid = $this -> getRequestParameter('docid');
  	
  	$c = new Criteria();
  	$c -> add(SharedPeer::DOC_ID,$docid,Criteria::EQUAL);
  	$shareds = SharedPeer::doSelect($c);
  	foreach ($shareds as $shared )
  		$shared -> delete();
  	
  	$c = new Criteria();
  	$c -> add(ValuePeer::DOC_ID,$docid,Criteria::EQUAL);
  	$vals = ValuePeer::doSelect($c);
  	foreach ($vals as $val)
  		$val -> delete();
  		
  	$doc = DocumentPeer::retrieveByPK($docid);
  	$uid = $doc->getUserId();
  	$doc -> delete();
  	
  	
  	$filename = $uid.'_'.$doc->getPath();
	unlink("C:/wamp/www/new repository/web/uploads/".$filename);
  	
  	$this -> redirect('document/list?users='.$uid);

  	/*
  	 * **************
  	 */
  	// file delete nashod
  	
  	
  }
  
  public function executeShow(){
  	 
  	$docid = $this->getRequestParameter('docid');
  	$this -> doc = DocumentPeer::retrieveByPK($docid);
  	$this -> owner = UserPeer::retrieveByPK($this ->doc ->getUserId());
  	$this -> doctype = TypePeer::retrieveByPK($this -> doc->getTypeId());
  	$typeid = $this -> doctype -> getId();
  	$c = new Criteria();
  	$c -> add(ValuePeer::DOC_ID,$docid,Criteria::EQUAL);
  	$valuse = ValuePeer::doSelect($c);
  	$this -> code = "";
  	
  	$canEdit = false ; 
  	$uid = $this->getUser()->getAttribute('uid'); 
  	if($uid == $this-> doc->getUserId() )
  		$canEdit = true; 
  	else if ( UserPeer::retrieveByPK($uid) -> getCredential() != "user"){
  		$canEdit = true; 
  	}
  	//echo "can edit ".$canEdit."<br>";
  	foreach ($valuse as $value){
  		$attr = AttributePeer::retrieveByPK($value ->getAttrId());
  		//echo "yes<br>";
  		//echo "atrName  ".$attr->getName()."<br>";
  		$this -> code = $this -> code . $this ->getShowCode($attr , $value,$canEdit,$docid).'<br>';
  		
  	}
  	$this ->docname = $this ->doc ->getUserId()."_".$this->doc->getPath();
  }
  
  public function executeEdit(){
  	
  		$this -> docid =  $this->getRequestParameter('docid');

    	$this -> attrid =  $this->getRequestParameter('attrid');
	    //echo $this->attrid;
  	
	    $c = new Criteria();
	  	$c  -> add(LimitPeer::ATTR_ID,$this->attrid,Criteria::EQUAL);
	  	$limits = LimitPeer::doSelect($c); 
	    
  		//echo "<br> id".$this->attrid."<br>";
	    $attr = AttributePeer::retrieveByPK($this -> attrid);
	    if($attr == NULL)
	    	echo "null<br>";
	    $name = $attr ->getName();
	    $this -> info1 = input_hidden_tag( 'docid'  ,$this->docid );
	    $this -> info2 = input_hidden_tag( 'attrid' ,$this->attrid);
	  	$this -> code = array ( 'name' => $name , 'code' => $this-> makeTagCode($attr->getId(),$attr ->getTag() , $limits));
	
  }
  
  public function executeChange(){
 	$docid = $this->getRequestParameter('docid');
  	$attrid = $this->getRequestParameter('attrid');
  	$this->docid = $docid;
  	$attr = AttributePeer::retrieveByPK($attrid);
  	$doc = DocumentPeer::retrieveByPK($docid);
  	$value = $this -> getFormValue($attr,$docid,$doc->getTypeId());
  	if ($value == "" && $attr ->getRequired() )
  		$this -> msg ="مقدار ورودی معتبر نمی باشد";
  	else if  ($this->validInput($attr,$value)){
  		$c = new Criteria();
  		$c -> add(ValuePeer::ATTR_ID,$attrid,Criteria::EQUAL);
  		
  		$oldValue = ValuePeer::doSelectOne($c);
  		$oldValue->delete();
  		
  		$v = new Value();
	  	$v ->setAttrId($attr->getId());
	    $v->setVal($value);
	  	$v->setDocId($docid);
	  	$v->save();
  		
	  	$this -> msg = "ویرایش سند با موفقیت انجام شد.";
	  	//$this->getRequest()->setErrors('msg',"ویرایش سند با موفقیت انجام شد.");
  		
  	}else {
  	 	$this -> msg ="مقدار ورودی معتبر نمی باشد";
  	 	//$this->getRequest()->setErrors('msg',"مقدار ورودی معتبر نمی باشد."); 
  	}
  	//$this->redirect('document/show?docid/'.$docid);
  }
  
  public function executeUpload(){
  	
  	if ($this->getRequest()->getFileName('file') != NULL ){
	  	//echo 'mehran';
  		$typeId =  $this->getRequestParameter('type');
	  	
	  	$fileName = $this->getRequest()->getFileName('file');
		
		$uid = $this->getUser()->getAttribute('uid');
	    $this->getRequest()->moveFile('file', sfConfig::get('sf_upload_dir').'/'.$uid.'_'.$fileName);
	    
	    $doc = new Document();
	    $doc -> setTypeId($typeId);
	    $doc -> setUserId($uid);
	    $doc -> setPath($fileName);
	    $doc -> save();
	    $did = $doc ->getId();
	    $this->redirect('document/addField?docid='.$did);
  	}else{
  		$this -> redirect('document/create?error=nofile');
  	}
  	
  }
  
  public function executeAddField(){
  	
  	$docid = $this->getRequestParameter('docid');
  	$c = new Criteria();
  	$c -> add(DocumentPeer::ID,$docid,Criteria::EQUAL);
  	$doc =  DocumentPeer::doSelectOne($c);
  	$typeId = $doc -> getTypeId();
  	
  	$c = new Criteria();
  	$c->add(AttributePeer::TYPE_ID,$typeId,Criteria::EQUAL);
  	$attrs = AttributePeer::doSelect($c);
  	//$attrs = usort($attrs,"cmp");
  	$attrs = $this->sortArr($attrs);
//  	foreach( $attrs as $attr){
//  		echo $attr -> getRank()."<br>";
//  	}
  	$this -> fields = $this -> getTag($typeId , $attrs);
  	$this -> docid = $docid;
  	
  }
  
  public function executeSearch(){
  	
  	$this -> pageNum = $this->getRequest()->getParameter('page');
  	
  	if ($this -> pageNum == '')
  		 $this -> pageNum = 1;
  		  
  	if($this -> pageNum == 1  ){
  		$docTypes = TypePeer::doSelect(new Criteria());
  		$this -> options = $this -> makeOptionArray($docTypes);
  		
  	}else if ($this -> pageNum == 2){
  		$this -> owner = $this ->getRequest()->getParameter('owner');
  		$this -> doctype = $this ->getRequest()->getParameter('doctype');
  		
  		if($this -> doctype == 0 ){
  			$this -> redirect("document/result?doctype=".$this->doctype."&owner=".$this->owner);
  			
  		}else {
  			$c = new Criteria();
  			$c -> add (AttributePeer::TYPE_ID,$this->doctype , Criteria::EQUAL);
  			$c -> add (AttributePeer::INSEARCH,true, Criteria::EQUAL);
  			
  			$attrs = AttributePeer::doSelect($c);
  			$this -> fields = $this -> getTag($this->doctype , $attrs);
  			
  		}
  	}
  }
  
  public function executeResult(){
  	$credential = $this->getUser()->hasCredential('admin');
  	$uid = $this->getUser()->getAttribute('uid'); 
  	$ownername = $this ->getRequestParameter('owner');
  	$doctype = $this->getRequestParameter('doctype');
  	$this->doctypeid = $doctype; 
  	//echo "uid ".$uid."<br>";
  	if($doctype == 0 ){
  		if ($ownername == "" || $ownername == " "){
	  		$docs = DocumentPeer::doSelect(new Criteria());
	  //			echo " num 1 ".count($docs)."<br>";
			if($credential == false){
		//		echo "heY";
				$docs = $this-> deleteSomeDocs($docs,$uid);
			//	echo " num 2 ".count($docs)."<br>";
			}  		
	  	}
	  	else {
		  	$users = $this ->getUserArr($ownername);// object az noe user barmigardanad.
		  	if ($users == NULL)
		  		$docs = Null; 
			else{ 		  		
		  		$docs = $this -> getDocsWithUser($users,-1);
			}
	  		
			if($credential == false){
				$docs = $this-> deleteSomeDocs($docs,$uid);
			}
		  	
	  	} 
  		$this -> docs = $docs;
  	}else {
  		if($ownername == ""){
  			$c = new Criteria();
  			$c ->add(DocumentPeer::TYPE_ID,$doctype,Criteria::EQUAL);
  			$docs = DocumentPeer::doSelect($c); 
  		}else {  		 	 
	  	  	$users = $this ->getUserArr($ownername);// object az noe user barmigardanad.
	  	  	//echo "num ".count($users)."<br>";
		  	$docs = $this -> getDocsWithUser($users,$doctype);
	  	 	//echo "lenght ".count($docs)."<br>";
  		}
  		
  		if($credential == false){
				$docs = $this-> deleteSomeDocs($docs,$uid);
		}
  		
  		
  		$c = new Criteria();
  		$c -> add (AttributePeer::TYPE_ID,$doctype , Criteria::EQUAL);
  		$c -> add (AttributePeer::INSEARCH,true, Criteria::EQUAL);
  		$attrs = AttributePeer::doSelect($c);
  		$toSearchArr = array ();
  		foreach ($attrs as $attr){
  			$docid = -1; 
  			$value = $this -> getFormValue($attr,$docid,$doctype);// in docid aslan niaz nist
  			$toSearchArr[$attr->getName()] = $value ; 
  		}
  		/***********for test
  		foreach ($toSearchArr as $a )
  			echo $a."<br>"; 
  			echo "<br><br>";
  		
  		//*****************/
  		//array_unique($docs);
  		//foreach ($docs as $doc)
  			//echo $doc->getPath()."<br>";
  		$this -> docs = $this -> getCorrectDocs ($docs , $attrs, $toSearchArr);
  		$this -> createReport($this->docs , $doctype);// doctype is a number id!
  	}
  	
  }
  
  public function createReport($docs , $doctypeid){
  	
  	$type = TypePeer::retrieveByPK($doctypeid);

  	$c = new Criteria();
  	$c -> add(AttributePeer::TYPE_ID,$doctypeid,Criteria::EQUAL);
  	$c -> add(AttributePeer::INREPORT,true,Criteria::EQUAL);
  	$attrs = AttributePeer::doSelect($c);
  	
  	$attrs = $this ->sortArr($attrs);
  	$t_head = $this -> makeHeading($attrs);
  	$t_body = $this -> makeBody($attrs,$docs);
  	$this -> makeFile($t_head,$t_body);
  	
  }
  public function makeFile($table_head,$table_body){
  	$code = 
  	$code = "<html>\n";
  	$code = $code ."<head>\n";
  	$code = $code ."<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
  	$code = $code ."<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"/new repository/web/css/report.css\" />\n";
  	// in linke css mano kosht chon localhost hast ghaziye fargh dare!     
  	$code = $code ."</head>\n";
  	$code = $code ."<body >\n";
  	$code = $code ."<br >\n";
  	
  	$code = $code . "<center>\n";
  	$code = $code . "<h2 id=\"heading\">این گزارش توسط سامانه ی انباره ی مستندات تهیه شده است.</h2>\n";
  	$code = $code . "<div id = \"date\"> تاریخ گزارش گیری: ".format_date(time(),'U','fa_IR') ."</div><br>\n";
  	$code = $code . "<table id =\"report\" >\n";
  	$code = $code . $table_head ."\n". $table_body ;
  	$code = $code . "</table>\n";
  	$code = $code . "</center>\n"; 
  	$code = $code ."</body>\n";
  	$code = $code ."</html>\n";
  	
  	$filePath = "C:/wamp/www/new repository/web/archive/report.html";
	 $fh = fopen($filePath , 'w') or die("can't open file");
	fwrite($fh, $code);
	fclose($fh);
  	//return $code; 
  }
  public function makeHeading($attrs){
  		
  		$code = "<tr>\n";
  		$code = $code . "<th>نام سند</th>\n";
  		$code = $code . "<th>صاحب سند</th>\n";
  		$code = $code . "<th>نوع سند</th>\n";
  		
  		foreach ( $attrs as $attr ){
  			$code = $code . "<th>".$attr -> getName()."</th>\n";
  		}
  		$code = $code . "</tr>\n";
  		return $code; 
  }
  
  public function makeBody($attrs,$docs){
  	$code = "";
  	foreach ($docs as $doc){
  		//echo $doc->getPath();
  		$code = $code . "<tr>\n";
  		
  		$code = $code . "<td>".$doc ->getPath(). "</td>\n";
  		
  		$ownerid = $doc -> getUserId();
  		$user = UserPeer::retrieveByPK($ownerid);  
  		$code = $code . "<td>".$user->getFullName(). "</td>\n";
  		
  		$doctypeid = $doc ->getTypeId();
  		$type = TypePeer::retrieveByPK($doctypeid);
  		$code = $code . "<td>".$type->getName(). "</td>\n";
  		
  		foreach($attrs as $attr){
  			$c = new Criteria();
  			$c -> add(ValuePeer::ATTR_ID,$attr->getId(),Criteria::EQUAL);
  			$c -> add(ValuePeer::DOC_ID,$doc->getId(),Criteria::EQUAL);
  			$value = ValuePeer::doSelectOne($c);
  			if($value == NULL){
  				$value = "";
  			}
  			else {
	  			if($attr->getTag() == "checkbox"){
	  				$value = $this -> prepareCheckBoxValue($value->getVal());
	  				
	  			}	
	  			else {
	  				$value = $value -> getVal();
	  			}
  			}
  			
  			$code = $code . "<td>".$value."</td>\n";
  			
  		}
  		
  		$code = $code . "</tr>\n";
  	}
  	return $code;
  }
  
  public function prepareCheckBoxValue($value){
  	$prepared = "";
  	$arr = split("#",$value);
  	$i = 0 ; 
  	while($arr[$i] == "" && $i < count($arr)){
  		$i++; 
  	}
  	if ($i == count($arr))
  		return "";
  	else {
  		$prepared = $arr[$i];
  		for ($j = $i + 1 ; $j < count($arr); $j++){
  			if($arr[$j] != ""){
  				$prepared = $prepared . " <br> ".$arr[$j];
  				
  			}
  		}
  		return $prepared; 
  	}
  }
  public function getCorrectDocs($docs ,$attrs, $toSearchArr){
  	$goodDocs = array();
  	foreach ($docs as $doc ){
  		if ( $this -> hasDocSearchItem($doc,$attrs, $toSearchArr) )
  			$goodDocs[]= $doc ;
  	}
  	return $goodDocs;
  }
  
  public function hasDocSearchItem($doc,$attrs,$toSearchArr){
 
  	foreach ($attrs as $attr ){
  		$val = $toSearchArr[$attr->getName()];
//  		echo "attr ". $attr->getName()."<br>";
//  		echo "value to search ".$val."<br>";
  		
  		if ($val == "")
  		 continue; 
  		$c = new Criteria();
  		$c ->add(ValuePeer::ATTR_ID,$attr->getId(),Criteria::EQUAL); 
  		$c ->add(ValuePeer::DOC_ID,$doc->getId(),Criteria::EQUAL);
  		//echo 'atrid '.$attr->getId().'<br>';
  		//echo 'docid '.$doc->getId().'<br>';
  		$value = ValuePeer::doSelectOne($c);
  		//echo "value".$value->getVal()."<br>";
  		if ($value == NULL)
  			echo "null";
  		if(substr_count( $val,$value->getVal()) == 0 ){
  			//echo "was false 2"."<br>";
  		}
  		if(substr_count($value->getVal(), $val) == 0 ){
  			//echo "was false"."<br>";
  			return false ;
  		}
  			 
  			
  	}
  	return true; 
  }
  
  public function getDocsWithUser($users,$typeid){
  	$docs = array ();
  	if ($users == NULL ){
  		$c = new Criteria();
  		if ($typeid != -1 ){
  			$c ->add(DocumentPeer::TYPE_ID,$typeid,Criteria::EQUAL);
  		}
  		return DocumentPeer::doSelect($c);
  	}
  	foreach ( $users as $user ){
  		$c = new Criteria();
  		$c -> add(DocumentPeer::USER_ID,$user->getId(),Criteria::EQUAL);
  		if ($typeid != -1 ){
  			$c ->add(DocumentPeer::TYPE_ID,$typeid,Criteria::EQUAL);
  		}
  		$docs = array_merge(DocumentPeer::doSelect($c),$docs);
  	}	
  	return $docs ; 
  }
  
  public function getUserArr($name){ // object as noe user barmigardanad
  	$name = trim($name);
  	$name_arr = split(" ",$name);
  	foreach ($name_arr as $name)
  		trim($name);
	$name_arr = array_unique($name_arr);
	  			
  	$resArr = array();
  	foreach ($name_arr as $name){

  		$c = new Criteria();
  		$c->add(UserPeer::FIRST_NAME,'%'.$name.'%',Criteria::LIKE);
  		$userByFName = UserPeer::doSelect($c);
		$resArr = array_merge($userByFName,$resArr);
		
  		$c = new Criteria();
  		$c->add(UserPeer::LAST_NAME,'%'.$name.'%',Criteria::LIKE);
  		$userByLName = UserPeer::doSelect($c);
  		$resArr = array_merge($userByLName,$resArr);
  	}
  	//$this -> users = array_merge($userByFName,$userByLName);
  	return $resArr;
  }
 
  public function makeOptionArray($docTypes){
  	$arr = array();
  	$arr['0'] = "همه ی موارد";
  	 
  	foreach ($docTypes as $docType){
  		$arr[$docType->getId()] = $docType->getName();
  	}
  	return $arr;  	
  	
  }
  
  public function getTag($typeId , $attrs){
  	$tags = array();
  	//$counter = 0 ; 
  	foreach ($attrs as $attr){
  		///$counter ++ ; 
  		$attrName = $attr -> getName();
  		$tag = $attr -> getTag();
  		$attrId = $attr ->getId();
  		
  		$c = new Criteria();
  		$c  -> add(LimitPeer::ATTR_ID,$attrId,Criteria::EQUAL);
  		$limits = LimitPeer::doSelect($c); 
  		$tagcode = $this -> makeTagCode($attrId,$tag , $limits );
  		if($attr->getRequired() == true)
  			$tagcode = "*** ".$tagcode;
  		$tags[] = array ('name' => $attrName , 'tag'  => $tagcode);
  		// Required!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  	}
  	return $tags; 
  }
  
  public function  makeTagCode($attrid,$tag , $limits){
  	if ($tag == 'input'){
  		foreach ($limits as $limit){
  			$limitArr = split("-",$limit->getLimitation());
  			$code = $this->toPrint($limitArr);
  			//$code = '';
  		}
  		return "<br>".input_tag($attrid).$code;
  			
  	}else if ($tag == 'radio'){
  		$code = "";
  		foreach ($limits as $limit){
  		 	$code = $code . $limit -> getLimitation().radiobutton_tag($attrid,$limit->getLimitation()).' <br/>';;
  		}
  		return $code;
  		
  	}else if ($tag == 'checkbox'){
		 $code = ""; 
		 foreach ($limits as $limit){
		 	$lid = $limit -> getId();
		 	$lim = $limit -> getLimitation();
		 	//$code = $code . $limit -> getLimitation() . object_checkbox_tag($limit,'getLimitation').' <br/>';
		 	$code = $code . $limit -> getLimitation().checkbox_tag($lim,$lid).' <br/>';
		 }
		 return $code; 
		 
  	}else if ($tag == 'selectTag'){
  		return select_tag($attrid , objects_for_select($limits,'getId','getLimitation'));
 		
  	}else if ($tag == 'textarea'){
  		return textarea_tag($attrid,'');
  	}else if ($tag == 'date'){
  	  	return input_date_tag($attrid,null, 'rich=true');	
  	}else {
  		echo 'function makeTagCode : the tag name does not exist ';
  	}
  	
  }
	
  public function getFormValue($attr,$docid,$typeid){
  		$tag = $attr->getTag();
  		$atrid = $attr->getId();
  		if ($tag == 'input'){
  			
  			// ahyanan in value bayad yek seri check ham beshavad.
  			return $this ->getRequestParameter($atrid);
   		}else if ($tag == 'radio'){
  			return $this ->getRequestParameter($atrid);
  		}else if ($tag == 'checkbox'){
  			
  			$c = new Criteria();
  			$c -> add(LimitPeer::ATTR_ID,$atrid,Criteria::EQUAL);
  			$limits = LimitPeer::doSelect($c);
  			$val = '';
  			foreach ($limits as $limit){
  				if($this->getRequestParameter($limit->getLimitation()) == $limit->getId())
  					$val = $val .'#'. $limit->getLimitation();
  			}
  			
  			return $val ; 
 			//?? 			
  		}else if ($tag == 'textarea'){
  			return $this ->getRequestParameter($atrid);
  		}else if ($tag == 'selectTag'){
  			$limitid =  $this->getRequestParameter($atrid);
  			$c= new Criteria();
  			$c -> add(LimitPeer::ID,$limitid,Criteria::EQUAL);
  			$limit = LimitPeer::doSelectOne($c);
  			return $limit->getLimitation();
  		}else if ($tag == 'date'){
  			return $this->getRequestParameter($atrid);
  		}else {
  			echo 'function getFormValue : the tag name does not exist';
  		}
  		
  	}

  	public function getPKs($shareds){
  		$tarr = array();
  		foreach ($shareds as $shared){
  			
  			$tarr[] = $shared -> getDocId();
  		}
  		return $tarr;	
  	}
  	
  	public function getShowCode($attr , $value,$canEdit,$docid){
		$code = "";
  		$code = $code .'<tr>'; 
  		$code = $code . '<td>'. $attr -> getName().'</td>'; 
  		$tag = $attr -> getTag();
  		if ($tag == 'input'){
  			$code = $code . '<td>'. $value->getVal(). '</td>'; 
  			
  		}else if ($tag == 'selectTag'){
  			$code = $code . '<td>'.$value->getVal(). '</td>'; 
  		}else if ($tag == 'textarea'){
  			$code = $code . '<td>'. $value->getVal(). '</td>'; 
  		}else if ($tag == 'checkbox'){
  			$vs = split('#',$value->getVal());
  			$code = $code . '<td>';	
  			foreach ($vs as $v){
  				$code = $code .$v. '<br/>';
  			}
  			$code = $code . '</td>';
  		}else if ($tag == 'radio'){
  			$code = $code . '<td>'. $value->getVal(). '</td>'; 
  		}else if ($tag == 'date'){
  			$code = $code . '<td>'.$value->getVal(). '</td>';
  		}else{
  			$code = $code . "function getShowCode : the tage name does not exist"; 
  		}
  	
  		if ($canEdit){
  			//echo $canEdit." mehran";
  			//$code = $code."yes";
  			$code = $code . "<td>".form_remote_tag(
  				array('url' => 'document/edit?docid='.$docid.'&attrid='.$attr->getId(),'update' => 'toEdit')).submit_tag('ویرایش ')."</form></td>";
  			
  		}
  		$code = $code .'</tr>'; 
  		return $code;  
  	}
  	
  	public function toPrint($limitArr){
  		$arrlen = count($limitArr);
  		$typeVal = $limitArr[0];
  		
  		$code = "<br>"; 
  		$code = $code."<div style=\"font-size:14px\">";// badan dar in css ezafe konam
  		foreach ($limitArr as $limit){
	  		if ($limit == 'digit'){
	  			$code = $code. " فقط رقم بنویسید.<br>";
	  			
	  		}else if ($limit == 'letter'){
	  			$code = $code. "فقط حرف بنویسید. <br>";
	  		}else if ($limit == 'all'){
	  			
	  		}else if( substr_count($limit, 'from') == 1 ){// != 0 
	  			$num = trim(substr($limit,4));
	  			$code = $code. " عددی بیشتر از   ".$num." وارد کنید.<br>";
	  		}else if ( substr_count($limit, 'to') == 1){// !=0 
	  			$num = trim(substr($limit,2));
	  			$code = $code. "عددی کمتر از    ".$num."  وارد کنید.<br>";
	  		}else if ( substr_count($limit,'len') == 1 ){
	  			$num = trim(substr($limit,3));
	  			$code = $code." حداکثر به طول ".$num." باشد.<br>";
  			}else {
	  			echo $code . "function toPrint : the type name does not exist";
	  		}		
  		}
  		$code . "</div>";
  		return $code;
  	}
	
  public function validInput( $attr , $value ){
  	
  	$isValid = true; 
  	
  	if( $attr-> getTag() == 'input' ){
  		$atrid = $attr->getId();
  		$c = new Criteria();
  		$c ->add(LimitPeer::ATTR_ID,$atrid,Criteria::EQUAL);
		$limit = LimitPeer::doSelectOne($c);
		$limitation = $limit ->getLimitation();
			
		//$value = utf8_decode($value,'utf8');
		//echo "valu  ".$value; 
		//echo "<br>limit  ".$limitation."<br>";	
		$arr = split("-",$limitation);
		foreach ($arr as  $a){
			if ( $a == "letter"){
			//	echo "val ".$value."<br>"; 
			//	echo $this->checkIsLetter($value)."<br>";
				$isValid = $this -> checkIsLetter($value) && $isValid;
			//	echo "<br>isVal".$isValid."<br>"; 
				continue;
			}
			if ( $a == "digit" ){
				$isValid = $this -> checkIsDigit($value) && $isValid; 
				continue;
			}
			if( $a == "all"){
				continue; 
			}
			if( substr_count($a,"from") == 1 ){
				$min = substr($a,4);
				if ($min > $value){
					//echo "<br>from<br>";
					$isValid = false ;
				}
				continue;	 
			}
			if(  substr_count($a,"to") == 1 ){
				
				$max = substr($a,2);
				if ($max < $value){
					//echo "<br>to<br>";
					$isValid = false;
				}
				continue; 
			}
			if( substr_count($a,"len") == 1 ){
				
				$len = substr($a,3);
				if($len <  mb_strlen($value,'utf8')){
					//echo "<br>len<br>";
					$isValid = false ;
				}
				continue; 
			}
		}
		return $isValid; 
  	}
  	
  	 return true;
  }
  
  public function checkIsDigit($value){
  	for ( $i = 0 ; $i < mb_strlen($value,'utf8') ; $i++ ){
  		if( $value[$i] < 0 && $value[$i] > 9 )
  			return false; 
  	}
  	return true; 
  }
  
  public function checkIsLetter($value){
  	$value = mb_strtolower($value,'utf8');
  	$len = mb_strlen ($value, 'UTF-8');
  	for ($i = 0; $i < $len; $i++) {
    	$char = mb_substr ($value, $i, 1, 'UTF-8');
    	
    	if ( ! $this -> isChar($char) ){
			//echo "char ".$char."<br>";
    		return false; 
    	}
  	}
    return true; 	
  }

  public function isChar($c){
  	$arr = array ("ا","ب","پ","ت","ث","ج","چ","ح","خ","د","ذ","ر","ز","ژ","س","ش","ص","ض","ط","ظ","ع"
  	,"غ","ف","ق","ک","گ","ل","م","ن","و","ه","ی","ئ","آ",
  	"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"," ");
  	
  	foreach ($arr as $a ){
  		if ($c == $a)
  			return true; 
  	}
  	return false ; 
  	
  }
  
   public function sortArr($arr){
  
  	for($i =1 ;$i<count($arr) ; $i++){
  			$val = $arr[$i];
  			$j = $i-1;
  			while( $j>=0 && $arr[$j]->getRank() > $val->getRank()){
  				$arr[$j+1] = $arr[$j];
  				$j--;
  			}
  			$arr[$j+1] = $val;
  	}
//  	echo "sort<br>";
//  	for($i = 0 ; $i < count($arr) ; $i++){
//  		echo $i . "  ".$arr[$i]->getRank()."<br>";
//  	}

  	return $arr; 	
  }
  public function executeTest(){
  	$docs = DocumentPeer::doSelect(new Criteria());
  	$uid = $this->getUser()->getAttribute('uid');
  	echo "uid ".$uid;
  	echo "<br>";
  	$docs = $this->deleteSomeDocs($docs,$uid);
  	foreach ($docs as $doc)
  		echo "inja  ".$doc->getPath()."<br>";
  	
  }
  public function deleteSomeDocs($docs , $uid){
  	$goodDocs = array() ; 
  	foreach ($docs as $doc){
  		if ($doc->getUserId() == $uid ){
  			$goodDocs [] = $doc;
  			continue;  
  		}else {
  			$c = new Criteria();
  			$c ->add(SharedPeer::DOC_ID,$doc->getId(),Criteria::EQUAL);
  			$c->add(SharedPeer::USER_ID,$uid,Criteria::EQUAL);
  			$shared = SharedPeer::doSelectOne($c);
  			if ($shared != NULL)
  				$goodDocs[] = $doc;
  		}
  	}
  	return $goodDocs;	
  }
  
}
