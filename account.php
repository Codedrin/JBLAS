<?php
include("session_data.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>


  <!-- Stylesheet -->
  <link rel="stylesheet" href="style.css">
  <!-- bootstrap link--->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Font Awesome Kit -->
  <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #F3BB83;
    }

    .user-card-full {
      overflow: hidden;
    }

    .card {
      border-radius: 5px;
      -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
      box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
      border: none;
      margin-bottom: 30px;
    }

    .m-r-0 {
      margin-right: 0px;
    }

    .m-l-0 {
      margin-left: 0px;
    }

    .user-card-full .user-profile {
      border-radius: 5px 0 0 5px;
    }

    .bg-c-lite-green {
      background: black;
    }

    .user-profile {
      padding: 20px 0;
    }

    .card-block {
      padding: 1.25rem;
    }

    .m-b-25 {
      margin-bottom: 25px;
    }

    .img-radius {
      border-radius: 5px;
    }



    h6 {
      font-size: 14px;
    }

    .card .card-block p {
      line-height: 25px;
    }

    @media only screen and (min-width: 1400px) {
      p {
        font-size: 14px;
      }
    }

    .card-block {
      padding: 1.25rem;
    }

    .b-b-default {
      border-bottom: 1px solid #e0e0e0;
    }

    .m-b-20 {
      margin-bottom: 20px;
    }

    .p-b-5 {
      padding-bottom: 5px !important;
    }

    .card .card-block p {
      line-height: 25px;
    }

    .m-b-10 {
      margin-bottom: 10px;
    }

    .text-muted {
      color: #919aa3 !important;
    }

    .b-b-default {
      border-bottom: 1px solid #e0e0e0;
    }

    .f-w-600 {
      font-weight: 600;
    }

    .m-b-20 {
      margin-bottom: 20px;
    }

    .m-t-40 {
      margin-top: 20px;
    }

    .p-b-5 {
      padding-bottom: 5px !important;
    }

    .m-b-10 {
      margin-bottom: 10px;
    }

    .m-t-40 {
      margin-top: 20px;
    }

    .user-card-full .social-link li {
      display: inline-block;
    }

    .user-card-full .social-link li a {
      font-size: 20px;
      margin: 0 10px 0 0;
      -webkit-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
    }
    body{
      background-image: url(images/payment_background.png );
      background-repeat: no-repeat;
      background-size: cover;

    }
  </style>
  <script>
    function confirmLogout() {
      var modal = new bootstrap.Modal(document.getElementById('logoutModal'), {
        backdrop: 'static',
        keyboard: false
      });

      modal.show();
    }
  </script>
</head>

<body>
  <?php include('navbarProfile.php'); ?>


  <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-xl-10 col-md-12">
          <div class="card user-card-full">
            <div class="row m-l-0 m-r-0">
              <div class="col-sm-4 bg-c-lite-green user-profile">
                <div class="card-block text-center text-white">
                  <div class="m-b-25">
                    <i class="fas fa-user-circle fa-2x" ></i>
                  </div>
                  <h6 class="f-w-600"><?php echo $clientData['first_name'] . ' ' . $clientData['last_name']; ?></h6>
                  <p><?php echo $clientData['username']; ?></p>

                  <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                  <br>
                  <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Account Information</h6>
                  <div class="col">
                    <p class="m-b-10 f-w-600">Account ID</p>
                    <h6 class="text-muted f-w-400"><?php echo $clientData['user_id']; ?></h6>
                  </div>
                  <div class="row">
                    <div class="col">
                      <p class="m-b-10 f-w-600">Email</p>
                      <h6 class="text-muted f-w-400"><?php echo $clientData['email']; ?></h6>
                    </div>
                    <div class="col">
                      <p class="m-b-10 f-w-600">Phone</p>
                      <h6 class="text-muted f-w-400"><?php echo $clientData['mobile_number']; ?></h6>

                    </div>
                    <div class="">
                      <p class="m-b-10 f-w-600">Gender</p>
                      <h6 class="text-muted f-w-400"><?php echo $clientData['gender']; ?></h6>
                    </div>
                  </div>
                  <br>
                  <button id="editButton" type="button" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-primary btn-sm btn-rounded m-t-20" style="color:black; background-color:white;  width:50%; border-radius: 20px;">Edit</button>

                </div>


              </div>
              <div class="col-sm-8">
                <div class="card-block">
                  <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Booking Information for Payment</h6>

                  <br>
                  <div class="table-responsive" style="font-size: 13px;" >
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Service Detail</th>
                          <th>Date of Start</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        include "connection.php";

                        // Check if the user_id is set in the session
                        if (isset($_SESSION['user_id'])) {
                          $user_id = $_SESSION['user_id'];

                          // Read all rows from the database table
                          $sql = "SELECT * FROM reports_tbl WHERE  email = '$email' AND payment_status='onpayment'";
                          $result = $connection->query($sql);

                          if (!$result) {
                            die("Invalid query: " . $connection->error);
                          }

                          // Check if there are appointments to display
                          if ($result->num_rows > 0) {
                            // Display appointments
                            while ($row = $result->fetch_assoc()) {
                              $issue = $row['issue'];
                              $schedule = $row['date'];
                              $status = $row['payment_status'];
                        ?>
                              <tr>
                                <td><?php echo $issue; ?></td>
                                <td><?php echo $schedule; ?></td>
                                <td><?php echo $status; ?></td>
                                <td>
                                 <?php echo "<a style='background-color:skyblue;' class='btn btn-light btn-sm' href='payment.php?book_id={$row['book_id']}&email={$row['email']}&name={$row['name']}&date={$row['date']}&issue={$row['issue']}&total={$row['total_price']}'>Pay</a>"; ?>
                                </td>
                              </tr>
                            <?php
                            }
                          } else {
                            ?>
                            <tr>
                              <td colspan="4">
                                <div style="opacity: 0.5;">Booking Not Confirmed.</div>
                              </td>
                            </tr>
                        <?php
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Contact Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-5 me-3">
            <form id="editForm" action="editdetails.php" method="POST" class="p-3">
              <label for="contact_number">New Contact Number:</label>
              <input type="tel" name="contact_number" id="contact_number" required autocomplete="off">

              <label for="email">New Email Address:</label>
              <input type="text" name="email" id="email" required autocomplete="off">
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" form="editForm" class="btn btn-success">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal for LogOut Confirmation -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
            <button type="button btn-outline" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to log out?
          </div>
          <div class="modal-footer">
            <button style="background-color:green;" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='logout.php'">Log Out</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      function confirmDelete(userId) {
        return confirm('Are you sure you want to cancel this appointment for user ID ' + userId + '?');
      }
    </script>

    <script>
      $(document).ready(function() {
        // Open the modal when the "Edit" button is clicked
        $("#editButton").click(function() {
          $('#editModal').modal('show');
        });
      });


      function confirmDelete() {
        return confirm('Are you sure you want to cancel your appointment?');
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>