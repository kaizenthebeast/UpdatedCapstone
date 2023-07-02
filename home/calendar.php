<?php
 include ('../userRegister/authentication.php');



function build_calendar($month, $year)
{
    $mysqli = new mysqli('localhost', 'root', '', 'bookingcalendar');
    // $stmt = $mysqli->prepare("select * from bookings where MONTH(date) = ? AND YEAR(date) = ?");
    // $stmt->bind_param('ss', $month, $year);
    // $bookings = array();
    // if($stmt->execute()){
    //     $result = $stmt->get_result();
    //     if($result->num_rows>0){
    //         while($row = $result->fetch_assoc()){
    //             $bookings[] = $row['date'];
    //         }

    //         $stmt->close();
    //     }
    // }


    // Create array containing abbreviations of days of week.
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    // What is the first day of the month in question?
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // How many days does this month contain?
    $numberDays = date('t', $firstDayOfMonth);

    // Retrieve some information about the first day of the
    // month in question.
    $dateComponents = getdate($firstDayOfMonth);

    // What is the name of the month in question?
    $monthName = $dateComponents['month'];

    // What is the index value (0-6) of the first day of the
    // month in question.
    $dayOfWeek = $dateComponents['wday'];

    // Create the table tag opener and day headers

    $datetoday = date('Y-m-d');



    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar .= "<button class='changemonth btn btn-xs btn-secondary ' data-month='" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "'data-year='" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'>Previous</button> ";

    $calendar .= " <button class='changemonth btn btn-xs btn-primary' data-month='" . date('m') . "'data-year='" . date('Y') . "'>Current Month</button> ";

    $calendar .= "<button class='changemonth btn btn-xs btn-secondary' data-month='" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "'data-year='" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>Next Month</button></center><br>";



    $calendar .= "<tr>";

    // Create the calendar headers

    foreach ($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    }

    // Create the rest of the calendar

    // Initiate the day counter, starting with the 1st.

    $currentDay = 1;

    $calendar .= "</tr><tr>";

    // The variable $dayOfWeek is used to
    // ensure that the calendar
    // display consists of exactly 7 columns.

    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td  class='empty'></td>";
        }
    }


    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {

        // Seventh column (Saturday) reached. Start a new row.

        if ($dayOfWeek == 7) {

            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        $dayname = strtolower(date('l', strtotime($date)));
        $eventNum = 0;
        $today = $date == date('Y-m-d') ? "today" : "";
        if ($dayname == 'saturday' || $dayname == 'sunday') {
            $calendar .= "<td><h6>$currentDay</h6>";
        } elseif ($date < date('Y-m-d')) {
            $calendar .= "<td><h6>$currentDay</h6> <button class='btn btn-secondary btn-sm'>N/A</button>";
        } else {

            $totalbookings = checkSlots($mysqli, $date);
            if ($totalbookings == 7) {
                $calendar .= "<td class='$today'><h6>$currentDay</h6> <a href='#' class='btn btn-danger btn-sm'>Fully Booked</a>";
            } else {
                $availableslots = 7 - $totalbookings;
                $calendar .= "<td class='$today'><h6>$currentDay</h6> <a href='book.php?date=" . $date . "' class='btn btn-primary btn-sm'>Book Now</a><div><small><i>$availableslots slots left</i></small></div>";
            }
        }




        $calendar .= "</td>";
        // Increment counters

        $currentDay++;
        $dayOfWeek++;
    }



    // Complete the row of the last week in month, if necessary

    if ($dayOfWeek != 7) {

        $remainingDays = 7 - $dayOfWeek;
        for ($l = 0; $l < $remainingDays; $l++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr>";

    $calendar .= "</table>";

    echo $calendar;
}

function checkSlots($mysqli, $date)
{

    $stmt = $mysqli->prepare("select * from bookingcalendar where date = ? ");
    $stmt->bind_param('s', $date);
    $totalbookings = 0;
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $totalbookings++;
            }

            $stmt->close();
        }
    }

    return $totalbookings;
}
$dateComponents = getdate();
if (isset($_POST['month']) && isset($_POST['year'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];
} else {
    $month = $dateComponents['mon'];
    $year = $dateComponents['year'];
}
echo build_calendar($month, $year);
