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

$services = mysqli_query(
    $mysqli,
    "SELECT * FROM appointments a 
    INNER JOIN medical_services s ON s.service_id = a.appointment_service_id 
    INNER JOIN users u ON u.user_id = a.appointment_user_id"
);
if (mysqli_num_rows($services) > 0) {
    while ($appointments = mysqli_fetch_array($services)) {
?>
        <div class="modal fade" id="edit_<?php echo $appointments['appointment_id']; ?>" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">Update Appointment</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="lastName" class="form-labe">Date</label>
                                <input class="form-control" type="date" name="appointment_date" value="<?php echo $appointments['appointment_date']; ?>" id="lastName" />
                                <input class="form-control" type="hidden" name="appointment_id" value="<?php echo $appointments['appointment_id']; ?>" id="lastName" />
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="lastName" class="form-labe">Appointment details</label>
                                <textarea class="form-control" rows="5" type="text" name="appointment_more_details" id="lastName"><?php echo $appointments['appointment_more_details']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" name="Update_Appointment" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Delete -->
        <div class="modal fade" id="delete_<?php echo $appointments['appointment_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-body text-center text-danger">
                            <img src='../public/img/icons/bin-file.gif' height="80px"><br>
                            <h4>Heads Up! <br>
                                You are about to delete this medical appointment, proceed and delete?
                            </h4>
                            <input class="form-control" type="hidden" name="appointment_id" value="<?php echo $appointments['appointment_id']; ?>" id="lastName" />
                            <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No, Dismiss </button>
                            <input type="submit" name="Delete_Appointments" value="Yes, Delete" class="text-center btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cancel Appointment -->
        <div class="modal fade" id="cancel_<?php echo $appointments['appointment_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-body text-center text-danger">
                            <img src='../public/img/icons/cancel.png' height="80px"><br>
                            <h4>Heads Up! <br>
                                You are about to cancel this medical appointment, proceed and delete?
                            </h4>
                            <input class="form-control" type="hidden" name="appointment_id" value="<?php echo $appointments['appointment_id']; ?>" id="lastName" />
                            <input class="form-control" type="hidden" name="appointment_status" value="Cancelled" id="lastName" />
                            <button type="button" class="text-center btn btn-success" data-bs-dismiss="modal">No, Dismiss </button>
                            <input type="submit" name="Update_Appointments_Status" value="Yes, Cancel" class="text-center btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Approve Appointment -->
        <div class="modal fade" id="approve_<?php echo $appointments['appointment_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-body text-center text-danger">
                            <img src='../public/img/icons/approve.png' height="80px"><br>
                            <h4>Heads Up! <br>
                                You are about to approve this medical appointment, proceed and delete?
                            </h4>
                            <input class="form-control" type="hidden" name="appointment_id" value="<?php echo $appointments['appointment_id']; ?>" id="lastName" />
                            <input class="form-control" type="hidden" name="appointment_status" value="Approved" id="lastName" />
                            <button type="button" class="text-center btn btn-danger" data-bs-dismiss="modal">No, Dismiss </button>
                            <input type="submit" name="Update_Appointments_Status" value="Yes, Approve" class="text-center btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Give Feedback -->
        <div class="modal fade" id="feedback_<?php echo $appointments['appointment_id']; ?>" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">Give Feedback</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="lastName" class="form-labe">Title</label>
                                <input class="form-control" type="text" name="feedback_title"  id="lastName" />
                                <input class="form-control" type="hidden" name="feedback_user_id" value="<?php echo $appointments['appointment_user_id']; ?>" id="lastName" />
                                <input class="form-control" type="hidden" name="feedback_service_id" value="<?php echo $appointments['appointment_service_id']; ?>" id="lastName" />
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="lastName" class="form-labe">Feedback details</label>
                                <textarea class="form-control" rows="5" type="text" name="feedback_details" id="lastName"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" name="Add_Feedbacks" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

<?php }
} ?>