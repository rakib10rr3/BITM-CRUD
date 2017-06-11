<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 5/29/2017
 * Time: 3:22 PM
 */

namespace App\City;


use App\Model\Database;
use App\Message\Message;
use PDO;

class City extends Database
{
    public $id;
    public $name;
    public $cityName;

    public function setData($postArray)
    {
        if (array_key_exists("id", $postArray))
            $this->id = $postArray["id"];
        if (array_key_exists("name", $postArray))
            $this->name = $postArray["name"];
        if (array_key_exists("cityName", $postArray))
            $this->cityName = $postArray["cityName"];
    }

    public function store()
    {
        $dataArray = array($this->name, $this->cityName);
        $sqlQuery = "INSERT INTO city (name,city_name) VALUES (?,?)";
        $result = $this->DBH->prepare($sqlQuery)->execute($dataArray);
        if($result)
            Message::message("Success! Data has been inserted Successfully!");
        else
            Message::message("Alert! Data has not been inserted.");
    }

    public function view()
    {
        $sqlQuery = "SELECT * FROM city WHERE id = ".$this->id;
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $singleData = $STH->fetch();
        return $singleData;
    }

    public function index()
    {
        $sqlQuery = "SELECT * FROM city WHERE is_trashed = 'no';";
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData = $STH->fetchAll();
        return $allData;
    }

    public function update()
    {
        $sqlQuery = "UPDATE city SET name = ?, city_name = ? WHERE id = $this->id;";
        $dataArray = array($this->name, $this->cityName);
        $STH = $this->DBH->prepare($sqlQuery);
        $result = $STH->execute($dataArray);
        if($result)
            Message::message("Success! Data has been updated Successfully!");
        else
            Message::message("Alert! Data has not been updated.");
    }
    public function trash()
    {
        $sqlQuery = "UPDATE city SET is_trashed = Now() WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if($result)
            Message::message("Success! Data has been trashed Successfully!");
        else
            Message::message("Alert! Data has not been trashed.");
    }

    public function trashed()
    {
        $sqlQuery = "SELECT * FROM city WHERE is_trashed != 'no';";
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData = $STH->fetchAll();
        return $allData;

    }

    public function recover()
    {
        $sqlQuery = "UPDATE city SET is_trashed = 'no' WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if($result)
            Message::message("Success! Data has been recovered Successfully!");
        else
            Message::message("Alert! Data has not been recovered.");
    }

    public function delete()
    {
        $sqlQuery = "DELETE FROM city  WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if($result)
            Message::message("Success! Data has been deleted Successfully!");
        else
            Message::message("Alert! Data has not been deleted.");
    }

    public function search($requestArray){
        $sql = "";
        if( isset($requestArray['byName']) && isset($requestArray['byCity']) )  $sql = "SELECT * FROM `city` WHERE `is_trashed` ='No' AND (`name` LIKE '%".$requestArray['search']."%' OR `city_name` LIKE '%".$requestArray['search']."%')";
        if(isset($requestArray['byName']) && !isset($requestArray['byCity']) ) $sql = "SELECT * FROM `city` WHERE `is_trashed` ='No' AND `name` LIKE '%".$requestArray['search']."%'";
        if(!isset($requestArray['byName']) && isset($requestArray['byCity']) )  $sql = "SELECT * FROM `city` WHERE `is_trashed` ='No' AND `city_name` LIKE '%".$requestArray['search']."%'";
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
            $_allKeywords[] = trim($oneData->city_name);
        }
        $allData = $this->index();

        foreach ($allData as $oneData) {

            $eachString= strip_tags($oneData->city_name);
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
        $sql = "SELECT * from city WHERE is_trashed = 'No' LIMIT $start,$itemsPerPage";
        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $arrSomeData = $STH->fetchAll();
        return $arrSomeData;
    }
}