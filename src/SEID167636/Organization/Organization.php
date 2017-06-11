<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 5/30/2017
 * Time: 12:59 AM
 */

namespace App\Organization;


use App\Model\Database;
use App\Message\Message;
use PDO;

class Organization extends Database
{
    public $id;
    public $name;
    public $organizationName;
    public $organizationSummary;

    public function setData($postArray)
    {
        if (array_key_exists("id", $postArray))
            $this->id = $postArray["id"];
        if (array_key_exists("name", $postArray))
            $this->name = $postArray["name"];
        if (array_key_exists("organizationName", $postArray))
            $this->organizationName = $postArray["organizationName"];
        if (array_key_exists("organizationSummary", $postArray))
            $this->organizationSummary = $postArray["organizationSummary"];
    }

    public function store()
    {
        $dataArray = array($this->name, $this->organizationName, $this->organizationSummary);
        $sqlQuery = "INSERT INTO organization_table (name,organization_name,organization_summary) VALUES (?,?,?)";
        $result = $this->DBH->prepare($sqlQuery)->execute($dataArray);
        if($result)
            Message::message("Success! Data has been inserted Successfully!");
        else
            Message::message("Alert! Data has not been inserted.");
    }

    public function index()
    {
        $sqlQuery = "SELECT * FROM organization_table WHERE is_trashed = 'no';";
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData = $STH->fetchAll();
        return $allData;
    }

    public function view()
    {
        $sqlQuery = "SELECT * FROM organization_table WHERE id = " . $this->id;
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $singleData = $STH->fetch();
        return $singleData;

    }

    public function update()
    {
        $sqlQuery = "UPDATE organization_table SET name = ?, organization_name = ?, organization_summary = ? WHERE id = $this->id;";
        $dataArray = array($this->name, $this->organizationName, $this->organizationSummary);
        $STH = $this->DBH->prepare($sqlQuery);
        $result = $STH->execute($dataArray);
        if($result)
            Message::message("Success! Data has been updated Successfully!");
        else
            Message::message("Alert! Data has not been updated.");
    }

    public function trash()
    {
        $sqlQuery = "UPDATE organization_table SET is_trashed = Now() WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if($result)
            Message::message("Success! Data has been trashed Successfully!");
        else
            Message::message("Alert! Data has not been trashed.");
    }

    public function trashed()
    {
        $sqlQuery = "SELECT * FROM organization_table WHERE is_trashed != 'no';";
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData = $STH->fetchAll();
        return $allData;

    }

    public function recover()
    {
        $sqlQuery = "UPDATE organization_table SET is_trashed = 'no' WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if($result)
            Message::message("Success! Data has been recovered Successfully!");
        else
            Message::message("Alert! Data has not been recovered.");
    }

    public function delete()
    {
        $sqlQuery = "DELETE FROM organization_table  WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if($result)
            Message::message("Success! Data has been deleted Successfully!");
        else
            Message::message("Alert! Data has not been deleted.");
    }

    public function search($requestArray){
        $sql = "";
        if( isset($requestArray['byName']) && isset($requestArray['byOrganization']) )  $sql = "SELECT * FROM `organization_table` WHERE `is_trashed` ='No' AND (`name` LIKE '%".$requestArray['search']."%' OR `organization_name` LIKE '%".$requestArray['search']."%')";
        if(isset($requestArray['byName']) && !isset($requestArray['byOrganization']) ) $sql = "SELECT * FROM `organization_table` WHERE `is_trashed` ='No' AND `name` LIKE '%".$requestArray['search']."%'";
        if(!isset($requestArray['byName']) && isset($requestArray['byOrganization']) )  $sql = "SELECT * FROM `organization_table` WHERE `is_trashed` ='No' AND `organization_name` LIKE '%".$requestArray['search']."%'";
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
            $_allKeywords[] = trim($oneData->organization_name);
        }
        $allData = $this->index();

        foreach ($allData as $oneData) {

            $eachString= strip_tags($oneData->organization_name);
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
        $sql = "SELECT * from organization_table WHERE is_trashed = 'No' LIMIT $start,$itemsPerPage";
        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $arrSomeData = $STH->fetchAll();
        return $arrSomeData;
    }

}