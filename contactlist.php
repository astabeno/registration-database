<?php
// Initialize the session

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header("location: login.php");
    exit;
}
if (isset($_REQUEST['list'])){
  $searchType = $_REQUEST['list'];
} elseif (isset($_REQUEST['search'])) {
  $searchType = $_REQUEST['search'];
}else {
  $searchType = 'all';
}

require 'assets/php/searches.php';

$table = new ContactsTable();

$result = $table->selectContacts($searchType);
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
    <div class="container">
        <div class="table-responsive user-list">
            <h1 class="text-center"><?php echo ( intval($searchType) > 0 ) ? "number search" : "name search" ?></h1>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <div class="container-fluid">
                <a class="navbar-brand" href="contactlist.php?list=all">All Contacts</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="contactlist.php?list=user">
                        <?php echo $_SESSION['username']."'s contacts"?>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="contactlist.php?list=called">Called</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="contactlist.php?list=passed">Passed</a>
                    </li>
                  </ul>
                  <form class="d-flex" action="contactlist.php">
                    <input class="form-control me-2" type="text" placeholder="Name or Phone" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                </div>
              </div>
            </nav>
            <!-- <div class="form-group m-4">
                <form class="d-flex justify-content-center" action="" method="get">
                  <div class="btn-group">
                    <button class="btn btn-primary" type="submit" name="search" value="all">All Contacts</button>
                    <button class="btn btn-primary" type="submit" name="search" value="user"></button>
                    <button class="btn btn-primary" type="submit" name="search" value="passed">passed contacts</button>
                    <button class="btn btn-primary" type="submit" name="search" value="called">called contacts</button>
                  </div>
                </form>
            </div> -->
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th></th>
                        <th class="d-none d-md-table-cell">Gender</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Number</th>
                        <th class="d-none d-md-table-cell">Ad Group</th>
                        <th>Status</th>
                        <th class="d-none d-lg-table-cell">Responder</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       if ($result->num_rows < 1) {
                        echo "<p>No Data from database</p>";
                       }

                       foreach ($result as $row) {
                        echo "
                        <tr>
                            <td><button type=\"button\" class=\"btn btn-sm\" data-bs-toggle=\"modal\"
                            data-bs-target=\"#m".$row['cid']."\">
                            <i class=\"bi bi-eye mx-2\"></i>
                        </button></td>";

                            if ($row['gender'] == "male" ) {
                                echo "<td class=\"d-none d-md-table-cell\"><img src=\"assets/images/arabman.png\"></td>";
                            } elseif ($row['gender'] == "female" ) {
                                echo "<td class=\"d-none d-md-table-cell\"><img src=\"assets/images/arabwoman.png\"></td>";
                            } else {
                                echo "<td class=\"d-none d-md-table-cell\"><img src=\"assets/images/unknown.png\"></i></td>";
                            }

                            echo "<td>
                                <h5 class=\"fs-6\">".$row['name']."</h5>
                            </td>
                            <td>".$row['cdate']."</td>
                            <td>".$row['wanumber']."</td>
                            <td class=\"d-none d-md-table-cell\">".$row['adname']."</td>
                            <td>";
                            if ($row["called"] == 1 ) {
                                echo "<i class=\"bi bi-telephone-fill mx-2\"></i>";
                            }
                            if ($row["passed"] == 1 ) {
                                echo "<i class=\"bi bi-person-check-fill mx-3\"></i>";
                            }
                            echo "
                            </td>
                            <td class=\"d-none d-lg-table-cell\">".$row['responder']."</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modal -->
<?php
foreach ($result as $row) {
//   echo "<p>".$row["name"]."</p>";
echo '
<div class="modal fade" id=m'.$row['cid'].' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">'.$row['name'].' - '.$row['cid'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-8 col-sm-6">
              <p><strong>WhatsApp Number</strong></p>
              <p><strong>Date</strong></p>
              <p><strong>Time</strong></p>
              <p><strong>Location</strong></p>
              <p><strong>Nationality</strong></p>
              <p><strong>Ad Group</strong></p>
              <p><strong>Gender</strong></p>
              <p><strong>Attitude</strong></p>
              <p><strong>Status</strong></p>
            </div>
            <div class="col-4 col-sm-6">
              <p>'.(isset($row['wanumber'])? $row['wanumber']: 'NA').'</p>
              <p>'.(isset($row['cdate'])? $row['cdate']: 'NA').'</p>
              <p>'.(isset($row['ctime'])? $row['ctime']: 'NA').'</p>
              <p>'.(isset($row['country'])? $row['country']: 'NA').'</p>
              <p>'.(isset($row['nationality'])? $row['nationality']: 'NA').'</p>
              <p>'.(isset($row['adname'])? $row['adname']: 'NA').'</p>
              <p>'.(isset($row['gender'])? $row['gender']: 'NA').'</p>
              <p>'.(isset($row['attitude'])? $row['attitude']: 'NA').'</p>
              <p>';
              if ($row['called'] == 1 ) {
                echo "Called  <i class=\"bi bi-telephone-fill mx-2\"></i>";
              } else {
                echo "Not Called";
              }
              echo " | ";
              if ($row['passed'] == 1 ){
                echo "Passed  <i class=\"bi bi-person-check-fill mx-3\"></i>";
              } else {
                echo "Not Passed";
              }
            
            echo  '</p>
            </div>
            <div>
              <blockquote class="blockquote border rounded p-3 m-2 mr-2 notes">
              '.(isset($row['notes'])? $row['notes']: 'NA').'
              </blockquote>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
        data-bs-dismiss="modal">Close</button>
        <form action="edit-contact.php">
          <input type="hidden" name="contactid" value="'.$row['cid'].'">
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>';
}
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>

    <!-- <script src="assets/js/view.js"></script> -->
</body>
</html>
