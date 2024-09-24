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
require_once('../helpers/users.php');
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

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">System Users /</span> Administrators
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_user" href="javascript:void(0);">Add New Administrator</a>
                            </div>
                        </h4>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <h5 class="card-header text-center">Manage System Admins</h5>
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table data_table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Contacts</th>
                                                        <th>Designation</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php
                                                    $user_sql = mysqli_query(
                                                        $mysqli,
                                                        "SELECT * FROM  users WHERE user_access_level = 'System Administrator'"
                                                    );
                                                    $cnt = 1;
                                                    if (mysqli_num_rows($user_sql) > 0) {
                                                        while ($user = mysqli_fetch_array($user_sql)) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $cnt; ?></td>
                                                                <td><?php echo $user['user_names']; ?></td>
                                                                <td><?php echo $user['user_email']; ?></td>
                                                                <td><?php echo $user['user_phone']; ?></td>
                                                                <td><?php echo $user['user_designation']; ?></td>
                                                                <td>
                                                                    <a class="badge bg-label-primary" data-bs-toggle="modal" data-bs-target="#edit_<?php echo $user['user_id']; ?>" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                                    <a class="badge bg-label-danger" data-bs-toggle="modal" data-bs-target="#delete_<?php echo $user['user_id']; ?>" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
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
    <!-- Add Modal -->
    <div class="modal fade" id="add_user" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Register New Administrator</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="firstName" class="form-labe">Full Names</label>
                            <input
                                class="form-control"
                                type="text"
                                name="user_names"
                                autofocus />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="email" class="form-labe">E-mail</label>
                            <input
                                class="form-control"
                                type="text"
                                id="email"
                                name="user_email" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="organization" class="form-labe">Phone number</label>
                            <input
                                type="text"
                                class="form-control"
                                name="user_phone" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="address" class="form-labe">Password <small class="text-danger">Users will be prompted to change this password on login</small></label>
                            <input type="text" readonly value="Staff@1234" class="form-control" id="address" name="user_password" />
                            <input type="hidden" value="System Administrator" class="form-control" id="address" name="user_designation" />
                            <input type="hidden" class="form-control" id="address" name="user_access_level" value="System Administrator" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" name="Register_User" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal -->
    <!-- / Layout wrapper -->
    <?php include('../modals/users.php'); ?>

    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>