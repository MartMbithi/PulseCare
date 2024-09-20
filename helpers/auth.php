<?php
/*
 *   Crafted On Fri Sep 20 2024
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


/* Login */
if (isset($_POST['Login'])) {
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['user_password'])));

    /* Process Login  */
    $login_sql = "SELECT * FROM users  WHERE user_email = '{$user_email}' AND user_password = '{$user_password}'";
    $res = mysqli_query($mysqli, $login_sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);

        /* Bind Session Variables */
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_access_level'] = $row['user_access_level'];
        $_SESSION['user_email'] = $row['user_email'];
        $_SESSION['success'] = 'Login successful';


        /* Global Check If This User Account Has Been Deactivated */
        if ($row['user_account_status'] == '0') {

            if ($row['user_change_password'] == '0') {

                /* Check If 2FA Is Enabled */
                $_SESSION['success'] = 'Logged in successfully';
                header('Location: home');
                exit;
            } else {
                /* Force Password Reset If User Account Marked To Reset Password */
                $_SESSION['success'] = 'Please change your password to proceed';
                header('Location: change_password');
                exit;
            }
        } else {
            $err = "Your account has been deactivated, please contact the system administrator";
        }
    } else {
        $err = "Invalid login credentials";
    }
}



/* Force Password Reset If User Account Marked To Reset Password */
if (isset($_POST['Change_Password'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Persist */
    $update_password_sql = "UPDATE users SET user_password = '{$confirm_password}', user_change_password = '0' 
    WHERE user_id = '{$user_id}'";
    if (mysqli_query($mysqli, $update_password_sql)) {
        $_SESSION['success'] = 'Logged in successfully';
        header('Location: dashboard');
        exit;
    } else {
        $err = "Failed, please try again later";
    }
}


/* Reset Password Step 1 */
if (isset($_POST['Reset_Password_Step_1'])) {
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);

    /* Check If This Account Exists */
    $staff_check_sql = "SELECT * FROM users WHERE user_email = '{$user_email}' AND user_account_status = '0'";
    $res = mysqli_query($mysqli, $staff_check_sql);
    if (mysqli_num_rows($res) > 0) {
        $_SESSION['user_email'] = $user_email;
        $_SESSION['success'] = "Email validated, proceed to resetting password";
        header('Location: confirm_password');
        exit;
    } else {
        $err = "Email does not exist";
    }
}


/* Reset Password Step 2 */
if (isset($_POST['Reset_Password_Step_2'])) {
    $user_email = mysqli_real_escape_string($mysqli, $_SESSION['user_email']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($confirm_password != $new_password) {
        $err = "Failed, please try again";
    } else {

        /* Update staff password */
        $staff_check_sql = "SELECT * FROM users WHERE user_email = '{$user_email}'";
        $res = mysqli_query($mysqli, $staff_check_sql);
        if (mysqli_num_rows($res) > 0) {
            /* Update staff passwords */
            $update_password_sql = "UPDATE users SET user_password = '{$new_password}'  WHERE user_email = '{$user_email}'";
            if (mysqli_query($mysqli, $update_password_sql)) {
                unset($_SESSION['user_email']);
                $_SESSION['success'] = "Password reset successful, proceed to login";
                header('Location: ../');
                exit;
            } else {
                $err = "Failed, please try again later";
            }
        } else {
            unset($_SESSION['user_email']);
            $_SESSION['err'] = "Failed to reset password, kindly try again";
            header('Location: reset_password');
            exit;
        }
    }
}


/* Register Account */
if (isset($_POST['RegisterAccount'])) {
    $user_names = mysqli_real_escape_string($mysqli, $_POST['user_names']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['user_password'])));
    $user_designation = 'Patient';
    $user_access_level = $user_designation;
    $user_phone = mysqli_real_escape_string($mysqli, $_POST['user_phone']);

    /* Prevent Duplicates On Email And Contacts */
    $staff_check_sql = "SELECT * FROM users WHERE user_email = '{$user_email}' ||  user_phone = '{$user_phone}'";
    $res = mysqli_query($mysqli, $staff_check_sql);
    if (mysqli_num_rows($res) > 0) {
        $err = "Email or Phone number already exists";
    } else {
        if (mysqli_query(
            $mysqli,
            "INSERT INTO users (user_names, user_email, user_password, user_designation, user_access_level, user_phone) 
            VALUES('{$user_names}', '{$user_email}', '{$user_password}', '{$user_designation}', '{$user_access_level}', '{$user_phone}')"
        )) {
            $_SESSION['success'] = "Account created successfully, proceed to login";
            header('Location: ../');
            exit;
        } else {
            $err = "Failed, please try again";
        }
    }
}
