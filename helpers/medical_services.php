<?php
/*
 *   Crafted On Tue Sep 24 2024
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

/* Add Service */
if (isset($_POST['Add_Service'])) {
    $service_code = mysqli_real_escape_string($mysqli, $_POST['service_code']);
    $service_name = mysqli_real_escape_string($mysqli, $_POST['service_name']);
    $service_details = mysqli_real_escape_string($mysqli, $_POST['service_details']);
    $service_assigned_user_id  = mysqli_real_escape_string($mysqli, $_POST['service_assigned_user_id']);

    /* Prevent Duplications */
    $duplicator_checker = "SELECT * FROM medical_services WHERE service_code = '{$service_code}' 
    AND  service_name = '{$service_name}' AND service_assigned_user_id  = '{$service_assigned_user_id}'";
    $res = mysqli_query($mysqli, $duplicator_checker);
    if (mysqli_num_rows($res) > 0) {
        $err = "Medical Service Already Exists";
    } else {
        if (mysqli_query(
            $mysqli,
            "INSERT INTO medical_services (service_code, service_name, service_details, service_assigned_user_id)
        VALUES ('{$service_code}', '{$service_name}', '{$service_details}', '{$service_assigned_user_id}')"
        )) {
            $success = "Medical Service Added Successfully";
        } else {
            $err = "Failed to Add Medical Service";
        }
    }
}

/* Update Service */
if (isset($_POST['Update_Service'])) {
    $service_code = mysqli_real_escape_string($mysqli, $_POST['service_code']);
    $service_name = mysqli_real_escape_string($mysqli, $_POST['service_name']);
    $service_details = mysqli_real_escape_string($mysqli, $_POST['service_details']);
    $service_assigned_user_id  = mysqli_real_escape_string($mysqli, $_POST['service_assigned_user_id']);
    $service_id = mysqli_real_escape_string($mysqli, $_POST['service_id']);

    /* Update */
    if (mysqli_query(
        $mysqli,
        "UPDATE medical_services SET service_code = '{$service_code}', service_name = '{$service_name}', service_details = '{$service_details}', service_assigned_user_id = '{$service_assigned_user_id}'
         WHERE service_id = '{$service_id}'"
    )) {
        $success = "Medical Service Updated Successfully";
    } else {
        $err = "Failed to Update Medical Service";
    }
}

/* Delete Service */
if (isset($_POST['Delete_Service'])) {
    $service_id = mysqli_real_escape_string($mysqli, $_POST['service_id']);
    if (mysqli_query($mysqli, "DELETE FROM medical_services WHERE service_id = '{$service_id}'")) {
        $success = "Medical Service Deleted Successfully";
    } else {
        $err = "Failed to Delete Medical Service";
    }
}


/* Add Appointment */
if (isset($_POST['Add_Appointment'])) {
    $appointment_user_id  = mysqli_real_escape_string($mysqli, $_POST['appointment_user_id']);
    $appointment_date = mysqli_real_escape_string($mysqli, $_POST['appointment_date']);
    $appointment_service_id  = mysqli_real_escape_string($mysqli, $_POST['appointment_service_id']);
    $appointment_more_details = mysqli_real_escape_string($mysqli, $_POST['appointment_more_details']);

    /* Add Appointment */
    if (mysqli_query(
        $mysqli,
        "INSERT INTO appointments (appointment_user_id, appointment_date, appointment_service_id, appointment_more_details)
        VALUES ('{$appointment_user_id}', '{$appointment_date}', '{$appointment_service_id}', '{$appointment_more_details}')"
    )) {
        $success = "Appointment Added Successfully";
    } else {
        $err = "Failed to Add Appointment";
    }
}
