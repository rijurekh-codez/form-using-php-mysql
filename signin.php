<?php
session_start();

if (isset($_SESSION['user'])) {
  header('Location: dashboard.php');
  exit;
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = $_POST['password'];

  $sql = "SELECT * FROM Persons WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
      $_SESSION['user'] = $username;
      header('Location: dashboard.php');
      exit;
    } else {
      $error_message = "Invalid Credentials!";
    }
  } else {
    $error_message = "Invalid Credentials!";
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="h-screen bg-green-100 text-center pt-35">
  <div class="flex bg-green-100 justify-center items-center">

    <form id="myform" class="bg-indigo-200 rounded-lg p-4 w-100" action="signin.php" method="post">
      <h1 class="text-xl mb-4 font-medium">Sign In</h1>

      <div class="mb-5 pr-4">
        <input type="text" name="username" id="username" class="border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter username" />
        <p id="username-err" style="color:red; display:none;"></p>
      </div>

      <div class="mb-5 pr-4">
        <input type="password" id="password" name="password" class="border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Password" />
        <p id="password-err" style="color:red; display:none;"></p>
      </div>

      <button type="submit" class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign in</button>

      <?php if (isset($error_message)) { ?>
        <p style="color:red; margin-top:10px;"><?php echo $error_message; ?></p>
      <?php } ?>
    </form>
  </div>

</body>

</html>

<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

  var isValid = false;

  document.getElementById('username').addEventListener('input', function(event) {
    var username = document.getElementById("username").value.trim();
    var errorElement = document.getElementById("username-err");

    if (username == "") {
      errorElement.style.display = "block";
      errorElement.textContent = "Username is required";
      isValid = false;
    } else {
      var usernameRegex = /^[A-Za-z\s]+$/;
      if (!username.match(usernameRegex)) {
        errorElement.style.display = "block";
        errorElement.textContent = "Username can only contain alphabetic characters and spaces.";
        isValid = false;
      } else {
        errorElement.style.display = "none";
        isValid = true;
      }
    }
  });

  document.getElementById('password').addEventListener('input', function(event) {
    var password = document.getElementById("password").value.trim();
    var errorElement = document.getElementById("password-err");

    if (password == "") {
      errorElement.style.display = "block";
      errorElement.textContent = "Password is required";
      isValid = false;
    } else {
      errorElement.style.display = "none";
      isValid = true;
    }
  });

  function validateForm(event) {
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value.trim();

    if (username == "") {
      document.getElementById("username-err").style.display = "block";
      document.getElementById("username-err").textContent = "Username is required";
      isValid = false;
    }

    if (password == "") {
      document.getElementById("password-err").style.display = "block";
      document.getElementById("password-err").textContent = "Password is required";
      isValid = false;
    }

    if (!isValid) {
      event.preventDefault();
    }
  }

  document.querySelector('form').addEventListener('submit', validateForm);
</script>