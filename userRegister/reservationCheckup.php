<?php
$mysqli = new mysqli('localhost', 'root', '', 'bookingcalendar');
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $mysqli = new mysqli('localhost', 'root', '', 'bookingcalendar');
    $stmt = $mysqli->prepare("select * from bookingcalendar where date=?");
    $stmt->bind_param('s', $date);
    $bookings = array();
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row['timeslot'];
            }

            $stmt->close();
        }
    }
}

//  Error Handler


$bookingSlot = 30;


$response = array(
    'status' => 0,
    'message' => 'Form Submission Failed'
);

if (isset($_POST['firstname']) || isset($_POST['middleName']) || isset($_POST['lastName']) || isset($_POST['timesslot']) || isset($_POST['contactNumber']) || isset($_POST['work']) || isset($_POST['category'])) {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $timeslot = $_POST['timeslot'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contactNumber'];
    $work = $_POST['work'];
    $category = $_POST['category'];
    $mysqli = new mysqli('localhost', 'root', '', 'bookingcalendar');
    $stmt = $mysqli->prepare("select * from bookingcalendar where date=? AND timeslot =?");
    $stmt->bind_param('ss', $date, $timeslot);


    if($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows >= $bookingSlot) {
            $msg = "<div class='alert alert-danger'>Already Booked</div>";
        } else {
            $stmt = $mysqli->prepare("INSERT INTO bookingcalendar (firstName, middleName,lastName,timeslot, email, contactNumber,work, date , category) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('sssssssss', $firstName, $middleName, $lastName, $timeslot, $email, $contactNumber, $work, $date, $category);
            $stmt->execute();
            $msg = "<div class='alert alert-success'>Booking Successfull</div>";
            $bookings[] = $timeslot;
            $stmt->close();
            $mysqli->close();
        }
    }
}



$duration = 120;
$cleanup = 0;
$start = "09:00";   
$end = "15:00";


function timeslots($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots = array();

    for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if ($endPeriod > $end) {
            break;
        }
        $slots[] = $intStart->format("H:iA") . "-" . $endPeriod->format("H-iA");
    }
    return $slots;
}



   
?>