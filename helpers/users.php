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


/* Add Users */
if (isset($_POST['Add_Users'])) {
    $user_names = mysqli_real_escape_string($mysqli, $_POST['user_names']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, 'Makueni102')));
    $user_phone = mysqli_real_escape_string($mysqli, $_POST['user_phone']);
    $user_designation = mysqli_real_escape_string($mysqli, $_POST['user_designation']);
    $user_access_level = mysqli_real_escape_string($mysqli, $_POST['user_access_level']);


    /* Prevent Duplications */
    $prevent_duplications = "SELECT * FROM users WHERE user_email = '{$user_email}'";
    $res = mysqli_query($mysqli, $prevent_duplications);
    if (mysqli_num_rows($res) > 0) {
        $err = "Email address exists";
    } else {
        /* Persist */
        $add_user_sql = "INSERT INTO users (user_names, user_email, user_password, user_phone, user_access_level, user_designation)
        VALUES('{$user_names}', '{$user_email}', '{$user_password}', '{$user_phone}', '{$user_access_level}', '{$user_designation}')";

        /* Welcome Mailer */
        include('../mailers/staff_welcome.php');

        if (mysqli_query($mysqli, $add_user_sql)) {
            $success = "Account created";
        } else {
            $err = "Failed, please try again";
        }
    }
}

/* Update Users */
if (isset($_POST['Update_Users'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $user_names  = mysqli_real_escape_string($mysqli, $_POST['user_names']);
    $user_phone = mysqli_real_escape_string($mysqli, $_POST['user_phone']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $user_access_level = mysqli_real_escape_string($mysqli, $_POST['user_access_level']);
    $user_designation = mysqli_real_escape_string($mysqli, $_POST['user_designation']);

    if ($user_access_level == 'Supplier') {
        /* Capture Additional Fields */
        $user_director_names  = mysqli_real_escape_string($mysqli, $_POST['user_director_names']);
        $user_postal_address = mysqli_real_escape_string($mysqli, $_POST['user_postal_address']);
        $user_county = mysqli_real_escape_string($mysqli, $_POST['user_county']);
        $user_ward =  mysqli_real_escape_string($mysqli, $_POST['user_ward']);
        $user_town = mysqli_real_escape_string($mysqli, $_POST['user_town']);

        /* Persist Update */
        $update_users_sql = "UPDATE users SET user_names = '{$user_names}', user_phone = '{$user_phone}', user_email = '{$user_email}', 
        user_access_level = '{$user_access_level}', user_director_names = '{$user_director_names}', user_postal_address = '{$user_postal_address}',
        user_county = '{$user_county}', user_ward = '{$user_ward}', user_town = '{$user_town}' WHERE user_id = '{$user_id}'";

        if (mysqli_query($mysqli, $update_users_sql)) {
            $success = "Profile details updated";
        } else {
            $err = "Failed, please try again";
        }
    } else {

        /* Persist Update */
        $update_users_sql = "UPDATE users SET user_names = '{$user_names}', user_phone = '{$user_phone}', user_email = '{$user_email}', 
        user_access_level = '{$user_access_level}', user_designation = '{$user_designation}' WHERE user_id = '{$user_id}'";

        if (mysqli_query($mysqli, $update_users_sql)) {
            $success = "Personal details updated";
        } else {
            $err = "Failed, please try again";
        }
    }
}

/* Delete */
if (isset($_POST['Delete_Users'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);

    /* Persist */
    $delete_users = "DELETE FROM users WHERE user_id = '{$user_id}'";

    if (mysqli_query($mysqli, $delete_users)) {
        $success = "Details deleted";
    } else {
        $err = "Failed, please try again";
    }
}


/* Change Password */
if (isset($_POST['Change_Password'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check Passwords If They Match */
    if ($confirm_password != $new_password) {
        $err = "Passwords does not match";
    } else {
        /* Persist */
        $update_password_sql = "UPDATE users SET user_password = '{$new_password}' WHERE user_id  = '{$user_id}'";

        if (mysqli_query($mysqli, $update_password_sql)) {
            $success = "Password updated";
        } else {
            $err = "Failed, please try again";
        }
    }
}


/* Deactivate User Account */
if (isset($_POST['DeactivateAccount'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);

    if (mysqli_query(
        $mysqli,
        "UPDATE users SET user_account_status = '1' WHERE user_id = '{$user_id}'"
    )) {
        $success = "User account has been deactivated";
    } else {
        $err = "Failed, please try again";
    }
}

/* Activate Account */
if (isset($_POST['ActivateAccount'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);

    if (mysqli_query(
        $mysqli,
        "UPDATE users SET user_account_status = '0' WHERE user_id = '{$user_id}'"
    )) {
        $success = "User account has been re-activated";
    } else {
        $err = "Failed, please try again";
    }
}


/* Force User Password Reset */
if (isset($_POST['ForceResetPassword'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $user_email = mysqli_real_escape_string($mysqli, $_POST['user_email']);
    $defalt_password = sha1(md5(mysqli_real_escape_string($mysqli, 'Makueni102')));

    /* Force Password Reset */
    if (
        mysqli_query(
            $mysqli,
            "UPDATE users SET user_password = '{$defalt_password}', user_change_password = '1' WHERE user_id = '{$user_id}'"
        )
    ) {
        /* Password Reset Email Notification */
        include('../mailers/force_password_reset.php');

        $success = "Password reset";
    } else {
        $err = "Failed, please try again";
    }
}


/* Assign Commitee Member Categories */
if (isset($_POST['Assign_Category'])) {
    $category_user_id = mysqli_real_escape_string($mysqli, $_POST['category_user_id']);
    $category_category_id = mysqli_real_escape_string($mysqli, $_POST['category_category_id']);

    /* Prevent Duplications */
    $prevent_duplications = "SELECT * FROM assigned_categories WHERE category_user_id = '{$category_user_id}' AND category_category_id = '{$category_category_id}'";
    $res = mysqli_query($mysqli, $prevent_duplications);
    if (mysqli_num_rows($res) > 0) {
        $err = "Commitee member already assigned this category";
    } else {
        /* Do the actual assignments */
        if (mysqli_query(
            $mysqli,
            "INSERT INTO assigned_categories (category_user_id, category_category_id) VALUES('{$category_user_id}', '{$category_category_id}')"
        )) {
            $success = "Category assigned";
        } else {
            $err = "Failed, please try again";
        }
    }
}


/* Remove Assignments */
if (isset($_POST['RemoveAssignments'])) {
    $category_id = mysqli_real_escape_string($mysqli, $_POST['category_id']);

    /* Persist */
    if (mysqli_query(
        $mysqli,
        "DELETE FROM assigned_categories WHERE  category_id  = '{$category_id}'"
    )) {
        $success = "Assignment removed";
    } else {
        $err = "Failed, please try again";
    }
}
