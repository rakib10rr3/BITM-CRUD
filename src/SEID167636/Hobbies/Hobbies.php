<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 5/29/2017
 * Time: 11:40 PM
 */

namespace App\Hobbies;


use App\Model\Database;
use App\Message\Message;
use PDO;

class Hobbies extends Database
{
    public $id;
    public $name;
    public $hobbies;

    public function setData($postArray)
    {
        if (array_key_exists("id", $postArray))
            $this->id = $postArray["id"];
        if (array_key_exists("name", $postArray))
            $this->name = $postArray["name"];
        if (array_key_exists("hobbies", $postArray))
            $this->hobbies = $postArray["hobbies"];
    }

    public function store()
    {
        $name = $this->name;
        $hobbies = implode(", ", $this->hobbies);  //converting hobbies array to string
        $dataArray = array($name, $hobbies);
        $sqlQuery = "INSERT INTO hobbies_table (name,hobbies) VALUES (?,?)";
        $result = $this->DBH->prepare($sqlQuery)->execute($dataArray);
        if($result)
            Message::message("Success! Data has been inserted Successfully!");
        else
            Message::message("Alert! Data has not been inserted.");
    }

    public function index()
    {
        $sqlQuery = "SELECT * FROM hobbies_table WHERE is_trashed = 'no';";
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData = $STH->fetchAll();
        return $allData;
    }

    public function view()
    {
        $sqlQuery = "SELECT * FROM hobbies_table WHERE id = " . $this->id;
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $singleData = $STH->fetch();
        return $singleData;

    }

    public function update()
    {
        $hobbies = implode(", ", $this->hobbies);  //converting hobbies array to string
        $sqlQuery = "UPDATE hobbies_table SET name = ?, hobbies = ? WHERE id = $this->id;";
        $dataArray = array($this->name, $hobbies);
        $STH = $this->DBH->prepare($sqlQuery);
        $result = $STH->execute($dataArray);
        if($result)
            Message::message("Success! Data has been updated Successfully!");
        else
            Message::message("Alert! Data has not been updated.");

    }

    public function trash()
    {
        $sqlQuery = "UPDATE hobbies_table SET is_trashed = Now() WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if($result)
            Message::message("Success! Data has been trashed Successfully!");
        else
            Message::message("Alert! Data has not been trashed.");
    }

    public function trashed()
    {
        $sqlQuery = "SELECT * FROM hobbies_table WHERE is_trashed != 'no';";
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData = $STH->fetchAll();
        return $allData;

    }

    public function recover()
    {
        $sqlQuery = "UPDATE hobbies_table SET is_trashed = 'no' WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if($result)
            Message::message("Success! Data has been recovered Successfully!");
        else
            Message::message("Alert! Data has not been recovered.");
    }

    public function delete()
    {
        $sqlQuery = "DELETE FROM hobbies_table  WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if($result)
            Message::message("Success! Data has been deleted Successfully!");
        else
            Message::message("Alert! Data has not been deleted.");
    }

    public function search($requestArray){
        $sql = "";
        if( isset($requestArray['byName']) && isset($requestArray['byHobbies']) )  $sql = "SELECT * FROM `hobbies_table` WHERE `is_trashed` ='No' AND (`name` LIKE '%".$requestArray['search']."%' OR `hobbies` LIKE '%".$requestArray['search']."%')";
        if(isset($requestArray['byName']) && !isset($requestArray['byHobbies']) ) $sql = "SELECT * FROM `hobbies_table` WHERE `is_trashed` ='No' AND `name` LIKE '%".$requestArray['search']."%'";
        if(!isset($requestArray['byName']) && isset($requestArray['byHobbies']) )  $sql = "SELECT * FROM `hobbies_table` WHERE `is_trashed` ='No' AND `hobbies` LIKE '%".$requestArray['search']."%'";
        $STH  = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $someData = $STH->fetchAll();
        return $someData;
    }

    public function getAllKeywords()
    {
        $_allKeywords = array();
        $WordsArr = array();

        $allData = $this->index();

        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->name);
        }


        foreach ($allData as $oneData) {

            $eachString= strip_tags($oneData->name);
            $eachString=trim( $eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);

            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord){
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end

        // for each search field block start
        $allData = $this->index();

        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->hobbies);
        }
        $allData = $this->index();

        foreach ($allData as $oneData) {

            $eachString= strip_tags($oneData->hobbies);
            $eachString=trim( $eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);
            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord){
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end
        return array_unique($_allKeywords);
    }

    public function indexPaginator($page = 1, $itemsPerPage = 3)
    {
        $start = (($page - 1) * $itemsPerPage);
        if ($start < 0) $start = 0;
        $sql = "SELECT * from hobbies_table WHERE is_trashed = 'No' LIMIT $start,$itemsPerPage";
        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $arrSomeData = $STH->fetchAll();
        return $arrSomeData;
    }
}