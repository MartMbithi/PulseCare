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
session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../helpers/appointments.php');
require_once('../partials/head.php');
?>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php require_once('../partials/aside.php'); ?>

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php require_once('../partials/navbar.php'); ?>
                <!-- / Navbar -->
                <?php if ($_SESSION['user_access_level'] != 'Patient') { ?>
                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <h4 class="fw-bold py-3 mb-4">
                                <span class="text-muted fw-light">Medical Appointments /</span> Manage
                            </h4>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card mb-4">
                                        <h5 class="card-header text-center">Manage Medical Appointments</h5>
                                        <hr class="my-0" />
                                        <div class="card-body">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table data_table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Medical Service</th>
                                                            <th>Patient Name</th>
                                                            <th>Appointment Date</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        <?php
                                                        $services = mysqli_query(
                                                            $mysqli,
                                                            "SELECT * FROM appointments a 
                                                        INNER JOIN medical_services s ON s.service_id = a.appointment_service_id 
                                                        INNER JOIN users u ON u.user_id = a.appointment_user_id"
                                                        );
                                                        $cnt = 1;
                                                        if (mysqli_num_rows($services) > 0) {
                                                            while ($appointments = mysqli_fetch_array($services)) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $cnt; ?></td>
                                                                    <td><?php echo $appointments['service_name']; ?></td>
                                                                    <td><?php echo $appointments['user_names']; ?></td>
                                                                    <td><?php echo $appointments['appointment_date']; ?></td>
                                                                    <th><?php echo $appointments['appointment_status']; ?></th>
                                                                    <td>
                                                                        <?php
                                                                        if ($user_access_level == 'System Administrator') {
                                                                            if ($appointments['appointment_status'] == 'Pending') { ?>
                                                                                <a class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#approve_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-calendar-check me-1"></i>Approve</a>
                                                                                <a class="badge bg-label-warning" data-bs-toggle="modal" data-bs-target="#cancel_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-calendar-x me-1"></i>Cancel</a>
                                                                                <a class="badge bg-label-primary" data-bs-toggle="modal" data-bs-target="#edit_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                                <a class="badge bg-label-danger" data-bs-toggle="modal" data-bs-target="#delete_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                            <?php } else if ($appointments['appointment_status'] == 'Approved') { ?>
                                                                                <a class="badge bg-label-primary" data-bs-toggle="modal" data-bs-target="#feedback_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-chat me-1"></i>Give Feedback</a>
                                                                            <?php } else { ?>
                                                                                <a class="badge bg-label-danger" data-bs-toggle="modal" data-bs-target="#delete_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                            <?php }
                                                                        } else {
                                                                            if ($appointments['appointment_status'] == 'Pending') { ?>
                                                                                <a class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#approve_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-calendar-check me-1"></i>Approve</a>
                                                                                <a class="badge bg-label-warning" data-bs-toggle="modal" data-bs-target="#cancel_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-calendar-x me-1"></i>Cancel</a>
                                                                                <a class="badge bg-label-primary" data-bs-toggle="modal" data-bs-target="#edit_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                            <?php } else { ?>
                                                                                <a class="badge bg-label-danger" data-bs-toggle="modal" data-bs-target="#delete_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                        <?php }
                                                                        } ?>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                                $cnt = $cnt + 1;
                                                            }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <h4 class="fw-bold py-3 mb-4">
                                <span class="text-muted fw-light">Medical Appointments /</span> Manage
                            </h4>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card mb-4">
                                        <h5 class="card-header text-center">Manage My Medical Appointments</h5>
                                        <hr class="my-0" />
                                        <div class="card-body">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table data_table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Medical Service</th>
                                                            <th>Patient Name</th>
                                                            <th>Appointment Date</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        <?php
                                                        $services = mysqli_query(
                                                            $mysqli,
                                                            "SELECT * FROM appointments a 
                                                        INNER JOIN medical_services s ON s.service_id = a.appointment_service_id 
                                                        INNER JOIN users u ON u.user_id = a.appointment_user_id
                                                        WHERE u.user_id = '{$user_id}'"
                                                        );
                                                        $cnt = 1;
                                                        if (mysqli_num_rows($services) > 0) {
                                                            while ($appointments = mysqli_fetch_array($services)) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $cnt; ?></td>
                                                                    <td><?php echo $appointments['service_name']; ?></td>
                                                                    <td><?php echo $appointments['user_names']; ?></td>
                                                                    <td><?php echo $appointments['appointment_date']; ?></td>
                                                                    <th><?php echo $appointments['appointment_status']; ?></th>
                                                                    <td>
                                                                        <?php
                                                                        if ($appointments['appointment_status'] == 'Pending') { ?>
                                                                            <a class="badge bg-label-warning" data-bs-toggle="modal" data-bs-target="#cancel_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-calendar-x me-1"></i>Cancel</a>
                                                                            <a class="badge bg-label-primary" data-bs-toggle="modal" data-bs-target="#edit_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                            <a class="badge bg-label-danger" data-bs-toggle="modal" data-bs-target="#delete_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                                                        <?php } else if ($appointments['appointment_status'] == 'Approved') { ?>
                                                                            <a class="badge bg-label-primary" data-bs-toggle="modal" data-bs-target="#feedback_<?php echo $appointments['appointment_id']; ?>" href="javascript:void(0);"><i class="bx bx-chat me-1"></i>Give Feedback</a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                                $cnt = $cnt + 1;
                                                            }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Footer -->
                <?php require_once('../partials/footer.php'); ?>
                <!-- / Footer -->
                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <?php include('../modals/appointments.php'); ?>

    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>