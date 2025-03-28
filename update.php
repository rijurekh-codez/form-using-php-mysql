<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: signin.php');
    exit;
}
include 'db.php';
$username = $_SESSION['user'];

$sql = "SELECT * FROM Persons WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$add_phoneno = isset($row["add_phoneno"]) && $row["add_phoneno"] !== NULL ? $row["add_phoneno"] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo $_POST["state"];
    $phoneno = mysqli_real_escape_string($conn, $_POST["phoneno"]);
    $add_phoneno = mysqli_real_escape_string($conn, $_POST["add_phoneno"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $street = mysqli_real_escape_string($conn, $_POST["street"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $state = mysqli_real_escape_string($conn, $_POST["state"]);
    $country = mysqli_real_escape_string($conn, $_POST["country"]);
    $zipcode = mysqli_real_escape_string($conn, $_POST["zipcode"]);
    $language = mysqli_real_escape_string($conn, $_POST["language"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);


    $sql = "UPDATE Persons SET 
                phoneno = '$phoneno', 
                add_phoneno = '$add_phoneno', 
                gender = '$gender', 
                street = '$street', 
                city = '$city', 
                state = '$state', 
                country = '$country', 
                zipcode = '$zipcode', 
                language = '$language', 
                email = '$email' 
            WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['user']);
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating details: " . $stmt->error;
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <script>
        function confirmSubmit() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to update your details?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("myform").submit();
                }
            });
        }
    </script>
</head>

<body class="px-4 mt-2 flex justify-center">

    <div class="border-2 border-gray-300 rounded-lg p-5 w-200 bg-gray-100">
        <form class="p-4 2xl:w-250 lg:w-200 md:w-auto" action="update.php" method="post" id="myform" enctype="multipart/form-data">

            <div class="flex flex-col md:flex-row items-center gap-4 mb-7">

                <div class="">
                    <div class=" relative w-[150px] rounded-full mt-2">
                        <img class="profile-image w-full rounded-full" src="<?php echo 'Uploads/' . $row['image_path']; ?>" alt="Profile Image">

                        <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-transparent bg-opacity-50 opacity-0 hover:opacity-100 transition-opacity backdrop-blur-md rounded-full text-center">
                            <p class="text-white cursor-pointer
">Update Profile Picture</p>
                        </div>

                    </div>
                </div>

                <div>
                    <p class="text-[30px] font-semibold"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></p>
                    <p class="text-[16px] text-gray-600"><?php echo '@' . $row['username'] ?></p>

                </div>

                <!-- details -->

            </div>
            <div class="grid lg:grid-cols-2 md:grid-cols-2 gap-4 sm:grid-cols-2 xs:grid-cols-1">
                <div>
                    <div class="text-center flex items-center gap-2 mb-4">
                        <svg class="h-5 w-5 text-neutral-700 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>

                        <p class="text-[20px] font-medium text-gray-900">Personal Information: </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        <p class="text-gray-600">Email</p>
                    </div>
                    <input type="text" name="email" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 " value="<?php echo $row['email'] ?>">

                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        </svg>
                        <p class="text-gray-600">Phone No</p>
                    </div>
                    <input type="text" name="phoneno" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 " value="<?php echo $row['phoneno'] ?>">


                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        </svg>
                        <p class="text-gray-600">Additonal Phone No</p>
                    </div>
                    <input type="text" class="bg-gray-400 rounded-sm px-2 mb-1 border-1" name="add_phoneno" value="<?php echo htmlspecialchars($add_phoneno); ?>" />


                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                        <p class="text-gray-600">Gender</p>
                    </div>


                    <div class="mb-1">
                        <input type="radio" id="male" name="gender" value="Male" <?php if ($row['gender'] == 'Male') echo 'checked'; ?>>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="Female" <?php if ($row['gender'] == 'Female') echo 'checked'; ?>>
                        <label for="female">Female</label>
                        <p id="gender-err" style="color:red; display:none;"></p>
                    </div>


                    <div class="text-center flex items-center gap-2">
                        <svg class="h-6 w-6 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M5 7h7m-2 -2v2a5 8 0 0 1 -5 8m1 -4a7 4 0 0 0 6.7 4" />
                            <path d="M11 19l4 -9l4 9m-.9 -2h-6.2" />
                        </svg>
                        <p class="text-gray-600">Language</p>
                    </div>
                    <select name="language" id="language" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 focus:ring-gray-900 focus:border-gray-900 py-1 w-50">
                        <option value="English" <?php if ($row['language'] == 'English') echo 'selected'; ?>>English</option>
                        <option value="Hindi" <?php if ($row['language'] == 'Hindi') echo 'selected'; ?>>Hindi</option>
                        <option value="Bengali" <?php if ($row['language'] == 'Bengali') echo 'selected'; ?>>Bengali</option>
                    </select>

                </div>


                <div>
                    <div class="text-center flex items-center gap-2 mb-4">
                        <svg class="h-5 w-5 text-neutral-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>

                        <p class="text-[20px] font-medium text-gray-900">Address: </p>
                    </div>


                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        <p class="text-gray-600">Street</p>
                    </div>
                    <input type="text" name="street" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 " value="<?php echo $row['street'] ?>">


                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        <p class="text-gray-600">City</p>
                    </div>
                    <input type="text" name="city" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 " value="<?php echo $row['city'] ?>">


                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        <p class="text-gray-600">State</p>
                    </div>

                    <input type="text" name="state" class="bg-gray-400 rounded-sm px-2 mb-1 border-1" value="<?php echo $row['state'] ?>">


                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <circle cx="12" cy="12" r="9" />
                            <line x1="3.6" y1="9" x2="20.4" y2="9" />
                            <line x1="3.6" y1="15" x2="20.4" y2="15" />
                            <path d="M11.5 3a17 17 0 0 0 0 18" />
                            <path d="M12.5 3a17 17 0 0 1 0 18" />
                        </svg>
                        <p class="text-gray-600">Country</p>
                    </div>
                    <input type="text" class="bg-gray-400 rounded-sm px-2 mb-1 border-1" name="country" value="<?php echo $row['country'] ?>">

                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-gray-600">Zip code</p>
                    </div>
                    <input type="text" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 " name="zipcode" value="<?php echo $row['zipcode'] ?>">
                </div>
            </div>

            <div class="mt-2 flex gap-2" style="margin-right: auto !important;">
                <button class="border-1 p-1 rounded-md" type="button" style="cursor: pointer" onclick="confirmSubmit()">Submit Changes</button>
            </div>
        </form>
    </div>

</body>

</html>