<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 5/29/2017
 * Time: 11:54 AM
 */

namespace App\BookTitle;

use App\Utility\Utility;
use App\Model\Database;
use App\Message\Message;
use PDO;

class BookTitle extends Database
{
    public $id;
    public $bookTitle;
    public $authorName;

    public function setData($postArray)
    {
        if (array_key_exists("id", $postArray))
            $this->id = $postArray["id"];
        if (array_key_exists("bookTitle", $postArray))
            $this->bookTitle = $postArray["bookTitle"];
        if (array_key_exists("authorName", $postArray))
            $this->authorName = $postArray["authorName"];
    }

    public function store()
    {
        $bookTitle = $this->bookTitle;
        $authorName = $this->authorName;
        $sqlQuery = "INSERT INTO book_title (book_title,author_name) VALUES (?,?)";
        $dataArray = array($bookTitle, $authorName);
        $STH = $this->DBH->prepare($sqlQuery);
        $result = $STH->execute($dataArray);
        if ($result)
            Message::message("Success! Data has been inserted Successfully!");
        else
            Message::message("Alert! Data has not been inserted.");
    }

    public function index()
    {
        $sqlQuery = "SELECT * FROM book_title WHERE is_trashed = 'no';";
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData = $STH->fetchAll();
        return $allData;
    }

    public function view()
    {
        $sqlQuery = "SELECT * FROM book_title WHERE id = " . $this->id;
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $singleData = $STH->fetch();
        return $singleData;

    }

    public function update()
    {
        $sqlQuery = "UPDATE book_title SET book_title = ?, author_name = ? WHERE id = $this->id;";
        $dataArray = array($this->bookTitle, $this->authorName);
        $STH = $this->DBH->prepare($sqlQuery);
        $result = $STH->execute($dataArray);
        if ($result)
            Message::message("Success! Data has been updated Successfully!");
        else
            Message::message("Alert! Data has not been updated.");
    }

    public function trash()
    {
        $sqlQuery = "UPDATE book_title SET is_trashed = Now() WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if ($result)
            Message::message("Success! Data has been trashed Successfully!");
        else
            Message::message("Alert! Data has not been trashed.");
    }

    public function trashed()
    {
        $sqlQuery = "SELECT * FROM book_title WHERE is_trashed != 'no';";
        $STH = $this->DBH->query($sqlQuery);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData = $STH->fetchAll();
        return $allData;

    }

    public function recover()
    {
        $sqlQuery = "UPDATE book_title SET is_trashed = 'no' WHERE id = $this->id;";
        $this->DBH->exec($sqlQuery);
    }

    public function delete()
    {
        $sqlQuery = "DELETE FROM book_title  WHERE id = $this->id;";
        $result = $this->DBH->exec($sqlQuery);
        if ($result)
            Message::message("Success! Data has been deleted Successfully!");
        else
            Message::message("Alert! Data has not been deleted.");
    }

    public function search($requestArray)
    {
        $sql = "";
        if (isset($requestArray['byTitle']) && isset($requestArray['byAuthor'])) $sql = "SELECT * FROM `book_title` WHERE `is_trashed` ='No' AND (`book_title` LIKE '%" . $requestArray['search'] . "%' OR `author_name` LIKE '%" . $requestArray['search'] . "%')";
        if (isset($requestArray['byTitle']) && !isset($requestArray['byAuthor'])) $sql = "SELECT * FROM `book_title` WHERE `is_trashed` ='No' AND `book_title` LIKE '%" . $requestArray['search'] . "%'";
        if (!isset($requestArray['byTitle']) && isset($requestArray['byAuthor'])) $sql = "SELECT * FROM `book_title` WHERE `is_trashed` ='No' AND `author_name` LIKE '%" . $requestArray['search'] . "%'";
        $STH = $this->DBH->query($sql);
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
            $_allKeywords[] = trim($oneData->book_title);
        }


        foreach ($allData as $oneData) {

            $eachString = strip_tags($oneData->book_title);
            $eachString = trim($eachString);
            $eachString = preg_replace("/\r|\n/", " ", $eachString);
            $eachString = str_replace("&nbsp;", "", $eachString);

            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord) {
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end

        // for each search field block start
        $allData = $this->index();

        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->author_name);
        }
        $allData = $this->index();

        foreach ($allData as $oneData) {

            $eachString = strip_tags($oneData->author_name);
            $eachString = trim($eachString);
            $eachString = preg_replace("/\r|\n/", " ", $eachString);
            $eachString = str_replace("&nbsp;", "", $eachString);
            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord) {
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
        $sql = "SELECT * from book_title  WHERE is_trashed = 'No' LIMIT $start,$itemsPerPage";
        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $arrSomeData = $STH->fetchAll();
        return $arrSomeData;
    }
}