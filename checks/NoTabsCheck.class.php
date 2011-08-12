<?php
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'BasePreCommitCheck.class.php';

class NoTabsCheck extends BasePreCommitCheck {
  
  public $extensionsToSkip = array(
    'jpg', 'jpeg', 'png', 'gif'
//    , 'zip', 'tar', 'gz', 'tgz'
//    , 'odt' // more OpenDoc formats...
//    , 'doc', 'docx', 'xls', 'xlsx', //more MS office formats...
//    , 'jar', 'dll', 'so', 'exe'
  );
  
  function getTitle(){
    return "Reject tabulation in files";
  }
  
  public function renderErrorSummary(){
    return count($this->codeError) . " tabs found";
  }
  
  public function checkFileLine($file, $pos, $line){
    if ( $this->hasOption('allow-tabs') ){
      return;
    }
    if ( in_array($this->getExtension($file), $this->extensionsToSkip) ){
      return;
    }
    if ( ($pos = strpos($line, "\t")) !== false ){
      return "Char $pos is a tab";
    }
  }
  
  public function renderInstructions(){
    return "If you want to force commit tabs, add the parameter --allow-tabs in your comment";
  }
  
}