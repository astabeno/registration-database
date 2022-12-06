<?php
// Initialize the session
require 'assets/php/session.php';

//stats from database
require 'assets/php/statsquery.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contacts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="assets/css/contactlist.css" rel="stylesheet">
</head>

<body>
    <header>
      <?php include_once 'assets/php/navbar.php' ?>
    </header>
    <div class="container px-5">
        <div class="table-responsive user-list px-5 mx-5 px-5">
            <h1 class="text-center">Adgroup Counts</h1>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Ad Group Name</th>
                        <th># of Contacts from Ad Group</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $countryList = getCountriesCount(50);
                        foreach($countryList as $row){
                            echo'
                                <tr>
                                    <td>'.$row['country'].'</td>
                                    <td>'.$row['c'].'</td>
                                </tr>';
                        };
                    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>

</body>
</html>