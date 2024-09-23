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

/* Register User */
if (isset($_POST['Register_User'])) {
    $user_names = mysqli_real_escape_string($mysqli, $_POST['user_names']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['user_password'])));
    $user_phone = mysqli_real_escape_string($mysqli, $_POST['user_phone']);
    $user_access_level = mysqli_real_escape_string($mysqli, $_POST['user_access_level']);
    $user_designation = mysqli_real_escape_string($mysqli, $_POST['user_designation']);

    /* Prevent Duplications */
    $duplicator_checker = "SELECT * FROM users WHERE user_email = '{$user_email}' ||  user_phone = '{$user_phone}'";
    $res = mysqli_query($mysqli, $duplicator_checker);
    if (mysqli_num_rows($res) > 0) {
        $err = "Email / Phone number already exists";
    } else {
        if (mysqli_query(
            $mysqli,
            "INSERT INTO users(user_names, user_email, user_password, user_phone, user_access_level, user_designation)
            VALUES('{$user_names}', '{$user_email}', '{$user_password}', '{$user_phone}', '{$user_access_level}', '{$user_designation}')"
        )) {
            $success = "Accounted created successfully";
        } else {
            $err = "Failed, please try again";
        }
    }
}

/* Update User */
if (isset($_POST['Update_User'])) {
    $user_names = mysqli_real_escape_string($mysqli, $_POST['user_names']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_phone = mysqli_real_escape_string($mysqli, $_POST['user_phone']);
    $user_access_level = mysqli_real_escape_string($mysqli, $_POST['user_access_level']);
    $user_designation = mysqli_real_escape_string($mysqli, $_POST['user_designation']);
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);

    /* Update */
    if (mysqli_query(
        $mysqli,
        "UPDATE users SET user_names = '{$user_names}', user_email = '{$user_email}', user_phone = '{$user_phone}', user_access_level = '{$user_access_level}', user_designation = '{$user_designation}' WHERE user_id = '{$user_id}'"
    )) {
        $success = "Updated successfully";
    } else {
        $err = "Failed, please try again";
    }
}

/* Change Password */
if (isset($_POST['Change_Password'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    if ($confirm_password != $new_password) {
        $err = "Passwords does not match";
    } else {
        if (mysqli_query(
            $mysqli,
            "UPDATE users SET user_password = '{$confirm_password}' WHERE user_id = '{$user_id}'"
        )) {
            $success = "Password updated";
        } else {
            $err = "Failed, please try again";
        }
    }
}

/* Delete User */
if (isset($_POST['Delete_User'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);

    /* Delete */
    if (mysqli_query(
        $mysqli,
        "DELETE FROM users WHERE user_id =  '{$user_id}'"
    )) {
        $success = "Deleted successfully";
    } else {
        $err = "Failed, please try again";
    }
}
