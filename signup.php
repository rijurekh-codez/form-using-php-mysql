

<?php
include 'db.php';
// $username = $_POST['username'] ?? '';
// echo htmlspecialchars($username);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);
  $confirmpassword = mysqli_real_escape_string($conn, $_POST["confirmpassword"]);
  $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
  $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
  $phoneno = mysqli_real_escape_string($conn, $_POST["phoneno"]);
  $add_phoneno = mysqli_real_escape_string($conn, $_POST["add_phoneno"]);
  $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
  $street = mysqli_real_escape_string($conn, $_POST["street"]);
  $city = mysqli_real_escape_string($conn, $_POST["city"]);
  $state = mysqli_real_escape_string($conn, $_POST["state"]);
  $country = mysqli_real_escape_string($conn, $_POST["country"]);
  $zipcode = mysqli_real_escape_string($conn, $_POST["zipcode"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $languages = $_POST['languages'];

  $all_languages = implode(",", $languages);

  // image

  $croppedImages = json_decode($_POST['cropped_images'], true);
  $uploadDir = 'Uploads/';
  $filePaths = [];

  foreach ($croppedImages as $index => $dataUrl) {
    if (preg_match('/^data:image\/(\w+);base64,/', $dataUrl, $type)) {
      $data = substr($dataUrl, strpos($dataUrl, ',') + 1);
      $extension = strtolower($type[1]);

      if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
        echo "Invalid file type: " . $extension;
        exit;
      }

      $data = base64_decode($data);
      if ($data === false) {
        echo "Base64 decode failed.";
        exit;
      }

      $fileName = 'image_' . time() . '_' . $index . '.' . $extension;
      $filePath = $uploadDir . $fileName;

      if (file_put_contents($filePath, $data) === false) {
        echo "Failed to save file: " . $filePath;
        exit;
      }

      $filePaths[] = $filePath;
    } else {
      echo "Invalid image format.";
      exit;
    }
  }

  $filePathsStr = implode(',', $filePaths);


  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>Toastify({
        text: 'Invalid email format.',
        duration: 3000,
        backgroundColor: 'linear-gradient(to right, #ff5f6d, #ffc3a0)',
        position: 'top-right',
        close: true,
    }).showToast();</script>";
    exit;
  }
  if ($password !== $confirmpassword) {
    echo "<script>Toastify({
        text: 'Passwords do not match.',
        duration: 3000,
        backgroundColor: 'linear-gradient(to right, #ff5f6d, #ffc3a0)',
        position: 'top-right',
        close: true,
    }).showToast();</script>";
    exit;
  }


  $isValid = true;

  $searchUsername = "SELECT * FROM Persons WHERE username = '$username'";
  $stmt = $conn->prepare($searchUsername);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    echo "<script>Toastify({
        text: 'Username already exists',
        duration: 3000,
        backgroundColor: 'linear-gradient(to right, #ff5f6d, #ffc3a0)',
        position: 'top-right',
        close: true,
    }).showToast();</script>";
    $isValid = false;
  }

  $searchemail = "SELECT * FROM Persons WHERE email = '$email'";
  $stmt = $conn->prepare($searchemail);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    echo "<script>Toastify({
        text: 'Email already exists',
        duration: 4000,
        backgroundColor: 'linear-gradient(to right, #ff5f6d, #ffc3a0)',
        position: 'top-right',
        close: true
    }).showToast();</script>";
    $isValid = false;
  }

  $searchphoenno = "SELECT * FROM Persons WHERE phoneno = '$phoneno'";
  $stmt = $conn->prepare($searchphoenno);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    echo "<script>Toastify({
        text: 'Phone number already exists',
        duration: 4000,
        backgroundColor: 'linear-gradient(to right, #ff5f6d, #ffc3a0)',
        position: 'top-right',

    }).showToast();</script>";
    $isValid = false;
  }


  if (!$isValid) {
    exit;
  }
  $sql = "INSERT INTO Persons (password, username, firstname, lastname, phoneno, gender, street, city, state, country, zipcode, languages, email,image_path,add_phoneno)
          VALUES ('$password', '$username', '$firstname', '$lastname', '$phoneno', '$gender', '$street', '$city', '$state', '$country', '$zipcode', '$all_languages', '$email','$filePathsStr','$add_phoneno')";

  if ($conn->query($sql) === TRUE) {
    echo '<p style="color: green; width:100%;" class="pl-4" >Account Created Successfully 
      <span style="color:#000;">Go to <a href="signin.php" class="font-bold">Sign in</a></p>
    </p>';


    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>