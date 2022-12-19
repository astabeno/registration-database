<?php
  // Initialize the session
  require 'assets/php/session.php';

  //searches in database
  //require 'assets/php/statsquery.php';
  require 'assets/php/searches.php';

  $formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);

  $totals = new ContactTotals();
  $groups = new GroupTotals();
  
  //getContactCount(Status, Responder, Gender, TimeUnit, NumUnits)
  //variables from statsquery.php
  $totalContacts = $totals->getContactCount();
  $totalCalls = $totals->getContactCount('called');
  $calledPercent = $formatter->format( $totalCalls / $totalContacts);
  $totalPassed = $totals->getContactCount('passed');
  $passedPercent = $formatter->format( $totalPassed / $totalContacts);
  //Year
  $totalLastYear = $totals->getContactCount(NULL, NULL, NULL, 'year', 1);
  $passedLastYear = $totals->getContactCount('passed', NULL, NULL, 'year', 1);
  $totalThisYear = $totals->getContactCount(NULL, NULL, NULL, 'year', 0);
  $passedThisYear = $totals->getContactCount('passed', NULL, NULL, 'year', 0);
  //Month
  $totalLastMonth = $totals->getContactCount(NULL, NULL, NULL, 'month', 1);
  $passedLastMonth = $totals->getContactCount('passed', NULL, NULL, 'month', 1);
  $totalThisMonth = $totals->getContactCount(NULL, NULL, NULL, 'month', 0);
  $passedThisMonth = $totals->getContactCount('passed', NULL, NULL, 'month', 0);
  //Gender
  $totalMale = $totals->getContactCount(NULL, NULL, 1);
  $totalFemale = $totals->getContactCount(NULL, NULL, 2);
  $totalGenderUnknown = $totals->getContactCount(NULL, NULL, 3);
  //Week
  $totalLastWeek = $totals->getContactCount(NULL, NULL, NULL, 'week', 1);
  $passedLastWeek = $totals->getContactCount('passed', NULL, NULL, 'week', 1);
  $totalThisWeek = $totals->getContactCount(NULL, NULL, NULL, 'week', 0);
  $passedThisWeek = $totals->getContactCount(NULL, NULL, NULL, 'week', 0);
  $totalRahmeh = $totals->getContactCount(NULL, NULL, 1);
  $passedRahmeh = $totals->getContactCount('passed', NULL, 1);
  $calledRahmeh = $totals->getContactCount('called', NULL, 1);
  $lastWeekRahmeh = $totals->getContactCount(NULL, NULL, 1, 'week', 1);
  $thisWeekRahmeh = $totals->getContactCount(NULL, NULL, 1, 'week', 0);
  $totalFarah = $totals->getContactCount(NULL, NULL, 2);
  $passedFarah = $totals->getContactCount('passed', NULL, 2);
  $calledFarah = $totals->getContactCount('called', NULL, 2);
  $lastWeekFarah = $totals->getContactCount(NULL, NULL, 2, 'week', 1);
  $thisWeekFarah = $totals->getContactCount(NULL, NULL, 2, 'week', 0);

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
                      <h4 class="card-title text-uppercase text-muted mb-0 mt-4">Total Contacts</h4>
                      <span class="h1 font-weight-bold mb-0"><?php echo $totalContacts; ?></span>
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
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">Status of Total</h5>
                      <span class="h2 font-weight-bold"><?php echo $totalCalls ?></span>
                      <span class="text-info text-sm">Called</span>
                      <span class="h2 font-weight-bold"><?php echo $totalPassed ?></span>
                      <span class="text-info text-sm">Passed</span>
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">Percentages</h5>
                      <span class="h2 font-weight-bold"><?php echo $calledPercent ?></span>
                      <span class="text-info text-sm">Called</span>
                      <span class="h2 font-weight-bold"><?php echo $passedPercent ?></span>
                      <span class="text-info text-sm">Passed</span>
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
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">Last Year</h5>
                      <span class="h2 font-weight-bold"><?php echo $totalLastYear ?></span>
                      <span class="text-info text-sm">total</span>
                      <span class="h2 font-weight-bold"><?php echo $passedLastYear ?></span>
                      <span class="text-info text-sm">passed</span>
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">This Year</h5>
                      <span class="h2 font-weight-bold"><?php echo $totalThisYear ?></span>
                      <span class="text-info text-sm">total</span>
                      <span class="h2 font-weight-bold"><?php echo $passedThisYear ?></span>
                      <span class="text-info text-sm">Passed</span>
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
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">Last Month</h5>
                      <span class="h2 font-weight-bold"><?php echo $totalLastMonth ?></span>
                      <span class="text-info text-sm">total</span>
                      <span class="h2 font-weight-bold"><?php echo $passedLastMonth ?></span>
                      <span class="text-info text-sm">passed</span>
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">This Month</h5>
                      <span class="h2 font-weight-bold"><?php echo $totalThisMonth ?></span>
                      <span class="text-info text-sm">total</span>
                      <span class="h2 font-weight-bold"><?php echo $passedThisMonth ?></span>
                      <span class="text-info text-sm">Passed</span>
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
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">Last Week</h5>
                      <span class="h2 font-weight-bold"><?php echo $totalLastWeek ?></span>
                      <span class="text-info text-sm">total</span>
                      <span class="h2 font-weight-bold"><?php echo $passedLastWeek ?></span>
                      <span class="text-info text-sm">passed</span>
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">This Week</h5>
                      <span class="h2 font-weight-bold"><?php echo $totalThisWeek ?></span>
                      <span class="text-info text-sm">total</span>
                      <span class="h2 font-weight-bold"><?php echo $passedThisWeek ?></span>
                      <span class="text-info text-sm">Passed</span>
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
                      <h5 class="card-title text-uppercase text-muted mb-0">Male</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $totalMale ?></span>
                      <span class="text-info text-sm"><?php echo Round(($totalMale / $totalContacts) * 100, 2) ?>%</span>
                      <h5 class="card-title text-uppercase text-muted mb-0">Female</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $totalFemale ?></span>
                      <span class="text-info text-sm"><?php echo Round(($totalFemale / $totalContacts) * 100, 2) ?>%</span>
                      <h5 class="card-title text-uppercase text-muted mb-0">Unknown</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $totalGenderUnknown ?></span>
                      <span class="text-info text-sm"><?php echo Round(($totalGenderUnknown / $totalContacts) * 100, 2) ?>%</span>
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
                    <div class="col">
                    <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">Farah</h5>
                      <span class="h2 font-weight-bold"><?php echo $totalFarah ?></span>
                      <span class="text-info text-sm">total</span>
                      <span class="h2 font-weight-bold"><?php echo $passedFarah ?></span>
                      <span class="text-info text-sm">passed</span>
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">By Week</h5>
                      <span class="h2 font-weight-bold"><?php echo $lastWeekFarah ?></span>
                      <span class="text-info text-sm">Last</span>
                      <span class="h2 font-weight-bold"><?php echo $thisWeekFarah ?></span>
                      <span class="text-info text-sm">Current</span>
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
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">Rahmeh</h5>
                      <span class="h2 font-weight-bold"><?php echo $totalRahmeh ?></span>
                      <span class="text-info text-sm">total</span>
                      <span class="h2 font-weight-bold"><?php echo $passedRahmeh ?></span>
                      <span class="text-info text-sm">passed</span>
                      <h5 class="card-title text-uppercase text-muted mt-3 mb-0 h2">By Week</h5>
                      <span class="h2 font-weight-bold"><?php echo $lastWeekRahmeh ?></span>
                      <span class="text-info text-sm">Last</span>
                      <span class="h2 font-weight-bold"><?php echo $thisWeekRahmeh ?></span>
                      <span class="text-info text-sm">Current</span>
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
                    <div class="text-center mb-1"><a href ="grouplist.php?group=adgroup">Ads</a> - <em>Top 5</em></div>
                      <div class="col">
                        <?php 
                          $adsList = $groups->getGroupList('adgroup',5);
                          foreach($adsList as $row){
                            echo'
                            <p class="h5 text-uppercase text-muted mb-2">'.$row['adgroup'] .'</p>';
                          }
                        ?>
                    </div>
                    <div class="col-auto">
                    <?php 
                        foreach($adsList as $row){
                          echo '<p class="h5 font-weight-bold mb-2">'.$row['total'].'</p>';
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
                    <div class="text-center mb-1"><a href ="grouplist.php?group=country">Country</a> - <em>Top 5</em></div>
                      <div class="col">
                        <?php 
                          $adsList = $groups->getGroupList('country',5);
                          foreach($adsList as $row){
                            echo '<p class="h5 text-uppercase text-muted mb-2">'.$row['country'] .'</p>';
                          }
                        ?>
                    </div>
                    <div class="col-auto">
                    <?php 
                        foreach($adsList as $row){
                          echo'
                          <p class="h5 font-weight-bold mb-2">'.$row['total'].'</p>';
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
                    <div class="text-center mb-1"><a href ="grouplist.php?group=nationality">Country</a> - <em>Top 5</em></div>
                      <div class="col">
                        <?php 
                          $adsList = $groups->getGroupList('nationality',5);
                          foreach($adsList as $row){
                            echo '<p class="h5 text-uppercase text-muted mb-2">'.$row['nationality'] .'</p>';
                          }
                        ?>
                    </div>
                    <div class="col-auto">
                    <?php 
                        foreach($adsList as $row){
                          echo'
                          <p class="h5 font-weight-bold mb-2">'.$row['total'].'</p>';
                        }
                      ?>
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
</body>
</html>
