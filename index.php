<?php
include ("database/loginHandler.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Check if both email and password are provided
   if (isset($_POST["loginemail"]) && isset($_POST["loginPassword"])) {
      $username = $_POST["loginemail"];
      $password = $_POST["loginPassword"];

      // Call a function from loginHandler.php to authenticate user
      $user = authenticateUser($username, $password, $conn);

      if ($user) {
         // User authentication successful, redirect to profile page
         header("Location: adminDashboard.php");
         exit();
      } else {
         // Authentication failed, show error message
         echo "<script>alert('Invalid username or password. Please try again.')</script>";
         header("index.php");
      }
   } else {
      // Handle case when email or password is not provided
      echo "<p>Please provide both username and password.</p>";
   }
}

// Check if error message session variable exists
if (isset($_SESSION['error_message'])) {
   // Display error message
   echo '<script>alert("' . $_SESSION['error_message'] . '");</script>';

   // Remove error message session variable
   unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FRANCHISE</title>
   <link rel="icon" href="SB.png" type="image">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <script src="js/jquery-3.7.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="script.js"></script>
   <link rel="stylesheet" href="style.css">
</head>

<body>
   <div class="container">
      <section id="formHolder">

         <div class="row">

            <!-- Brand Box -->
            <div class="col-sm-6 brand">
               <a href="#" class="logo">SB <span>.</span></a>

               <div class="heading">
                  <h2 style="font-size: 44px">Sangguniang</h2>
                  <p> Bayan</p>
               </div>

               <div class="success-msg">
                  <p>Great! You are one of our members now</p>
                  <a href="#" class="profile">Your Profile</a>
               </div>
            </div>


            <!-- Form Box -->
            <div class="col-sm-6 form">

               <!-- Login Form -->
               <div class="login form-peice switched">
                  <form class="login-form" action="#" method="POST">
                     <div class="form-group">
                        <label for="loginemail">Username</label>
                        <input type="text" name="loginemail" id="loginemail" required>
                     </div>

                     <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" name="loginPassword" id="loginPassword" required>
                     </div>

                     <div class="CTA">
                        <input type="submit" value="Login">
                        <a href="#" class="switch">I'm New</a>
                     </div>
                  </form>
               </div><!-- End Login Form -->


               <!-- Signup Form -->
               <div class="signup form-peice">
                  <form class="signup-form" action="#" method="post">

                     <div class="form-group">
                        <label for="SBN">SBN No.</label>
                        <input type="text" name="SBN" id="SBN" class="SBN">
                        <span class="error"></span>
                     </div>

                     <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" name="Name" id="Name" class="Name">
                        <span class="error"></span>
                     </div>

                     <div class="form-group">
                        <label for="motor">Motor No.</label>
                        <input type="text" name="motor" id="motor">
                     </div>

                     <div class="form-group">
                        <label for="chassis">Chassis No.</label>
                        <input type="text" name="chassis" id="chassis" class="pass">
                     </div>

                     <div class="form-group">
                        <label for="plate">Plate No.</label>
                        <input type="text" name="plate" id="plate" class="plate">
                     </div>

                     <div class="form-group">
                        <label class="date " for="date">Date of Renewal</label>
                        <input type="date" name="date" id="date">
                     </div>

                     <div class="CTA">
                        <input type="submit" value="Signup Now" id="submit">
                        <a href="#" class="switch">I have an account</a>
                     </div>
                  </form>
               </div><!-- End Signup Form -->
            </div>
         </div>

      </section>


      <!-- <footer>
           <p>
              Form made by: <a href="http://mohmdhasan.tk" target="_blank">Mohmdhasan.tk</a>
           </p>
        </footer> -->

   </div>

</body>

</html>