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
                    <?php
                    $users_sql = mysqli_query(
                        $mysqli,
                        "SELECT * FROM users WHERE user_id = '{$user_id}'"
                    );
                    if (mysqli_num_rows($users_sql) > 0) {
                        while ($user_detail = mysqli_fetch_array($users_sql)) { ?>
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="nav-align-top mb-4">
                                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                                <li class="nav-item">
                                                    <button
                                                        type="button"
                                                        class="nav-link active"
                                                        role="tab"
                                                        data-bs-toggle="tab"
                                                        data-bs-target="#navs-justified-home"
                                                        aria-controls="navs-justified-home"
                                                        aria-selected="true">
                                                        <i class="tf-icons bx bx-user"></i> Personal Details
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button
                                                        type="button"
                                                        class="nav-link"
                                                        role="tab"
                                                        data-bs-toggle="tab"
                                                        data-bs-target="#navs-justified-profile"
                                                        aria-controls="navs-justified-profile"
                                                        aria-selected="false">
                                                        <i class="tf-icons bx bx-lock"></i> Authentication Details
                                                    </button>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                                                    <form method="POST">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label for="firstName" class="form-label">Full Names</label>
                                                                <input
                                                                    class="form-control"
                                                                    type="text"
                                                                    name="user_names"
                                                                    value="<?php echo $user_detail['user_names']; ?>"
                                                                    autofocus />
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label for="email" class="form-label">E-mail</label>
                                                                <input
                                                                    class="form-control"
                                                                    type="text"
                                                                    id="email"
                                                                    name="user_email"
                                                                    value="<?php echo $user_detail['user_email']; ?>" />
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label for="organization" class="form-label">Phone number</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="user_phone"
                                                                    value="<?php echo $user_detail['user_phone']; ?>" />
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label for="address" class="form-label">Designation</label>
                                                                <input type="text" readonly class="form-control" id="address" name="user_designation" value="<?php echo $user_detail['user_designation']; ?>" />
                                                                <input type="hidden" class="form-control" id="address" name="user_access_level" value="<?php echo $user_detail['user_access_level']; ?>" />
                                                                <input type="hidden" class="form-control" id="address" name="user_id" value="<?php echo $user_detail['user_id']; ?>" />

                                                            </div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <button type="submit" name="Update_User" class="btn btn-primary me-2">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                                                    <form method="POST">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label for="organization" class="form-label">New Password</label>
                                                                <input
                                                                    type="password"
                                                                    class="form-control"
                                                                    name="new_password" />
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label for="address" class="form-label">Confirm Password</label>
                                                                <input type="password" class="form-control" id="address" name="confirm_password" />
                                                                <input type="hidden" class="form-control" id="address" name="user_id" value="<?php echo $user_detail['user_id']; ?>" />

                                                            </div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <button type="submit" name="Change_Password" class="btn btn-primary me-2">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
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
    <!-- / Layout wrapper -->

    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>