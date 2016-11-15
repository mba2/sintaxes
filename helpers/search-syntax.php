<?php
//@param $selectedLangs --> an array containing all selected langs in a  HTML <form>//
function getLangs($selectedLangs){
  //CREATE A FILTER THAT WILL BE USED IN A SELECT SQL STATEMENT//
  $sqlFilter = new FilterSQL();

  foreach($selectedLangs as $language){
    $sqlFilter->addCondition(new ConditionSQL("syntax.languageID","=","{$language}","OR"));
  }
  return $sqlFilter;
  // return $sqlFilter->finishFilter();
}

//THIS FUNCTION WILL LOAD ALL NEEDED CLASSES AUTOMATICALLY//
function __autoload($class){
  require_once("../classes/{$class}.php");
}

//IF A $_POST VARIABLE OF 'lastQuery' IS SET... THIS FILE IS BEING CALLED FROM THE 'remove-syntax.php'//
//SO, JUST PERFORM THE QUERY INSIDE THE VARIABLE $_SESSION['lastQuery'] AND CLOSE THE PROGRAM//
session_start();
if(isset($_POST['lastQuery'])){
  //STORE THE LAST QUERY AS THE SQL STATEMENT TO BE EXECUTED//
  $selectSQL = $_SESSION['lastQuery'];
}else{
  //THIS PART MUST BE CALLED FROM 'search-syntax.php'//
    //GET THE POST VARIABLES//
    $chosenLangs = isset($_POST['lang'])   ? $_POST['lang']   : null;
    $givenString = isset($_POST['string']) ? $_POST['string'] : null;

    //IF NO LANGUAGE IS SELECTED...ECHO A JSON 'LOG' AND CLOSE THE PROGRAM//
    if(empty($chosenLangs)){
      echo json_encode(array("status"=>"no language selected","msg"=>"Por favor, selecione ao menos uma linguagem"));
      return false;
    }
    //IF NO TEXT IS PASSED TO PERFORM A SEARCH... ECHO A JSON 'LOG' AND CLOSE THE PROGRAM//
    if(empty($givenString)){
      echo json_encode(array("status"=>"no string passed","msg"=>"Por favor, digite algum texto."));
      return false;
    }
    //SET THE CURRENT DATABASE//
    // $currDB = "syntaxes";        //LOCAL//
    $currDB = "`u845380189_sint`";    //REMOTE//
    //SET THE CURRENT MAIN TABLE//
    $currTB = "`syntax`";
    //CREATE A FILTER -> AN ARRAY CONTAINING AN CONDITION EACH LANGUAGE THAT WILL BE USED IN THE SELECT QUERY --> getLangs()//
    $sqlFilter  = getLangs($chosenLangs);
    //CREATE A WHERE CONDITION TO SEARCH FOR A PATTERN TO THE GIVEN STRING//
      //SEARCH FOR THE GIVEN STRING IN THE DESCRIPTION FIELD OF A SYNTAX//
        $condition01 = new ConditionSQL("{$currTB}.syntaxDesc","LIKE","'%{$givenString}%'");
      //SEARCH FOR THE GIVEN STRING IN THE BODY FIELD OF A SYNTAX//
        $condition02 = new ConditionSQL("{$currTB}.syntaxBody","LIKE","'%{$givenString}%'","OR");
    //CREATE ANOTHER FILTER//
    $sqlFilter2 = new FilterSQL();
    $sqlFilter2->addCondition($condition01)->addCondition($condition02)->setBoolOp("AND");
    // print_r($sqlFilter2);
    //CREATE A SELECT STATEMENT CLASS//
    $selectSQL = (new SelectSQL("{$currDB}.{$currTB}","language.languageDesc,{$currTB}.syntaxID,{$currTB}.syntaxBody,{$currTB}.syntaxDesc,{$currTB}.syntaxNotes"));
    // $selectSQL->join("INNER","syntaxes.language","languageID")->where($sqlFilter)->convertToStr();
    $selectSQL->join("INNER","{$currDB}.language","languageID")->where($sqlFilter)->where($sqlFilter2)->convertToStr();
    //SAVE THE QUERY IN A $_SESSION VARIABLE//
    $_SESSION['lastQuery'] = $selectSQL;
}//THIS PART MUST BE CALLED FROM 'search-syntax.php'//

///CONNECT TO THE DATABASE//
$conn = DB::connect();

// echo $selectSQL;
// exit();
//PERFORM A QUERY//
$query = $conn->query($selectSQL);
//STORE THE RESULT OF AFFECTED ROWS//
$affectedRows = $query->rowCount();
//STORE THE RESULT IN AN ARRAY ($result)//
$result = $query->fetchAll(PDO::FETCH_ASSOC);
//IF NOTHING IS RETURNED... ECHO A JSON 'LOG' AND CLOSE THE PROGRAM//
if(empty($result)){
  echo json_encode(array("status"=>"no results found","msg"=>"Nenhum resultado encontrado."));
  return false;
}
//ECHO THE QUERY RESULT//
echo json_encode($result);

// print_r($result);
// print_r($query);
// print_r($selectSQL);
// print_r($sqlFilter->finishFilter());
 ?>
