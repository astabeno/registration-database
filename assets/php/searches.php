<?php

//class to create multitude of SQL select statements for contactlist.php
class ContactsTable
{
    function selectContacts($listType)
    {
        //beginning of Select statement that is shared between all searches
        $sqlSelect = 'SELECT 
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
        ON contacts.user=users.id';
        require 'assets/php/config.php';

        //all contacts for current logged in user
        if ($listType == 'user') {
            $list = $conn->prepare($sqlSelect . ' WHERE user = ? ORDER BY cid DESC');
            $list->bind_param('i', $_SESSION['id']);
            $list->execute();
            return $list->get_result();
        }
        //if all contacts is requested
        if ($listType == 'all') {
            $list = $conn->prepare($sqlSelect . ' ORDER BY cid DESC;');
            $list->execute();
            return $list->get_result();
        }
        //contacts who have been passed off
        if ($listType == 'passed') {
            $list = $conn->prepare($sqlSelect . ' WHERE passed = 1 ORDER BY cid DESC');
            $list->execute();
            return $list->get_result();
        }
        //contacts who have been called
        if ($listType == 'called') {
            $list = $conn->prepare($sqlSelect . ' WHERE called = 1 ORDER BY cid DESC');
            $list->execute();
            return $list->get_result();
        }
        //search for  name of a contact
        if (isset($listType)) {
            $list = $conn->prepare($sqlSelect . ' WHERE name = ? ORDER BY cid DESC');
            $list->bind_param('s', $listType);
            $list->execute();
            return $list->get_result();
        }
    }
}