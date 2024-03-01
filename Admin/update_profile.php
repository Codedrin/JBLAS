<?php 
session_start();
include('../Admin/dbcon.php');
include('../Admin/navbar.php');
//no backend pa to update the profile of the user wala kasi ako login dinako nag-gawa
?>

<div class="container mb-5">
  <div class="card">
    <div class="card-body">
      <h2 class="card-title"style = "color: #116D6E";>Update Profile</h2>
      <form>
        <div class="form-group">
          <label for="firstName">First Name:</label>
          <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
        </div>
        <div class="form-group">
          <label for="lastName">Last Name:</label>
          <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
        </div>
        <div class="form-group">
          <label for="lastName">username:</label>
          <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="phone">Phone Number:</label>
          <input type="tel" class="form-control" id="phone" placeholder="Enter phone number">
        </div>
        <div class="form-group mb-4">
          <label for="address">Address:</label>
          <textarea class="form-control" id="address" rows="3" placeholder="Enter address"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block" style = "background-color: #4E3636";>Update Profile</button>
      </form>
    </div>
  </div>
</div>

<?php include('../Admin/footer.php'); ?>
