<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<div class='2xl:w-250 lg:w-200 md:w-auto text-center' style='background-color: #8effc1; border-radius: 8px; padding: 10px 20px; margin-bottom: 10px;'>";
    echo "<p style='color: rgb(7, 70, 4);'>• Account Created Successfully</p>";
    echo "</div>";
}

echo "<script>
        if (typeof window !== 'undefined') {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>";
?>

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    $username = isset(($_POST["username"])) ? mysqli_real_escape_string($conn, $_POST["username"]) : null;
    $password = isset($_POST["password"]) ? mysqli_real_escape_string($conn, $_POST["password"]) : null;
    $confirmpassword = isset($_POST["confirmpassword"]) ? mysqli_real_escape_string($conn, $_POST["confirmpassword"]) : null;
    $firstname = isset($_POST["firstname"]) ? mysqli_real_escape_string($conn, $_POST["firstname"]) : null;
    $lastname = isset($_POST["lastname"]) ? mysqli_real_escape_string($conn, $_POST["lastname"]) : null;
    $phoneno = isset($_POST["phoneno"]) ? mysqli_real_escape_string($conn, $_POST["phoneno"]) : null;
    $add_phoneno = isset($_POST["add_phoneno"]) ? mysqli_real_escape_string($conn, $_POST["add_phoneno"]) : null;
    $gender = isset($_POST["gender"]) ? mysqli_real_escape_string($conn, $_POST["gender"]) : null;
    $street = isset($_POST["street"]) ? mysqli_real_escape_string($conn, $_POST["street"]) : null;
    $city = isset($_POST["city"]) ? mysqli_real_escape_string($conn, $_POST["city"]) : null;
    $state = isset($_POST["state"]) ? mysqli_real_escape_string($conn, $_POST["state"]) : null;
    $country = isset($_POST["country"]) ? mysqli_real_escape_string($conn, $_POST["country"]) : null;
    $zipcode = isset($_POST["zipcode"]) ? mysqli_real_escape_string($conn, $_POST["zipcode"]) : null;
    $email = isset($_POST["email"]) ? mysqli_real_escape_string($conn, $_POST["email"]) : null;
    $languages = isset($_POST["languages"]) ? $_POST["languages"] : [];
    $croppedImages = json_decode($_POST['cropped_images'], true);
    $all_languages = implode(",", $languages);


    if (empty($firstname)) {
        $errors[] = "First name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $firstname)) {
        $errors[] = "First name can only contain letters and spaces.";
    }

    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $lastname)) {
        $errors[] = "Last name can only contain letters and spaces.";
    }

    if (empty($username)) $errors[] = "Username is required.";
    elseif (strlen($username) < 6) $errors[] = "Username must be of atleast 6 characters.";

    if (empty($email)) $errors[] = "Email is required.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email format.";
    }

    if (empty($phoneno)) $errors[] = "Phone number is required.";
    elseif (!preg_match("/^(?:\+91[\s-]?)?[789]\d{9}$/", $phoneno)) {
        $errors[] = "Phone number must be a valid number.";
    }

    if (!empty($add_phoneno) && !preg_match("/^(?:\+91[\s-]?)?[789]\d{9}$/", $add_phoneno)) {
        $errors[] = "Additional phone number must be a valid number.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } else {
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }

        if (!preg_match("/[a-z]/", $password)) {
            $errors[] = "Should contain atleast one small alphabet.";
        }

        if (!preg_match("/[A-Z]/", $password)) {
            $errors[] = "Should contain atleast one capital alphabet.";
        }

        if (!preg_match("/\d/", $password)) {
            $errors[] = "Should contain atleast one number.";
        }

        if (!preg_match("/[\W_]/", $password)) {
            $errors[] = "Should contain atleast one special symbol.";
        }
    }


    if (empty($confirmpassword)) {
        $errors[] = "Please confirm your password.";
    }

    if ($password !== $confirmpassword) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($croppedImages)) {
        $errors[] = "Image is required.";
    }

    if (empty($street)) $errors[] = "Street is required.";

    if (empty($city)) $errors[] = "City is required.";
    elseif (!preg_match("/^[a-zA-Z ]+$/", $city)) {
        $errors[] = "City can only contain letters and spaces.";
    }

    if ($country == "Select country") $errors[] = "Country is required.";

    if (empty($state)) $errors[] = "State is required.";
    elseif (!preg_match("/^[a-zA-Z ]+$/", $state)) {
        $errors[] = "State can only contain letters and spaces.";
    }

    if (empty($zipcode)) $errors[] = "Zipcode is required.";
    elseif (preg_match("/[^0-9]/", $zipcode)) {
        $errors[] = "Zipcode can only digits.";
    }

    if (empty($gender)) $errors[] = "Gender is required.";

    if (count($languages) === 0) $errors[] = "Please select at least one language.";


    $firstname = htmlspecialchars(trim($firstname));
    $lastname = htmlspecialchars(trim($lastname));
    $lastname = htmlspecialchars(trim($lastname));
    $username = htmlspecialchars(trim($username));
    $phoneno = htmlspecialchars(trim($phoneno));
    $add_phoneno = htmlspecialchars(trim($add_phoneno));
    $street = htmlspecialchars(trim($street));
    $city = htmlspecialchars(trim($city));
    $state = htmlspecialchars(trim($state));
    $zipcode = htmlspecialchars(trim($zipcode));
    $email = htmlspecialchars(trim($email));
    $country = htmlspecialchars(trim($country));
    $gender = htmlspecialchars(trim($gender));
    $all_languages = htmlspecialchars(trim($all_languages));


    $searchUsername = "SELECT * FROM Persons WHERE username = '$username'";
    $stmt = $conn->prepare($searchUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $errors[] = "Username already exists.";
    }

    $searchemail = "SELECT * FROM Persons WHERE email = '$email'";
    $stmt = $conn->prepare($searchemail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $errors[] = "Email already exists.";
    }

    $searchphoenno = "SELECT * FROM Persons WHERE phoneno = '$phoneno'";
    $stmt = $conn->prepare($searchphoenno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $errors[] = "Phone number already exists.";
    }

    if (empty($errors)) {
        $uploadDir = 'Uploads/';
        $filePaths = [];
        foreach ($croppedImages as $idx => $dataUrl) {
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

                $fileName = 'image_' . time() . '_' . $idx . '.' . $extension;
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

        $sql = "INSERT INTO Persons
         (password, username, firstname, lastname, phoneno, gender, street, city, state, country, zipcode, languages, email,image_path,add_phoneno)
          VALUES ('$password', '$username', '$firstname', '$lastname', '$phoneno', '$gender', '$street', '$city', '$state', '$country', '$zipcode', '$all_languages', '$email','$filePathsStr','$add_phoneno')";

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<div class='2xl:w-250 lg:w-200 md:w-auto' style='background-color:rgb(247, 196, 202); border-radius : 8px ;padding:10px 20px;margin-bottom:10px'>";
        foreach ($errors as $error) {
            echo "<p style='color: #ff2c2c;'>• $error</p>";
        }
        echo "</div>";
    }
}

$conn->close();
