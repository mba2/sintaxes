<?php
function __autoload($class){
  require_once("../classes/{$class}.php");
}

if(empty($_POST)){
  echo json_encode(
        array("status" => "error",
              "msg" => "No data was passed by POST method"
             )
      );
}else{
  //GET THE POST VARIABLES//
  $syntaxID = $_POST['syntaxID'];
  //CONNECT TO THE DATABASE//
  $conn = DB::connect();
  //SET THE CURRENT DATABASE//
  // $currDB = "syntaxes";        //LOCAL//
  $currDB = "`u845380189_sint`";    //REMOTE//
  //SET THE CURRENT MAIN TABLE//
  $currTB = "`example`";
  //CREATE A DELETE SQL STATEMENT//
  $deleteExamples = new DeleteSQL("{$currDB}.{$currTB}");
  //CREATE A CONDITION//
  $cond   = new ConditionSQL("{$currTB}.syntaxID","=","{$syntaxID}");
  //CREATE A FILTER//
  $filter = new FilterSQL();
  $filter->addCondition($cond);
  //ADD THIS FILTER INTO THE DELETE STATEMENT//
  $deleteExamples = $deleteExamples->where($filter)->convertToStr();
  // echo "<pre>";
  // print_r($deleteExamples);
  //PERFORM THE QUERY//
  $query = $conn->query($deleteExamples);

  //CHANGE THE CURRENT TABLE//
  $currTB = "`syntax`";
  //CREATE A DELETE STATEMENT//
  $deleteSyntax = new DeleteSQL("{$currDB}.{$currTB}");
  //CREATE A CONDITION//
  $cond = new ConditionSQL("{$currTB}.syntaxID","=","{$syntaxID}");
  //CREATE A FILTER//
  $filter = new FilterSQL();
  $filter->addCondition($cond);
  //ADD THIS FILTER INTO THE DELETE STATEMENT//
  $deleteSyntax = $deleteSyntax->where($filter)->convertToStr();
  //PERFORM THE QUERY//
  $query = $conn->query($deleteSyntax);
  // print_r($deleteSyntax);
  // print_r($syntaxID);
}
 ?>
