<?php
require 'assets/php/config.php';
//class to create multitude of SQL select statements for contactlist.php
class ContactsTable
{
    private function buildSql($status=NULL, $userid=NULL, $week=NULL, $search=NULL) {
        $sqlSelect = 
            "SELECT 
                cid, name, wanumber, cdate, ctime,
                location.country_name as country,
                nation.country_name as nationality,
                adgroup.agname AS adname,
                gender.gname AS gender,
                cbb, called, passed,
                attitudes.level AS attitude,
                notes, users.username AS responder
            FROM contacts
            LEFT JOIN
                apps_countries as location
                ON contacts.country=location.id
            LEFT JOIN
                apps_countries as nation
                ON contacts.nationality=nation.id
            JOIN
                adgroup
                ON contacts.adgroup = adgroup.agid
            JOIN
                gender
                ON contacts.gender=gender.gid
            JOIN
                attitudes
                ON contacts.attitude=attitudes.id
            LEFT JOIN
                users
                ON contacts.user=users.id
            WHERE ";


        $responderFilter = 'user = '.$userid.' ';
        $all = "1=1";
        $weekFilter = 'yearweek(cdate)=yearweek(now())-'.$week;
        $statusFilter = $status.'=1 ';
        $searchName = 'LOCATE("'.$search.'", name) ';
        $searchNumber = 'LOCATE("'.$search.'", wanumber) ';
        $order = ' ORDER BY cdate DESC;';

        $numSet = 0;

        //all
        if(!isset($status) && !isset($userid) && !isset($week) && !isset($search)) {
            return $sqlSelect . $all;
        }
        //status
        if(isset($status)) {
            $sqlSelect .= $statusFilter;
            $numSet ++;
        }//responder
        if(isset($userid)) {
            ($numSet > 0) ? $sqlSelect .= '&& ' . $responderFilter : $sqlSelect .= $responderFilter;
            $numSet ++;
        }
        //week
        if(isset($week)) {
            ($numSet > 0) ? $sqlSelect .= '&& ' . $weekFilter : $sqlSelect .= $weekFilter;
            $numSet ++;
        }
        //search
        if(isset($search)) {
            if(!intval($search) > 0){
                ($numSet > 0) ? $sqlSelect .= '&& ' . $searchName : $sqlSelect .= $searchName;
                //$sqlSelect .= $searchName;
            }
            if(intval($search) > 0){
                ($numSet > 0) ? $sqlSelect .= '&& ' . $searchNumber : $sqlSelect .= $searchNumber;
            }
            $numSet ++;
        }
        return $sqlSelect . $order;
    }

    public function selectContacts($status = NULL, $userId = NULL, $weeksAgo = NULL, $search = NULL)
    {
        

        global $conn;

        $list = $conn->prepare( $this->buildSql($status, $userId, $weeksAgo, $search));
        $list->execute();
        return $list->get_result();
    }
}

class ContactTotals //for stats
{
    private function buildSql($status = NULL, 
                      $responder = NULL,
                      $gender = NULL,
                      $timeUnit = NULL, 
                      $numUnits = 0){
        $sql = 'SELECT COUNT(*)
                    FROM contacts 
                    WHERE ';
        $statusFilter = $status. ' = true ';
        $responderFilter = 'user = '.$responder.' ';
        $genderFilter = 'gender = '.$gender. ' ';
        ($timeUnit == 'week') ? $timeUnit = 'yearweek' : $timeUnit=$timeUnit;
        $timeFilter = $timeUnit.'(cdate)='.$timeUnit.'(now())-'.$numUnits.' ';
        
        $numSet = 0;

        if (!isset($status) && !isset($responder) && !isset($gender) && !isset($timeUnit)){
            return $sql . '1=1';
        }
        if(isset($status)) {
            $sql .= $statusFilter;
            $numSet ++;
        }
        if(isset($responder)){
            ($numSet > 0) ? $sql .= '&& ' . $responderFilter : $sql .= $responderFilter;
            $numSet ++;
        }
        if(isset($gender)){
            ($numSet > 0) ? $sql .= '&& ' . $genderFilter : $sql .= $genderFilter;
            $numSet ++;
        }
        if(isset($timeUnit)){
            ($numSet > 0) ? $sql .= '&& ' . $timeFilter : $sql .= $timeFilter;
            $numSet ++;
        }

        return $sql;
    }

    public function getContactCount($status = NULL, $responder = NULL, $gender= NULL, $timeUnit = NULL, $numUnits = 0) {

        global $conn;

        $query = $conn->prepare($this->buildSql($status, $responder, $gender, $timeUnit, $numUnits));
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_array()[0];
    }
}
class GroupTotals
{
    private function buildSql($group, $limit = NULL){
        if($group == 'adgroup'){
            return 'SELECT 
                        adgroup.agname as adgroup, 
                        COUNT(*) as total 
                    FROM contacts 
                    JOIN adgroup 
                    ON contacts.adgroup=adgroup.agid 
                    GROUP BY adgroup 
                    ORDER BY total DESC
                    LIMIT '.$limit;
        }
        if($group == 'nationality'){
            return 'SELECT 
                        apps_countries.country_name AS nationality, 
                        COUNT(*) as total 
                    FROM contacts 
                    JOIN apps_countries
                    ON contacts.nationality=apps_countries.id
                    GROUP BY nationality
                    ORDER BY total DESC
                    LIMIT '.$limit;
        }
        if($group == 'country'){
            return 'SELECT 
                        apps_countries.country_name AS country, 
                        COUNT(*) as total 
                    FROM contacts 
                    JOIN apps_countries
                    ON contacts.country=apps_countries.id
                    GROUP BY country 
                    ORDER BY total DESC
                    LIMIT '.$limit;
        }
    }
    public function getGroupList($group, $limit = NULL){

        global $conn;

        $list = $conn->prepare( $this->buildSql($group, $limit));
        $list->execute();
        return $list->get_result();
    }
}