<?php
include('../userRegister/authentication.php');
include("../home/header.php");
include_once('../userRegister/reservationCheckup.php');

?>



<div class="container py-5">
    <h1 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo isset($msg) ? $msg : "";
            ?>
        </div>

        <?php
        $timeslots = timeslots($duration, $cleanup, $start, $end);
        foreach ($timeslots as $ts) {
        ?>
            <div class="col-md-4 col-sm-12 text-center g-4 ">
                <div class="form-group">
                    <?php if (in_array($ts, $bookings)) { ?>
                        <button class="btn btn-danger  px-3 mb-sm-2"><?php echo $ts; ?></button>
                    <?php } else { ?>
                        <button class="btn btn-success  px-3 book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>

                    <?php } ?>
                    <button class="btn btn-success  px-3 book mt-lg-2 " data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>

                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="modal bd-example-modal-lg fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable ">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(4, 4, 132);">
                <h4 class="modal-title text-light">Booking</h4>
                <span class="text-light"><?php echo date('m/d/Y', strtotime($date)); ?></span>
            </div>
            <div class="modal-body ">
                <div class="form-message text-white p-1 bg-danger rounded text-center w-100 text-uppercase" style="letter-spacing:2px; display:none">

                </div>

                <form action="" method="POST" id="book-form">
                    <div class="mb-3">
                        <label for="">Timeslot:</label>
                        <input required type="text" name="timeslot" id="timeslot" readonly class="border-0 p-2  rounded text-white" style="background-color:#F9B900;">
                    </div>
                    <div class="row row-cols-2">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">First Name:</label>
                            <?php if (isset($_GET['firstName'])) { ?>
                                <input type="text" name="firstName" placeholder="First Name" class="form-control" value="<?php echo $_GET['firstName']; ?>">
                            <?php } else { ?>
                                <input type="text" name="firstName" placeholder="First Name" class="form-control" required id="firstName">
                            <?php } ?>
                            <small class="text-danger firstName"></small>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Middle Name:</label>
                            <?php if (isset($_GET['middleName'])) { ?>
                                <input type="text" name="middleName" placeholder="Middle Name" class="form-control" value="<?php echo $_GET['middleName']; ?>">
                            <?php } else { ?>
                                <input type="text" name="middleName" placeholder="Middle Name" class="form-control" required id="middleName">
                            <?php } ?>
                            <small class="text-danger middleName"></small>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Last Name:</label>
                            <?php if (isset($_GET['lastName'])) { ?>
                                <input type="text" name="lastName" placeholder="Last Name" class="form-control" value="<?php echo $_GET['lastName']; ?>">
                            <?php } else { ?>
                                <input type="text" name="lastName" placeholder="Last Name" class="form-control" required id="lastName">
                            <?php } ?>
                            <small class="text-danger lastName"></small>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <?php if (isset($_GET['email'])) { ?>
                                <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $_GET['email']; ?>">
                            <?php } else { ?>
                                <input type="text" name="email" placeholder="Email" class="form-control" required id="email">
                            <?php } ?>
                            <small class="text-danger email"></small>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Contact Number:</label>
                            <?php if (isset($_GET['contactNumber'])) { ?>
                                <input type="text" name="contactNumber" placeholder="Phone Number" class="form-control" value="<?php echo $_GET['contactNumber']; ?>">
                            <?php } else { ?>
                                <input type="text" name="contactNumber" placeholder="Phone Number" class="form-control" required id="contactNumber">
                            <?php } ?>
                            <small class="text-danger contactNumber"></small>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Work:</label>
                            <?php if (isset($_GET['work'])) { ?>
                                <input type="text" name="work" placeholder="Work / Profession" class="form-control" value="<?php echo $_GET['work']; ?>">
                            <?php } else { ?>
                                <input type="text" name="work" placeholder="Work / Profesion" class="form-control" required id="work">
                            <?php } ?>
                            <small class="text-danger work"></small>
                        </div>

                    </div>

                    <!-- Ticket Selection -->
                    <div class="ticket-container">
                        <div class="title text-white p-2 rounded text-center text-uppercase mb-4" style="background-color: rgb(4, 4, 132);">
                            <h5>Select A Ticket Category</h5>
                        </div>
                        <small class="text-danger checkbox"></small>
                        <div class="ticket-selection">
                            <div class="row gy-4">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="category-container align-items-center d-flex justify-content-center flex-column border border-primary h-100">
                                        <p class="text-center text-white border-0 p-2 rounded" style="background-color: #F9B900;">Category 1</p>
                                        <p class="p-2">Paper Presenter-Undergraduate, Graduate Study (First Author only)</p>
                                        <div class="input-group-text">
                                            <span class="me-2">$</span><span class="me-2" name="price">90</span>
                                            <input class="form-check-input mt-0 ticket-checkbox" type="checkbox" value="category1" name="category" aria-label="Checkbox for following text input" id="category">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="category-container align-items-center d-flex justify-content-center flex-column border border-primary h-100">
                                        <p class="text-center text-white border-0 p-2 rounded" style="background-color: #F9B900;">Category 2</p>
                                        <p class="p-2">Audience for 2nd authors in the professional and undergraduate</p>
                                        <div class="input-group-text">
                                            <span class="me-2">$</span><span class="me-2" name="price">65</span>
                                            <input class="form-check-input mt-0 ticket-checkbox" type="checkbox" value="category2" name="category" aria-label="Checkbox for following text input" id="category">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="category-container align-items-center d-flex justify-content-center flex-column border border-primary h-100">
                                        <p class="text-center text-white border-0 p-2 rounded" style="background-color: #F9B900;">Category 3</p>
                                        <p class="p-2">Audience for College student and Senior High School student</p>
                                        <div class="input-group-text">
                                            <span class="me-2">$</span><span class="me-2" name="price">20</span>
                                            <input class="form-check-input mt-0 ticket-checkbox" type="checkbox" value="category3" name="category" aria-label="Checkbox for following text input" id="category">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="category-container align-items-center d-flex justify-content-center flex-column border border-primary h-100">
                                        <p class="text-center text-white border-0 p-2 rounded" style="background-color: #F9B900;">Category 4</p>
                                        <p class="p-2">Certificate of Request for unattended co-author</p>
                                        <div class="input-group-text">
                                            <span class="me-2">$</span><span class="me-2" name="price">20</span>
                                            <input class="form-check-input mt-0 ticket-checkbox" type="checkbox" value="category4" name="category" aria-label="Checkbox for following text input" id="category">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h5>Total Price: $ <span id="totalPrice">0</span></h5>
                        </div>
                    </div>


                    <div class="title text-white p-2 rounded text-center text-uppercase mb-4 mt-4" style="background-color: rgb(4, 4, 132);">
                        <h5>Payment Method</h5>
                    </div>
                    <div class="container d-flex flex-column align-items-center justify-content-center" >
                        <!-- Set up a container element for the button -->
                        <div id="paypal-button-container" class="w-100">

                            <!-- JQeury -->
                            <script src="https:code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

                            <!-- Paypal -->
                            <!-- Replace "test" with your own sandbox Business account app client ID -->
                            <script src="https://www.paypal.com/sdk/js?client-id=AVMyoS5A6PVeas7qZdpUqIBVsPQ4hRIm0zlrjZU9Qa7kB1dc6pwwORHZInngZUoSTr2Utrelld4Hs2So&currency=USD"></script>

                            <script>
                                // Render the PayPal button when the page loads
                                $(document).ready(function() {
                                    paypal.Buttons({
                                        onClick: function() {
                                            var firstName = $('#firstName').val();
                                            var middleName = $('#middleName').val();
                                            var lastName = $('#lastName').val();
                                            var email = $('#email').val();
                                            var contactNumber = $('#contactNumber').val();
                                            var work = $('#work').val();

                                            if (firstName.length === 0) {
                                                $('.firstName').text("This field is required");
                                            } else {
                                                $('.firstName').text("");
                                            }
                                            if (middleName.length === 0) {
                                                $('.middleName').text("This field is required");
                                            } else {
                                                $('.middleName').text("");
                                            }
                                            if (lastName.length === 0) {
                                                $('.lastName').text("This field is required");
                                            } else {
                                                $('.lastName').text("");
                                            }
                                            if (email.length === 0) {
                                                $('.email').text("This field is required");
                                            } else {
                                                $('.email').text("");
                                            }
                                            if (contactNumber.length === 0) {
                                                $('.contactNumber').text("This field is required");
                                            } else {
                                                $('.contactNumber').text("");
                                            }
                                            if (work.length === 0) {
                                                $('.work').text("This field is required");
                                            } else {
                                                $('.work').text("");
                                            }

                                            if (firstName.length == 0 || middleName.length == 0 || lastName.length == 0 || email.length == 0 || contactNumber.length == 0 || work.length == 0) {
                                                return false;
                                            }

                                            // Check other input fields if needed

                                            // Proceed with PayPal flow if all fields are valid
                                        },
                                        createOrder: function(data, actions) {
                                            // Get the current total price
                                            const totalPriceElement = document.getElementById('totalPrice');
                                            const totalPrice = parseFloat(totalPriceElement.innerText);

                                            return actions.order.create({
                                                purchase_units: [{
                                                    amount: {
                                                        value: totalPrice.toFixed(2)
                                                    }
                                                }]
                                            });
                                        },
                                        // Finalize the transaction after payment approval
                                        onApprove: function(data) {
                                            return fetch("/my-server/capture-paypal-order", {
                                                    method: "POST",
                                                    headers: {
                                                        "Content-Type": "application/json",
                                                    },
                                                    body: JSON.stringify({
                                                        orderID: data.orderID,
                                                    }),
                                                })
                                                .then((response) => response.json())
                                                .then((orderData) => {
                                                    // Successful capture! For dev/demo purposes:
                                                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                                                    const transaction = orderData.purchase_units[0].payments.captures[0];
                                                    alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                                                    // When ready to go live, remove the alert and show a success message within this page. For example:
                                                    // const element = document.getElementById('paypal-button-container');
                                                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                                                    // Or go to another URL:  window.location.href = 'thank_you.html';
                                                });
                                        }
                                    }).render('#paypal-button-container');
                                });
                            </script>

                        </div>
                        <div class="gcash w-100">
                        <button type="button" class="btn btn-primary w-100 rounded p-2" id="gcashButton">GCash</button>
                        </div>
                    </div>



            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>

            </div>


        </div>

        </form>
    </div>
</div>
</div>


<script src="https:ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https:maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



<script>
    $(".book").click(function() {
        var timeslot = $(this).attr('data-timeslot');
        $('#slot').html(timeslot);
        $('#timeslot').val(timeslot);
        $('#myModal').modal("show");
    })
    $(document).ready(function() {
        $('#book.form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'reservationCheckup.php',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {
                    $('.form-message').html('<p>' + response.message + '</p>').css('display', 'block');



                }
            });
        });
    });

    $('.ticket-checkbox').change(function() {
        if ($(this).is(':checked')) {
            $('.ticket-checkbox').not(this).prop('disabled', true);
            $('.ticket-checkbox').not(this).prop('checked', false);
        } else {
            $('.ticket-checkbox').prop('disabled', false);
        }

        var category = $('input[name="category"]:checked').val();
        console.log(category);
    });
</script>

<script>
    // Get all the checkbox elements
    const checkboxes = document.querySelectorAll('.ticket-checkbox');

    // Add event listener to each checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Get the price element associated with the checkbox
            const priceElement = this.parentNode.querySelector('[name="price"]');

            // Get the current total price
            const totalPriceElement = document.getElementById('totalPrice');
            let totalPrice = parseFloat(totalPriceElement.innerText);

            // Update the total price based on checkbox state
            if (this.checked) {
                totalPrice += parseFloat(priceElement.innerText);
            } else {
                totalPrice -= parseFloat(priceElement.innerText);
            }

            // Update the total price element
            totalPriceElement.innerText = totalPrice.toFixed(2);
        });
    });
</script>






<?php
include "../home/footer.php";
?>