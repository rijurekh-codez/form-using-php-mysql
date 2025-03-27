<?php
session_start();
if (isset($_SESSION['user'])) {
  header('Location: dashboard.php');
  exit;
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

<body class="flex bg-green-100 justify-center items-center h-screen">
  <form class="bg-indigo-200 rounded-lg p-4 w-100" action="signin.php" method="post">
    <h1 class="text-xl mb-4 font-medium">Sign In</h1>
    <div class="mb-5 pr-4">
      <input type="text" name="username" id="username" class="border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter username" required />
    </div>
    <div class="mb-5 pr-4">
      <input type="password" id="password" name="password" class="border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Password" required />
    </div>

    <button type="submit" class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign in</button>
  </form>
</body>

</html>

<?php
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

    if ($password == $row['password']) {
      session_start();
      session_regenerate_id();
      $_SESSION['user'] = $username;
      header('Location: dashboard.php');
      exit;
    } else {
      echo "Error: Login Name or Password is invalid.";
    }
  } else {
    echo "Error: Login Name or Password is invalid.";
  }

  $stmt->close();
}

$conn->close();
?>