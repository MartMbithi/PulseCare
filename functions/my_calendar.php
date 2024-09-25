<?php
/*
 *   Crafted On Mon Sep 23 2024
 *   By the one and only Martin Mbithi (martin@devlan.co.ke)
 *   
 *   www.devlan.co.ke
 *   hello@devlan.co.ke
 *
 *
 *   The Devlan Solutions LTD Super Duper User License Agreement
 *   Copyright (c) 2022 Devlan Solutions LTD
 *
 *
 *   1. LICENSE TO BE AWESOME
 *   Congrats, you lucky human! Devlan Solutions LTD hereby bestows upon you the magical,
 *   revocable, personal, non-exclusive, and totally non-transferable right to install this epic system
 *   on not one, but TWO separate computers for your personal, non-commercial shenanigans.
 *   Unless, of course, you've leveled up with a commercial license from Devlan Solutions LTD.
 *   Sharing this software with others or letting them even peek at it? Nope, that's a big no-no.
 *   And don't even think about putting this on a network or letting a crowd join the fun unless you
 *   first scored a multi-user license from us. Sharing is caring, but rules are rules!
 *
 *   2. COPYRIGHT POWER-UP
 *   This Software is the prized possession of Devlan Solutions LTD and is shielded by copyright law
 *   and the forces of international copyright treaties. You better not try to hide or mess with
 *   any of our awesome proprietary notices, labels, or marks. Respect the swag!
 *
 *
 *   3. RESTRICTIONS, NO CHEAT CODES ALLOWED
 *   You may not, and you shall not let anyone else:
 *   (a) reverse engineer, decompile, decode, decrypt, disassemble, or do any sneaky stuff to
 *   figure out the source code of this software;
 *   (b) modify, remix, distribute, or create your own funky version of this masterpiece;
 *   (c) copy (except for that one precious backup), distribute, show off in public, transmit, sell, rent,
 *   lease, or otherwise exploit the Software like it's your own.
 *
 *
 *   4. THE ENDGAME
 *   This License lasts until one of us says 'Game Over'. You can call it quits anytime by
 *   destroying the Software and all the copies you made (no hiding them under your bed).
 *   If you break any of these sacred rules, this License self-destructs, and you must obliterate
 *   every copy of the Software, no questions asked.
 *
 *
 *   5. NO GUARANTEES, JUST PIXELS
 *   DEVLAN SOLUTIONS LTD doesn’t guarantee this Software is flawless—it might have a few
 *   quirks, but who doesn’t? DEVLAN SOLUTIONS LTD washes its hands of any other warranties,
 *   implied or otherwise. That means no promises of perfect performance, marketability, or
 *   non-infringement. Some places have different rules, so you might have extra rights, but don’t
 *   count on us for backup if things go sideways. Use at your own risk, brave adventurer!
 *
 *
 *   6. SEVERABILITY—KEEP THE GOOD STUFF
 *   If any part of this License gets tossed out by a judge, don’t worry—the rest of the agreement
 *   still stands like a boss. Just because one piece fails doesn’t mean the whole thing crumbles.
 *
 *
 *   7. NO DAMAGE, NO DRAMA
 *   Under no circumstances will Devlan Solutions LTD or its squad be held responsible for any wild,
 *   indirect, or accidental chaos that might come from using this software—even if we warned you!
 *   And if you ever think you’ve got a claim, the most you’re getting out of us is the license fee you
 *   paid—if any. No drama, no big payouts, just pixels and code.
 *
 */

function getAppointmentsPerDay($year, $month, $mysqli)
{
    $appointments = [];

    // Use STR_TO_DATE to convert `appointment_date` from VARCHAR to DATE
    $query = "SELECT appointment_user_id, DAY(STR_TO_DATE(appointment_date, '%Y-%m-%d')) AS day, 
               COUNT(*) AS total_appointments 
               FROM appointments  
               WHERE YEAR(STR_TO_DATE(appointment_date, '%Y-%m-%d')) = $year 
               AND MONTH(STR_TO_DATE(appointment_date, '%Y-%m-%d')) = $month 
               AND appointment_user_id  = '{$_SESSION['user_id']}'
               GROUP BY DAY(STR_TO_DATE(appointment_date, '%Y-%m-%d'))";

    $result = mysqli_query($mysqli, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }
    }

    return $appointments;
}

// Get current year and month, or set default
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$month = isset($_GET['month']) ? $_GET['month'] : date('m');

// Get appointments data
$appointments = getAppointmentsPerDay($year, $month, $mysqli);

// Build a lookup array for easy access
$appointmentsPerDay = [];
foreach ($appointments as $appointment) {
    $appointmentsPerDay[$appointment['day']] = $appointment['total_appointments'];
}

// Generate the calendar view
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$firstDayOfMonth = date('w', strtotime("$year-$month-01"));

echo "<table class='table table-bordered table-striped text-center'>";
echo "<thead class='table-light'><tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr></thead>";
echo "<tbody>";

// Start the calendar
echo "<tr>";

// Empty cells before the first day
for ($i = 0; $i < $firstDayOfMonth; $i++) {
    echo "<td></td>";
}

// Print days with appointment counts
for ($day = 1; $day <= $daysInMonth; $day++) {
    if (($day + $firstDayOfMonth - 1) % 7 == 0 && $day != 1) {
        echo "</tr><tr>"; // New row every Sunday
    }

    $appointmentCount = isset($appointmentsPerDay[$day]) ? $appointmentsPerDay[$day] : 0;

    echo "<td><strong>$day</strong>";

    // Only show badge if there are appointments for that day
    if ($appointmentCount > 0) {
        echo "<br><span class='badge bg-primary'>$appointmentCount</span>";
    }

    echo "</td>";
}

// Empty cells after the last day
for ($i = ($firstDayOfMonth + $daysInMonth) % 7; $i < 7 && $i > 0; $i++) {
    echo "<td></td>";
}

echo "</tr>";
echo "</tbody>";
echo "</table>";
