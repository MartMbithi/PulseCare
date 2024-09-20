<?php
/*
 *   Crafted On Mon Aug 26 2024
 *   By the one and only Martin Mbithi (martin.mbithi@makueni.go.ke, www.martmbithi.github.io)
 * 
 *   www.makueni.go.ke
 *   info@makueni.go.ke
 *
 *
 *   The Government Of Makueni DevSecOps Band User License Agreement
 *   Copyright (c) 2023 Government of Makueni County
 *
 *
 *   1. LICENSE TO RULE
 *   Welcome to the elite club! Crafted by the ingenious Martin Mbithi, this software comes with the all-powerful,
 *   revocable, personal, non-exclusive, and non-transferable right to install and activate this masterpiece on ONE  
 *   lucky computer for your official, non-commercial escapades. Got a commercial itch? Better get that license first. 
 *   No peeking, sharing, or showing off this software to anyone else—strictly against the rules!
 *
 *   2. COPYRIGHT POWER
 *   This software, a creation of Martin Mbithi under the banner of the Government Of Makueni DevSecOps Band, is guarded by 
 *   copyright law and international treaties. So, don’t even think about messing with the proprietary notices, labels, 
 *   or marks—what’s his stays his!
 *
 *
 *   3. USE IT RIGHT OR LOSE IT
 *   You may not, and you may not let your fellow geeks:
 *   (a) hack, reverse engineer, decompile, decode, decrypt, disassemble, or attempt any sorcery to reveal the source code;
 *   (b) modify, remix, distribute, or create spinoffs of this masterpiece;
 *   (c) make copies (aside from your trusty backup), distribute, show off in public, transmit, sell, rent, lease, or otherwise
 *   exploit this software like it’s yours. Spoiler: it’s not!
 *
 *
 *   4. GAME OVER, MAN!
 *   This license is your golden ticket until one of us says otherwise. Want to end it? Smash the software and all its copies into
 *   digital dust. Break any rules? The license self-destructs, and you’ll need to nuke all copies—no second chances!
 *
 *
 *   5. NO PIXEL-PERFECT PROMISES
 *   Martin Mbithi and the Government Of Makueni DevSecOps Band don’t guarantee this software is glitch-free—think of it as a feature
 *   not a bug! We disclaim all other warranties, whether expressed or implied, including, but not limited to, implied warranties of merchantability
 *   fitness for a particular purpose, and non-infringement of third-party rights. Some jurisdictions have their own funky rules, so your mileage may
 *   vary. But remember: use at your own risk, brave user!
 *
 *
 *   6. KEEP THE PARTY GOING
 *   If a court zaps any part of this license, no worries—the rest of it keeps the party alive. One piece fails, but the agreement stands strong!
 *
 *
 *   7. NO DRAMA, NO DAMAGES
 *   Under no circumstances shall Martin Mbithi, the Government Of Makueni DevSecOps Band, or their minions be held responsible for any wild, indirect
 *   or accidental chaos from using this software—even if we warned you! And if you think you’ve got a claim, the most you’re getting is what you paid for the 
 *   license—if anything. Keep calm and code on!
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
        $_SESSION['user_phone'] = $row['user_phone'];
        $_SESSION['user_names'] = $row['user_names'];
        $_SESSION['success'] = 'Login successful';


        /* Log This Operation */
        $log_sql = "INSERT INTO logs (log_user_id, log_user_type, log_date, log_ip_address, log_device) 
        VALUES ('{$_SESSION['user_id']}', '{$_SESSION['user_access_level']}', NOW(), '{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['HTTP_USER_AGENT']}')";
        mysqli_query($mysqli, $log_sql);

        /* Global Check If This User Account Has Been Deactivated */
        if ($row['user_account_status'] == '0') {

            if ($row['user_change_password'] == '0') {

                /* Check If 2FA Is Enabled */
                $_SESSION['success'] = 'Logged in successfully';
                header('Location: dashboard');
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
    $reset_token = mysqli_real_escape_string($mysqli, $tk);
    $reset_url = $url . $reset_token;

    /* Check If This Account Exists */
    $staff_check_sql = "SELECT * FROM users WHERE user_email = '{$user_email}' AND user_account_status = '0'";
    $res = mysqli_query($mysqli, $staff_check_sql);
    if (mysqli_num_rows($res) > 0) {
        /*Persist Reset Token */
        $reset_token_sql = "UPDATE users SET user_password_reset_token = '{$reset_token}' WHERE user_email = '{$user_email}'";

        include('../mailers/reset_password.php');
        if (mysqli_query($mysqli, $reset_token_sql)) {
            $success = "Password reset instructions sent to your email";
        } else {
            $err = "Failed to reset account password, please try again later";
        }
    } else {
        $err = "Email does not exist";
    }
}


/* Reset Password Step 2 */
if (isset($_POST['Reset_Password_Step_2'])) {
    $reset_token = mysqli_real_escape_string($mysqli, $_GET['token']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($confirm_password != $new_password) {
        $err = "Failed, please try again";
    } else {

        /* Update staff password */
        $staff_check_sql = "SELECT * FROM users WHERE user_password_reset_token = '{$reset_token}'";
        $res = mysqli_query($mysqli, $staff_check_sql);
        if (mysqli_num_rows($res) > 0) {
            /* Update staff passwords */
            $update_password_sql = "UPDATE users SET user_password = '{$new_password}', user_password_reset_token = '' WHERE user_password_reset_token = '{$reset_token}'";
            if (mysqli_query($mysqli, $update_password_sql)) {
                $_SESSION['success'] = "Password reset successful, proceed to login";
                header('Location: login');
                exit;
            } else {
                $err = "Failed, please try again later";
            }
        }
    }
}


/* Register Supplier */
if (isset($_POST['Register'])) {
    $user_names = mysqli_real_escape_string($mysqli, $_POST['user_names']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_phone = mysqli_real_escape_string($mysqli, $_POST['user_phone']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));
    $user_access_level = 'Supplier';
    $user_director_names = mysqli_real_escape_string($mysqli, $_POST['user_director_names']);
    $user_postal_address = mysqli_real_escape_string($mysqli, $_POST['user_postal_address']);
    $user_county = mysqli_real_escape_string($mysqli, $_POST['user_county']);
    $user_ward = mysqli_real_escape_string($mysqli, $_POST['user_ward']);
    $user_town = mysqli_real_escape_string($mysqli, $_POST['user_town']);

    /* Check If Passwords Match */
    if ($confirm_password != $new_password) {
        $err = "Failed, please try again";
    } else {
        /* Check If This Account Exists */
        $staff_check_sql = "SELECT * FROM users WHERE user_email = '{$user_email}'";
        $res = mysqli_query($mysqli, $staff_check_sql);
        if (mysqli_num_rows($res) > 0) {
            $err = "Email already exists";
        } else {
            /*Persist Supplier */
            $register_sql = "INSERT INTO users (user_names, user_email, user_phone, user_password, user_access_level, user_change_password, user_director_names,
            user_postal_address, user_county, user_ward, user_town) 
            VALUES ('{$user_names}', '{$user_email}', '{$user_phone}', '{$new_password}', '{$user_access_level}', '0', '{$user_director_names}', '{$user_postal_address}', 
            '{$user_county}', '{$user_ward}', '{$user_town}')";
            if (mysqli_query($mysqli, $register_sql)) {
                /* Alert And Login The User */
                include('../mailers/register_supplier.php');
                $_SESSION['success'] = 'Account created successfully, proceed to login';
                header('Location: login');
                exit;
            } else {
                $err = "Failed to create account, please try again later";
            }
        }
    }
}
