<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body style="display: flex; justify-content: center; align-items:center ;flex-direction: column;" class=" sm:h-full">

  <div>
    <div class="bg-indigo-200 lg:rounded-lg ">
      <div class="p-4">
        <h1 class="text-3xl font-medium">Create Your Account</h1>
        <p class="text-[15px] mb-4">Create Your Account</p>
      </div>
      <form class="p-4 2xl:w-250 lg:w-200 md:w-auto" action="signup.php" method="post" id="myform" enctype="multipart/form-data">

        <!-- Personal details -->
        <h4>Personal Details:</h4>
        <div class="grid xs:grid-cols-12 md:grid-cols-2 lg:grid-cols-4 gap-2 mb-4">
          <div class="mb-2 pr-4">
            <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" first name" />
            <p id="firstname-err" style="color:red; display:none;"></p>
          </div>
          <div class="mb-2 pr-4">
            <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" last name" />
            <p id="lastname-err" style="color:red; display:none;"></p>
          </div>
          <div class="mb-2 pr-4">
            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" username" />
            <p id="username-err" style="color:red; display:none;"></p>
          </div>
          <div class="mb-2 pr-4">
            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" email" />
            <p id="email-err" style="color:red; display:none;"></p>
          </div>
          <div class="mb-2 pr-4">
            <input type="text" name="phoneno" id="phoneno" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" phone number" />
            <p id="phoneno-err" style="color:red; display:none;"></p>
          </div>
          <div class="mb-2 pr-4">
            <input type="text" name="add_phoneno" id="add_phoneno" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Additional phone number" />
          </div>
          <!-- Password -->
          <div class="mb-2 pr-4">
            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" Password" />
            <p id="password-err" style="color:red; display:none;"></p>
          </div>
          <div class="mb-2 pr-4">
            <input type="password" id="confirmpassword" name="confirmpassword" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Confirm Password" />
            <p id="conpassword-err" style="color:red; display:none;"></p>
          </div>
        </div>
        <label for="image" class=" mb-2 text-sm ">Upload an image:</label>
        <input type="file" class=" text-sm border border-gray-300 rounded-lg cursor-pointer focus:outline-none light:bg-gray-700 dark:border-gray-500 " name="image" id="image" accept="image/*">
        <p id="image-err" style="color:red; display:none;"></p>


        <h4 class="mt-5">Address:</h4>
        <div class="grid xs:grid-cols-12 md:grid-cols-2 lg:grid-cols-4 gap-2 mb-4">
          <!-- Address -->
          <div class="mb-2 pr-4">
            <input type="text" name="street" id="street" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" street" />
            <p id="street-err" style="color:red; display:none;"></p>
          </div>
          <div class="mb-2 pr-4">
            <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" City" />
            <p id="city-err" style="color:red; display:none;"></p>
          </div>

          <div class="mb-2 pr-4">
            <select name="country" id="country" class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
              <option selected>Select country</option>
            </select>
            <p id="country-err" style="color:red; display:none;"></p>
          </div>

          <div class="mb-2 pr-4" id="state-container">
            <input type="text" name="state" id="state" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" State" />
            <p id="state-err" style="color:red; display:none;"></p>
          </div>

          <div class="mb-2 pr-4">
            <input type="text" name="zipcode" id="zipcode" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" zip code" />
            <p id="zipcode-err" style="color:red; display:none;"></p>
          </div>
        </div>

        <h4>Others:</h4>

        <div class="my-2 pr-4">
          <span>Gender: </span>
          <input type="radio" id="male" name="gender" value="Male">
          <label for="male">Male</label>
          <input type="radio" id="female" name="gender" value="Female">
          <label for="female">Female</label>
          <p id="gender-err" style="color:red; display:none;"></p>
        </div>

        <div class="grid xs:grid-cols-12 md:grid-cols-2 lg:grid-cols-4 gap-2">
          <!-- Language -->

          <div class="mb-2 pr-4">
            <p>Languages: </p>
            <input type="checkbox" name="languages[]" value="English" class="inline"> English <br>
            <input type="checkbox" name="languages[]" value="Hindi" class="inline"> Hindi <br>
            <input type="checkbox" name="languages[]" value="Bengali"> Bengali <br>

            <p id="language-err" style="color:red; display:none;"></p>
          </div>
        </div>


        <br>
        <button type="submit" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center text-white">Sign Up</button>
      </form>

    </div>
  </div>
  <script src="signup.js"></script>

</body>

</html>

<?php
include 'db.php';

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
  $file_name = $_FILES['image']['name'];
  $tempname =  $_FILES['image']['tmp_name'];
  $folder = 'Uploads/' . $file_name;

  if (move_uploaded_file($tempname, $folder)) {
    // echo "file uploaded";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit;
  }

  if ($password !== $confirmpassword) {
    echo "Passwords do not match!";
    exit;
  }

  if (strlen($password) < 10) {
    echo "Password must be at least 10 characters long.";
    exit;
  }

  $sql = "INSERT INTO Persons (password, username, firstname, lastname, phoneno, gender, street, city, state, country, zipcode, languages, email,image_path,add_phoneno)
          VALUES ('$password', '$username', '$firstname', '$lastname', '$phoneno', '$gender', '$street', '$city', '$state', '$country', '$zipcode', '$all_languages', '$email','$file_name','$add_phoneno')";

  if ($conn->query($sql) === TRUE) {
    echo "Account Created Succesfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>