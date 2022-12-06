<?php
  // Initialize the session
  require 'assets/php/session.php';

  //searches in database
  require 'assets/php/statsquery.php';
  $formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);

  //variables from statsquery.php
  $totalContacts = getNewContactsCount();
  $new30DayCount = getNewContactsCount(30);
  $new365DayCount = getNewContactsCount(365);
  $trend30Days = getNewContactsCount(60, 30);
  $totalCalls = getNewCalledCount();
  $calledPercent = $formatter->format( $totalCalls / $totalContacts);
  $new30DayCalls = getNewCalledCount(30);
  $new365DayCalls = getNewCalledCount(365);
  $totalPassed = getNewPassedCount();
  $passedPercent = $formatter->format( $totalPassed / $totalContacts);
  $new30DayPassed = getNewPassedCount(30);
  $new365DayPassed = getNewPassedCount(365);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Statistics</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="assets/css/stats.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="d-flex flex-column vh-100">
    <?php include_once 'assets/php/navbar.php'; ?>

    <div class="container mt-3">
    <div class="header-body">
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Contacts</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $totalContacts ?></span>
                      <h5 class="card-title text-uppercase text-muted mb-0">New Last 30 Days</h5>
                      <span class="h2 font-weight-bold mb-0">
                        <?php echo $new30DayCount ?>   <span class="text-sm <?php echo ($trend30Days >= 0) ? 'text-success' : 'text-danger' ?> mr-2">
                            <i class="fa <?php echo ($trend30Days >= 0) ? 'fa-arrow-up' : 'fa-arrow-down' ?>"></i>
                        <?php echo $trend30Days ?>%
                    </span></span>
                      <h5 class="card-title text-uppercase text-muted mb-0">Last 365 Days</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $new365DayCount ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Called</h5>
                      <span class="h2 font-weight-bold mb-0">
                          <?php echo $totalCalls ?>
                          <span class="text-info text-sm"><?php echo $calledPercent ?></span>
                      </span>
                      <h5 class="card-title text-uppercase text-muted mb-0">Last 30 Days</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $new30DayCalls ?></span>
                      <h5 class="card-title text-uppercase text-muted mb-0">Last 356 Days</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $new365DayCalls ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-phone"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Passed Off</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $totalPassed ?></span>
                      <span class="text-info text-sm"><?php echo $passedPercent ?></span>
                      <h5 class="card-title text-uppercase text-muted mb-0">Last 30 days</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $new30DayPassed ?></span>
                      <h5 class="card-title text-uppercase text-muted mb-0">Last 365 days</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $new365DayPassed ?></span>
                    </div>
                    <div class="col-auto">
                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-people-arrows"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Male</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo getGenderCount('m') ?></span>
                      <span class="text-info text-sm"><?php echo Round((getGenderCount('m') / $totalContacts) * 100, 2) ?>%</span>
                      <h5 class="card-title text-uppercase text-muted mb-0">FEMALE</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo getGenderCount('f') ?></span>
                      <span class="text-info text-sm"><?php echo Round((getGenderCount('f') / $totalContacts) * 100, 2) ?>%</span>
                      <h5 class="card-title text-uppercase text-muted mb-0">Unknown</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo getGenderCount('u') ?></span>
                      <span class="text-info text-sm"><?php echo Round((getGenderCount('u') / $totalContacts) * 100, 2) ?>%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-secondary text-white rounded-circle shadow">
                        <i class="fas fa-venus-mars"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="text-center mb-1"><a href ="adgroupstats.php">Ads</a> - <em>Top 5</em></div>
                      <div class="col">
                        <?php 
                          $adsList = getAdsCount(5);
                          foreach($adsList as $row){
                            echo'
                            <p class="h5 text-uppercase text-muted mb-2">'.$row['adgroup'] .'</p>';
                          }
                        ?>
                    </div>
                    <div class="col-auto">
                    <?php 
                        $adsList = getAdsCount(5);
                        foreach($adsList as $row){
                          echo'
                          <p class="h5 font-weight-bold mb-2">'.$row['c'].'</p>
                          ';
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="text-center mb-1"><a href ="countrystats.php">Countries</a> - <em>Top 5</em></div>
                      <div class="col">
                        <?php 
                          $countryList = getCountriesCount(5);
                          foreach($countryList as $row){
                            echo'
                            <p class="h5 text-uppercase text-muted mb-2">'.$row['country'] .'</p>';
                          }
                        ?>
                    </div>
                    <div class="col-auto">
                    <?php 
                        $countryList = getCountriesCount(5);
                        foreach($countryList as $row){
                          echo'
                          <p class="h5 font-weight-bold mb-2">'.$row['c'].'</p>
                          ';
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="text-center mb-1"><a href ="nationalitystats.php">Nationalities</a> - <em>Top 5</em></div>
                      <div class="col">
                        <?php 
                          $nationalityList = getNationalitiesCount(5);
                          foreach($nationalityList as $row){
                            echo'
                            <p class="h5 text-uppercase text-muted mb-2">'.$row['nationality'] .'</p>';
                          }
                        ?>
                    </div>
                    <div class="col-auto">
                    <?php 
                        $nationalityList = getNationalitiesCount(5);
                        foreach($nationalityList as $row){
                          echo'
                          <p class="h5 font-weight-bold mb-2">'.$row['c'].'</p>
                          ';
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>
    

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <!-- <script src="assets/js/view.js"></script> -->
</body>
</html>
