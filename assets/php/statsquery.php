<?php
    require 'assets/php/config.php';
    global $conn;
    $formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);

    function getNewContactsCount($startDay = 0, $finishDay = 0){
        global $conn;
        $query = "SELECT COUNT(DATE_FORMAT(cdate, '%m/%d/%Y'))
        FROM contacts";
        if ($startDay === 0 && $finishDay === 0){
            //$count = $conn->prepare($query);
        } elseif ($startDay > 0 && $finishDay === 0) {
            $query .= " WHERE cdate BETWEEN CURDATE() - INTERVAL ". $startDay ." DAY AND CURDATE();";
            //$count = $conn->prepare($query);
            //$count->bind_param('i', $startDate);
        } elseif ($startDay > 0 && $finishDay > 0) {
            $query .= " WHERE cdate BETWEEN CURDATE() - INTERVAL ". $startDay ." DAY AND CURDATE() - ". $finishDay .";";
        }
        $count = $conn->prepare($query);
        $count->execute();
        $result = $count->get_result();
        return $result->fetch_array()[0];
    }
    
    function getNewCalledCount($startDay = 0, $finishDay = 0){
        global $conn;
        $query = "SELECT COUNT(DATE_FORMAT(cdate, '%m/%d/%Y'))
        FROM contacts
        WHERE called = true";
        if ($startDay === 0 && $finishDay === 0){
            //$count = $conn->prepare($query);
        } elseif ($startDay > 0 && $finishDay === 0) {
            $query .= " AND cdate BETWEEN CURDATE() - INTERVAL ". $startDay ." DAY AND CURDATE();";
            //$count = $conn->prepare($query);
            //$count->bind_param('i', $startDate);
        } elseif ($startDay > 0 && $finishDay > 0) {
            $query .= " AND cdate BETWEEN CURDATE() - INTERVAL ". $startDay ." DAY AND CURDATE() - ". $finishDay .";";
        }
        $count = $conn->prepare($query);
        $count->execute();
        $result = $count->get_result();
        return $result->fetch_array()[0];
    }

    function getNewPassedCount($startDay = 0, $finishDay = 0){
        global $conn;
        $query = "SELECT COUNT(DATE_FORMAT(cdate, '%m/%d/%Y'))
        FROM contacts
        WHERE passed = true";
        if ($startDay === 0 && $finishDay === 0){
            //$count = $conn->prepare($query);
        } elseif ($startDay > 0 && $finishDay === 0) {
            $query .= " AND cdate BETWEEN CURDATE() - INTERVAL ". $startDay ." DAY AND CURDATE();";
            //$count = $conn->prepare($query);
            //$count->bind_param('i', $startDate);
        } elseif ($startDay > 0 && $finishDay > 0) {
            $query .= " AND cdate BETWEEN CURDATE() - INTERVAL ". $startDay ." DAY AND CURDATE() - ". $finishDay .";";
        }
        $count = $conn->prepare($query);
        $count->execute();
        $result = $count->get_result();
        return $result->fetch_array()[0];
    }


    function getGenderCount($gender){
        global $conn;
        if($gender === 'm'){
            $gender = 1;
        }elseif($gender === 'f'){
            $gender = 2;
        }elseif($gender = 'u'){
            $gender = 3;
        }
        $query = 'SELECT COUNT(*) FROM `contacts` WHERE gender = ?;';
        $count = $conn->prepare($query);
        $count->bind_param('i', $gender);
        $count->execute();
        $result = $count->get_result();
        return $result->fetch_array()[0];
    }

    //Ad Groups
    //Query to get counts per ad group and order by highest count
    function getAdsCount($num){
        global $conn;

        $query = 'SELECT 
            adgroup.agname as adgroup, 
            COUNT(*) as c 
            FROM contacts 
            JOIN adgroup 
            ON contacts.adgroup=adgroup.agid 
            GROUP BY adgroup 
            ORDER BY c DESC
            LIMIT ?;';
        $list = $conn->prepare($query);
        $list->bind_param('i', $num);
        $list->execute();
        return $list->get_result();
    }

    function getCountriesCount($num){
        global $conn;

        $query = 'SELECT 
            apps_countries.country_name AS country, 
            COUNT(*) as c 
            FROM contacts 
            JOIN apps_countries
            ON contacts.country=apps_countries.id
            GROUP BY country 
            ORDER BY c DESC
            LIMIT ?;';

        $list = $conn->prepare($query);
        $list->bind_param('i', $num);
        $list->execute();
        return $list->get_result();
    }
    function getNationalitiesCount($num){
        global $conn;

        $query = 'SELECT 
            apps_countries.country_name AS nationality, 
            COUNT(*) as c 
            FROM contacts 
            JOIN apps_countries
            ON contacts.nationality=apps_countries.id
            GROUP BY nationality
            ORDER BY c DESC
            LIMIT ?;';

        $list = $conn->prepare($query);
        $list->bind_param('i', $num);
        $list->execute();
        return $list->get_result();
    }
    
?>


