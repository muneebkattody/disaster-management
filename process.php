<?php
class formContoller {
    private $origin;
    private $needs;
    private $db_handle;

    function __construct(){
        require 'config.php';
        // GEIING SOURCE NAME
        $this->origin = $_POST['origin'];

        // creating object of DBControler
        $this->db_handle = new DBController;

        // GET NEEDS FROM NEEDS.CSV FILE
        $file = fopen("csv/needs.csv","r");

        // CONVERTING CSV TO ARRAY
        $this->needs = array();
        while(($row = fgetcsv($file)) !== FALSE){
            foreach($row as $el)
            array_push($this->needs,$el);
        }

        // CLOSING FILE
        fclose($file);
    }

    function controller(){
        // IF ORIGIN IS CAMPNEEDS
        if ($this->origin == 'campneeds') {

            // GETTING ALL POST VALUES FROM CAMPNEEDS
            $campno = $_POST['campno'];
            $reqname = $_POST['reqname'];
            $reqphone = $_POST['reqphone'];

            // GETING NEW NEEDS
            foreach($this->needs as $el){
                $newNeeds[$el] = $_POST[$el];
                if(empty($newNeeds[$el])){
                    $newNeeds[$el]=0;
                }
            }

            // INSERT A RAW IN CAMPNEEDS HISTORY [INSERT ROW IS NOT AN INBUILT FUNCTION ITS DECLARED IN CONFIG.PHP]
            $this->db_handle->insert_row("campneeds_history", $campno, $reqname, $reqphone, $newNeeds, "NO");

            $result;

            // CHECK IF ROW EXIST IN CAMPNEEDS TABLE USING FUNCTION ROW EXIST[CONFIG.PHP]
            if ($this->db_handle->row_exist('campneeds', "campno=" . $campno)) {
                
                // IF EXIST UPDATE CAMPNEEDS TABLE
                $table = "campneeds";
                $where = "campno='" . $campno . "'";
                $update = "";
                foreach($this->needs as $el){
                    $update .= $el."=".$el."+".$newNeeds[$el];
                    if(!($el==end($this->needs))){
                        $update .= ",";
                    }
                }
                
                $this->db_handle->update_row($table, $where, $update);
            } 

            // IF ROW DOESN'T EXIST INSERT NEW ROW [CONFIG.PHP]
            else{
                $this->db_handle->insert_row("campneeds", $campno, $reqname, $reqphone, $newNeeds, "NO");
                }

            // CLOSING DATABASE CONNECTION
            $this->db_handle->close();

            // REDIRECTING TO SOURCE PAGE WITH MESSAGE
            //header('location: campneeds.php?status=Data Uploaded Successfully');
            
            // AJAX RETURN
            echo "Data uploaded.";
        }

        // IF ORIGIN IS DONATION
        if ($this->origin == 'donation') {

            // GETTING POST VALUES
            $state = $_POST['state'];
            $reqname = $_POST['reqname'];
            $reqphone = $_POST['reqphone'];

            // GETING NEW NEEDS
            foreach($this->needs as $el){
                $newNeeds[$el] = $_POST[$el];
                if(empty($newNeeds[$el])){
                    $newNeeds[$el]=0;
                }
            }
            //$location = $_POST['location'];

            // INSERT INTO TWO TABLES ONE FOR REFERENCE
            $this->db_handle->insert_row("donationindi", $state, $reqname, $reqphone, $newNeeds, "NO");
            $this->db_handle->insert_row("resources", $state, $reqname, $reqphone, $newNeeds, "NO");

            // CLOSES CONNECTION
            $this->db_handle->close();

            // REDIRECTING TO SOURCE PAGE
            //header('location: donation.php?status=Data Uploaded Successfully');
            echo "Data uploaded.";
        }


        // IF ORIGIN IS CREATECAMP
        if ($this->origin == 'createCamp') {

            // GETTING POST VALUES
            $name = $_POST['name'];
            $adminName = $_POST['adminName'];
            $adminPhone = $_POST['adminPhone'];
            $alterPhone = $_POST['alterPhone'];
            $adminMail = $_POST['adminMale'];
            $peopleCapacity = $_POST['peopleCapacity'];
            $toilet = $_POST['toilet'];
            $kitchen = $_POST['kitchen'];
            $geoLocation = $_POST['geoLocation'];
            $availVolunteer = $_POST['availVolunteer'];
            $availDoctor = $_POST['availDoctor'];
            $peopleNow = $_POST['peopleNow'];

            // INSERT INTO CAMPNEEDS
            if($this->db_handle->insert_row("campDetails", $name, $adminName, $adminPhone, $alterPhone, $adminMail, $peopleCapacity, $toilet, $kitchen, $geoLocation, $availVolunteer, $peopleNow)){

                // GETTING ID OF LAST INSERTED ROW
                $id = $this->db_handle->get_last_row("CampDetails", "id");

                // CLOSE CONNECTION
                $this->db_handle->close();
                //header('location: createCamp.php?status=Data Uploaded Successfully. Your Camp Id is:' . $id . '');
                echo "Data uploaded. "."Your Camp Id is:" . $id;
            } else{
                //  IF ERROR OCCURED
                error_log("CAMP DETAILS INSERT ROW ERROR OCCURED");
            }
        }


        // FOR MISSING PERSON OTHER ARE SAME AS ABOVE
        if($this->origin == 'missingPerson'){

            $state = $_POST['state'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $guardianName = $_POST['guardianName'];
            //$photo = $_POST['photo'];
            $district = $_POST['district'];
            $lastLocation = $_POST['lastLocation'];
            $missingDate = $_POST['missingDate'];
            $address = $_POST['address'];
            $reportedBy = $_POST['reportedBy'];
            $reportersNumber = $_POST['reportersNumber'];
            $policeStation = $_POST['policeStation'];
            $relativeName = $_POST['relativeName'];
            $relativeNumber = $_POST['relativeNumber'];
            $relativeNameSec = $_POST['relativeNameSec'];
            $relativeNumberSec = $_POST['relativeNumberSec'];
            $relativeNameThird = $_POST['relativeNameThird'];
            $relativeNumberThird = $_POST['relativeNumberthird'];    
            

            if($this->db_handle->insert_row("missingPerson", $state, $name, $description, $age, $gender, $guardianName, $district, $lastLocation, $missingDate, $address, $reportedBy, $reportersNumber, $policeStation, $relativeName, $relativeNumber, $relativeNameSec, $relativeNumberSec, $relativeNameThird, $relativeNumberThird)){
                $this->db_handle->close();
                //header('location: missingPerson.php?status=Data Uploaded Successfully.');
                echo "Data uploaded.";
            } else{
                error_log("ERROR OCCURED WHILE INSERTING ROW IN MISSIN PERSON");
            }
        }

        // IF ORIGIN IS NEW VOLUNTEER OTHERS ARE SAME AS ABOVE
        if($this->origin == 'newVolunteer'){

            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $district = $_POST['district'];
            $orgonization = $_POST['organization'];
            $area = $_POST['area'];
            $address = $_POST['address'];
        
            
            if(insert_row("newvolunteer", $name, $phone, $district, $orgonization, $area, $address)){
                $this->db_hanlde->close();
                //header('location: newVolunteer.php?status=Data Uploaded Successfully.');
                echo "Data uploaded.";
            } else{
                error_log("ERROR OCCURED IN INSERTING NEW ROW IN NEW VOLUNTEER");
            }
        }

        // IF ORIGIN IS PERSONS IN CAMP OTHERS ARE SAME AS ABOVE
        if($this->origin == 'personsInCamp'){

            $campNo = $_POST['campNo'];
            if(!is_numeric($campNo)){
                //header('location: personsInCamp.php?status=CamoNo must be a number.');
                echo "Camp No. must me a anumber.";
            }

            if(row_exist('campDetails', 'id='.$campNo)){
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $birthDay = $_POST['birthDay'];
                $birthMonth = $_POST['birthMonth'];
                $birthYear = $_POST['birthYear'];
                $emailId = $_POST['emailId'];
                $mobileNumber = $_POST['mobileNumber'];
                $gender = $_POST['gender'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $pinCode = $_POST['pinCode'];
            
                // DECLARING ARRAY FOR GET MEDICINES
                $medicines = [];
            
                // LOOPING THOUGH ARRAY INPUTS
                for($i=0;!empty($_POST['med'.$i]);$i++){
                    $medicines[$i]['name'] = $_POST['med'.$i];
                    if(!empty($_POST['medDosage'.$i])){
                        $medicines[$i]['dosage'] = $_POST['medDosage'.$i];
                    }
                }
            
                // CONVERNG AARAY TO JSON
                if($medicines!=""){
                    $medicines = json_encode($medicines);
                }else{
                    $medicines = NULL;
                }
                
            
                
                if($this->db_handle->insert_row("personsincamp", $campNo, $firstName, $lastName, $birthDay, $birthMonth, $birthYear, $emailId, $mobileNumber, $gender, $medicines, $address, $city, $pinCode)){
                    $db_handle->conn->close();
                    //header('location: personsInCamp.php?status=Data Uploaded Successfully.');
                    echo "Data uploaded.";
                } else{
                    error_log("ERROR OCCURED IN INSERTING NEW ROW OF PERSONS IN CAMP");
                }

            }else{
                echo "Camp number not found. Create a camp";
            }
        }

        // IF ORIGIN IS INSERNEED IT WILL CHANGE NEED.CSV AND CAMPNEEDS AND DONATION DATABASES
        if($this->origin == 'insertNeeds'){

            $needs = $_POST['needs'];

            if($needs!=""){

            $status = 1;

            $columns = explode(' ', $needs);
            foreach($columns as $col){
                if(add_column('campneeds',$col,'varchar(10)') && add_column('donationindi',$col,'varchar(10)') != TRUE){
                $status*=0; 
                }
            }

            if($status==1){
                    // ADD ENTRIES TO NEED.CSV FILE
                    $file = fopen("csv/needs.csv","a");
                    fputcsv($file,$columns,",");
                    fclose($file);

                    echo "Data uploaded.";

                }else{
                    error_log($db_handle->conn->error);
                }


            }
            else{
                echo "NULL INPUT";
                error_log("ERROR AT INSERTNEEDS : EMPTY INPUT [ FORM VALIDAION PROBLEM OCCURED ]");
            }
        }
    }

}

$form = new formContoller();
$form->controller();

?>