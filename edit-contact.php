<?php
// Initialize the session
require 'assets/php/session.php';

// connects to the database
require 'assets/php/config.php';

$findUser = "SELECT cid, name, wanumber, cdate, ctime, 
country, nationality, adgroup, gender, 
cbb, called, passed, attitude, notes
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
WHERE cid=".$_REQUEST["contactid"];

$result = mysqli_query($conn, $findUser);

$contact = $result->fetch_assoc();
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Info Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>

<body>
<?php include_once 'assets/php/navbar.php'; ?>

    <!-- Test if Contact info is found.  Add Not if not found-->
    <?php
    if ($contact == NULL){
        echo "<h1>Contact Not Found</h1>";
    }
    //echo "<H1>Gender of Contact is ".$contact[gender]."</H1>";
    //echo "<p>".$contact[cbb]."</p>";
    ?>


    <div class="registration-form">
        <form action="update.php" method="POST" id="form">
        <h1 class="text-center" >Contact ID - <?php echo $_REQUEST["contactid"]; ?></h1>
            <div class="form-icon">
                <span><i class="icon icon-pencil"></i></span>
            </div>


            <!-- to pass contact ID to update proper Contact -->
            <input type="hidden" name="cid" id="cid" value="<?php echo $contact["cid"]; ?>">

            <div class="form-group">
                <input type="text" class="form-control item" id="name" value="<?php echo (isset($contact["name"])) ? $contact["name"]: ''?>" placeholder="Name" name="name">
            </div>

            <div class="form-check form-group selector-group pt-3 pl-3 mb-3">
                <label for="gender">Select Gender</label>
                <div class="d-flex justify-content-around" id="gender">
                    <label class="radio-inline" for="male">Male
                        <input type="radio" class="form-check-input" value ="1" name="gender" id="male" <?php echo ($contact["gender"]==1 ? 'checked': '')?>>
                    </label>
                    <label class="radio-inline" for="female"> Female
                        <input type="radio" class="form-check-input" value="2" name="gender" id="female" <?php echo ($contact["gender"]==2 ? 'checked': '')?>>
                    </label>
                    <label class="radio-inline" for="unknown" checked>Not Known
                        <input type="radio" class="form-check-input" value="3" name="gender" id="unknown" <?php echo ($contact["gender"]==3 ? 'checked': '')?>>
                    </label> 
                </div>
                <p class="fst-italic fw-light">'Hi' for Male | 'Hello' for Female | 'Greetings' for unknown</p>
            </div>

            <div class="form-group">
                <label for="date">Enter Date of First Text</label>
                <input type="date" class="form-control item" id="date" name="date" value="<?php echo (isset($contact["cdate"])) ? $contact["cdate"]: ''?>" required/>
            </div>

            <div class="form-group">
                <label for="time">Enter Time of First Text</label>
                <input type="time" class="form-control item" id="time" name="time" value="<?php echo (isset($contact["ctime"])) ? $contact["ctime"]: ''?>" required/>
            </div>

            <div class="form-group">
                <input type="tel" class="form-control item" id="whatsapp-number" placeholder="Whatsapp Number" value="<?php echo (isset($contact["wanumber"])) ? $contact["wanumber"]: ''?>"
                    name="number" pattern="[0-9]{4,15}" required>
            </div>
            
            <div class="form-group">
                <select class="form-select form-control item" aria-label="Country Selector" name="country" value="<?php echo (isset($contact["country"])) ? $contact["country"]: ''?>">
                    <option selected>Select Country</option>
                    <?php 
                        $sqli = "SELECT * FROM apps_countries";
                        $results = mysqli_query($conn, $sqli);
                        while($row = mysqli_fetch_array($results)){
                            echo "<option value=\"".$row["id"]."\"";
                            echo ($row["id"]==$contact["country"] ? ' selected': '');
                            echo ">".$row["country_name"]."</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <select class="form-select form-control item" aria-label="Nationality Selector" name="nationality" value=5>
                    <option selected>Select Nationality</option>
                    <?php 
                        $sqli = "SELECT * FROM apps_countries";
                        $results = mysqli_query($conn, $sqli);
                        while($row = mysqli_fetch_array($results)){
                            echo "<option value=\"".$row["id"]."\"";
                            echo ($row["id"]==$contact["nationality"] ? ' selected': '');
                            echo ">".$row["country_name"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
            <select class="form-select form-control item" aria-label="Ad Group Selector" name="adgroup">
                    <option selected>Ad Group</option>
                    <?php 
                        $sqli = "SELECT * FROM adgroup";
                        $results = mysqli_query($conn, $sqli);
                        while($row = mysqli_fetch_array($results)){
                            echo "<option value=\"".$row["agid"]."\"";
                            echo ($row["agid"]==$contact["adgroup"] ? ' selected': '');
                            echo ">".$row["agname"]."</option>";
                            
                            //echo "<option value=\"".$row['agid']."\"><strong>".$row['agname']."</strong> - ".$row['wa_text']."</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="selector-group px-4 pt-2 pb-3 justify-content-around form-group">
                <div class="form-check form-check-inline form-group px-3">
                    <input class="form-check-input" type="checkbox" id="christian" value="christian" name="christian"
                    <?php echo ($contact["cbb"]==1 ? 'checked': '')?>>
                    <label class="form-check-label" for="christian">Christian?</label>
                </div>
                <div class="form-check form-check-inline form-group px-3">
                    <input class="form-check-input" type="checkbox" id="called" value="called" name="called"
                    <?php echo ($contact["called"]==1 ? 'checked': '')?>>
                    <label class="form-check-label" for="called">Called?</label>
                </div>
                <div class="form-check form-check-inline form-group px-3">
                    <input class="form-check-input" type="checkbox" id="passed-off" value="passedOff" name="passed-off"
                    <?php echo ($contact["passed"]==1 ? 'checked': '')?>>
                    <label class="form-check-label" for="passed-off">Passed Off?</label>
                </div>
            </div>


            <div class="form-group selector-group p-3">
                <p class="text-center">Select Attitude Level</p>
                <div class="d-flex justify-content-around form-check-inline" id="attitude">

                    <input type="radio" class="form-check-input" value ="0" name="attitude" id="unknown"
                    <?php echo ($contact["attitude"]==0 ? 'checked': '')?>>
                    <label class="form-check-label fs-6 fw-lighter" for="male">Unknown</label>

                    <input type="radio" class="form-check-input" value="1" name="attitude" id="hostile"
                    <?php echo ($contact["attitude"]==1 ? 'checked': '')?>>
                    <label class="form-check-label fs-6 fw-lighter" for="hostile"> Hostile</label>
                    
                    <input type="radio" class="form-check-input" value="2" name="attitude" id="notopen"
                    <?php echo ($contact["attitude"]==2 ? 'checked': '')?>>
                    <label class="form-check-label fs-6 fw-lighter" for="notopen">Not Open</label>
                    
                    <input type="radio" class="form-check-input" value="3" name="attitude" id="curious"
                    <?php echo ($contact["attitude"]==3 ? 'checked': '')?>>
                    <label class="form-check-label fs-6 fw-lighter" for="curious">Curious</label>
                    
                    
                    <input type="radio" class="form-check-input" value="4" name="attitude" id="open"
                    <?php echo ($contact["attitude"]==4 ? 'checked': '')?>>
                    <label class="form-check-label fs-6 fw-lighter" for="open">Open</label>
                    
                </div>
            </div>

            <div class="form-group">
                <textarea class="form-control item" id="notes" placeholder="Notes" name="notes"><?php echo (isset($contact["notes"])) ? $contact["notes"]: ''?></textarea>
            </div>

            <div class="form-group text-center">
                <button type="submit" value ="Submit" class="btn btn-block create-account">Update Contact</button>
                <button type="button" value ="Cancel" class="btn btn-block create-account" onclick="history.back();">Cancel</button>
            </div>
        </div>
        
    </form>

    

    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
</body>

</html>