<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 5/29/2017
 * Time: 12:07 PM
 */

namespace App\Model;

use PDO, PDOException;

class Database
{
    public $DBH;

    public function __construct()
    {
        try {
            $this->DBH = new PDO("mysql:host=localhost;dbname=rakib_167636_b59_atomic_project", "root", "");

        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }
}

