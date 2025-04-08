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

    $phoneno = mysqli_real_escape_string($conn, $_POST["phoneno"]);
    $add_phoneno = mysqli_real_escape_string($conn, $_POST["add_phoneno"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $street = mysqli_real_escape_string($conn, $_POST["street"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $state = mysqli_real_escape_string($conn, $_POST["state"]);
    $country = mysqli_real_escape_string($conn, $_POST["country"]);
    $zipcode = mysqli_real_escape_string($conn, $_POST["zipcode"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $languages = isset($row['languages']) ? $_POST['languages'] : '';
    $all_languages = isset($row['languages']) ? implode(",", $languages) : '';


    $sql = "UPDATE Persons SET 
                phoneno = '$phoneno', 
                add_phoneno = '$add_phoneno', 
                gender = '$gender', 
                street = '$street', 
                city = '$city', 
                state = '$state', 
                country = '$country', 
                zipcode = '$zipcode', 
                languages = '$all_languages', 
                email = '$email' 
            WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['user']);
    if ($stmt->execute()) {
        // $path = 'Uploads/' . $row['image_path'];
        // unlink($path);
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
    <title>Update Profile</title>
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
                            <p class="text-white cursor-pointer">Update Profile Picture</p>
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
                    <input type="text" name="email" id="email" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 " value="<?php echo $row['email'] ?>">

                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        </svg>
                        <p class="text-gray-600">Phone No</p>
                    </div>
                    <input type="text" name="phoneno" id="phoneno" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 " value="<?php echo $row['phoneno'] ?>">


                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        </svg>
                        <p class="text-gray-600">Additonal Phone No</p>
                    </div>
                    <input type="text" class="bg-gray-400 rounded-sm px-2 mb-1 border-1" id="add_phoneno" name="add_phoneno" value="<?php echo $add_phoneno; ?>" />


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



                    <input type="checkbox" name="languages[]" value="English" class="inline" <?php if (isset($row['languages']) && str_contains($row['languages'], 'English')) echo 'checked'; ?>> English <br>
                    <input type="checkbox" name="languages[]" value="Hindi" class="inline" <?php if (isset($row['languages']) && str_contains($row['languages'], 'Hindi')) echo 'checked'; ?>> Hindi <br>
                    <input type="checkbox" name="languages[]" value="Bengali" <?php if (isset($row['languages']) && str_contains($row['languages'], 'Bengali')) echo 'checked'; ?>> Bengali <br>

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
                    <input type="text" id="street" name="street" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 " value="<?php echo $row['street'] ?>">


                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        <p class="text-gray-600">City</p>
                    </div>
                    <input type="text" id="city" name="city" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 " value="<?php echo $row['city'] ?>">


                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        <p class="text-gray-600">State</p>
                    </div>

                    <input type="text" id="state" name="state" class="bg-gray-400 rounded-sm px-2 mb-1 border-1" value="<?php echo $row['state'] ?>">


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
                    <select name="country" id="country" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 focus:ring-gray-900 focus:border-gray-900 py-1 w-50">
                        <option selected>

                        </option>
                    </select>

                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-gray-600">Zip code</p>
                    </div>
                    <input type="text" id="zipcode" class="bg-gray-400 rounded-sm px-2 mb-1 border-1 " name="zipcode" value="<?php echo $row['zipcode'] ?>">
                </div>
            </div>

            <div class="mt-2 flex gap-2" style="margin-right: auto !important;">
                <button class="border-1 p-1 rounded-md" type="button" style="cursor: pointer" onclick="confirmSubmit()">Submit Changes</button>
            </div>
        </form>
    </div>


    <script>
        let countryData = [{
                name: "Afghanistan",
                code: "AF",
            },
            {
                name: "Åland Islands",
                code: "AX",
            },
            {
                name: "Albania",
                code: "AL",
            },
            {
                name: "Algeria",
                code: "DZ",
            },
            {
                name: "American Samoa",
                code: "AS",
            },
            {
                name: "AndorrA",
                code: "AD",
            },
            {
                name: "Angola",
                code: "AO",
            },
            {
                name: "Anguilla",
                code: "AI",
            },
            {
                name: "Antarctica",
                code: "AQ",
            },
            {
                name: "Antigua and Barbuda",
                code: "AG",
            },
            {
                name: "Argentina",
                code: "AR",
            },
            {
                name: "Armenia",
                code: "AM",
            },
            {
                name: "Aruba",
                code: "AW",
            },
            {
                name: "Australia",
                code: "AU",
            },
            {
                name: "Austria",
                code: "AT",
            },
            {
                name: "Azerbaijan",
                code: "AZ",
            },
            {
                name: "Bahamas",
                code: "BS",
            },
            {
                name: "Bahrain",
                code: "BH",
            },
            {
                name: "Bangladesh",
                code: "BD",
            },
            {
                name: "Barbados",
                code: "BB",
            },
            {
                name: "Belarus",
                code: "BY",
            },
            {
                name: "Belgium",
                code: "BE",
            },
            {
                name: "Belize",
                code: "BZ",
            },
            {
                name: "Benin",
                code: "BJ",
            },
            {
                name: "Bermuda",
                code: "BM",
            },
            {
                name: "Bhutan",
                code: "BT",
            },
            {
                name: "Bolivia",
                code: "BO",
            },
            {
                name: "Bosnia and Herzegovina",
                code: "BA",
            },
            {
                name: "Botswana",
                code: "BW",
            },
            {
                name: "Bouvet Island",
                code: "BV",
            },
            {
                name: "Brazil",
                code: "BR",
            },
            {
                name: "British Indian Ocean Territory",
                code: "IO",
            },
            {
                name: "Brunei Darussalam",
                code: "BN",
            },
            {
                name: "Bulgaria",
                code: "BG",
            },
            {
                name: "Burkina Faso",
                code: "BF",
            },
            {
                name: "Burundi",
                code: "BI",
            },
            {
                name: "Cambodia",
                code: "KH",
            },
            {
                name: "Cameroon",
                code: "CM",
            },
            {
                name: "Canada",
                code: "CA",
            },
            {
                name: "Cape Verde",
                code: "CV",
            },
            {
                name: "Cayman Islands",
                code: "KY",
            },
            {
                name: "Central African Republic",
                code: "CF",
            },
            {
                name: "Chad",
                code: "TD",
            },
            {
                name: "Chile",
                code: "CL",
            },
            {
                name: "China",
                code: "CN",
            },
            {
                name: "Christmas Island",
                code: "CX",
            },
            {
                name: "Cocos (Keeling) Islands",
                code: "CC",
            },
            {
                name: "Colombia",
                code: "CO",
            },
            {
                name: "Comoros",
                code: "KM",
            },
            {
                name: "Congo",
                code: "CG",
            },
            {
                name: "Congo, The Democratic Republic of the",
                code: "CD",
            },
            {
                name: "Cook Islands",
                code: "CK",
            },
            {
                name: "Costa Rica",
                code: "CR",
            },
            {
                name: "Cote D'Ivoire",
                code: "CI",
            },
            {
                name: "Croatia",
                code: "HR",
            },
            {
                name: "Cuba",
                code: "CU",
            },
            {
                name: "Cyprus",
                code: "CY",
            },
            {
                name: "Czech Republic",
                code: "CZ",
            },
            {
                name: "Denmark",
                code: "DK",
            },
            {
                name: "Djibouti",
                code: "DJ",
            },
            {
                name: "Dominica",
                code: "DM",
            },
            {
                name: "Dominican Republic",
                code: "DO",
            },
            {
                name: "Ecuador",
                code: "EC",
            },
            {
                name: "Egypt",
                code: "EG",
            },
            {
                name: "El Salvador",
                code: "SV",
            },
            {
                name: "Equatorial Guinea",
                code: "GQ",
            },
            {
                name: "Eritrea",
                code: "ER",
            },
            {
                name: "Estonia",
                code: "EE",
            },
            {
                name: "Ethiopia",
                code: "ET",
            },
            {
                name: "Falkland Islands (Malvinas)",
                code: "FK",
            },
            {
                name: "Faroe Islands",
                code: "FO",
            },
            {
                name: "Fiji",
                code: "FJ",
            },
            {
                name: "Finland",
                code: "FI",
            },
            {
                name: "France",
                code: "FR",
            },
            {
                name: "French Guiana",
                code: "GF",
            },
            {
                name: "French Polynesia",
                code: "PF",
            },
            {
                name: "French Southern Territories",
                code: "TF",
            },
            {
                name: "Gabon",
                code: "GA",
            },
            {
                name: "Gambia",
                code: "GM",
            },
            {
                name: "Georgia",
                code: "GE",
            },
            {
                name: "Germany",
                code: "DE",
            },
            {
                name: "Ghana",
                code: "GH",
            },
            {
                name: "Gibraltar",
                code: "GI",
            },
            {
                name: "Greece",
                code: "GR",
            },
            {
                name: "Greenland",
                code: "GL",
            },
            {
                name: "Grenada",
                code: "GD",
            },
            {
                name: "Guadeloupe",
                code: "GP",
            },
            {
                name: "Guam",
                code: "GU",
            },
            {
                name: "Guatemala",
                code: "GT",
            },
            {
                name: "Guernsey",
                code: "GG",
            },
            {
                name: "Guinea",
                code: "GN",
            },
            {
                name: "Guinea-Bissau",
                code: "GW",
            },
            {
                name: "Guyana",
                code: "GY",
            },
            {
                name: "Haiti",
                code: "HT",
            },
            {
                name: "Heard Island and Mcdonald Islands",
                code: "HM",
            },
            {
                name: "Holy See (Vatican City State)",
                code: "VA",
            },
            {
                name: "Honduras",
                code: "HN",
            },
            {
                name: "Hong Kong",
                code: "HK",
            },
            {
                name: "Hungary",
                code: "HU",
            },
            {
                name: "Iceland",
                code: "IS",
            },
            {
                name: "India",
                code: "IN",
            },
            {
                name: "Indonesia",
                code: "ID",
            },
            {
                name: "Iran, Islamic Republic Of",
                code: "IR",
            },
            {
                name: "Iraq",
                code: "IQ",
            },
            {
                name: "Ireland",
                code: "IE",
            },
            {
                name: "Isle of Man",
                code: "IM",
            },
            {
                name: "Israel",
                code: "IL",
            },
            {
                name: "Italy",
                code: "IT",
            },
            {
                name: "Jamaica",
                code: "JM",
            },
            {
                name: "Japan",
                code: "JP",
            },
            {
                name: "Jersey",
                code: "JE",
            },
            {
                name: "Jordan",
                code: "JO",
            },
            {
                name: "Kazakhstan",
                code: "KZ",
            },
            {
                name: "Kenya",
                code: "KE",
            },
            {
                name: "Kiribati",
                code: "KI",
            },
            {
                name: "Korea, Democratic People'S Republic of",
                code: "KP",
            },
            {
                name: "Korea, Republic of",
                code: "KR",
            },
            {
                name: "Kuwait",
                code: "KW",
            },
            {
                name: "Kyrgyzstan",
                code: "KG",
            },
            {
                name: "Lao People'S Democratic Republic",
                code: "LA",
            },
            {
                name: "Latvia",
                code: "LV",
            },
            {
                name: "Lebanon",
                code: "LB",
            },
            {
                name: "Lesotho",
                code: "LS",
            },
            {
                name: "Liberia",
                code: "LR",
            },
            {
                name: "Libyan Arab Jamahiriya",
                code: "LY",
            },
            {
                name: "Liechtenstein",
                code: "LI",
            },
            {
                name: "Lithuania",
                code: "LT",
            },
            {
                name: "Luxembourg",
                code: "LU",
            },
            {
                name: "Macao",
                code: "MO",
            },
            {
                name: "Macedonia, The Former Yugoslav Republic of",
                code: "MK",
            },
            {
                name: "Madagascar",
                code: "MG",
            },
            {
                name: "Malawi",
                code: "MW",
            },
            {
                name: "Malaysia",
                code: "MY",
            },
            {
                name: "Maldives",
                code: "MV",
            },
            {
                name: "Mali",
                code: "ML",
            },
            {
                name: "Malta",
                code: "MT",
            },
            {
                name: "Marshall Islands",
                code: "MH",
            },
            {
                name: "Martinique",
                code: "MQ",
            },
            {
                name: "Mauritania",
                code: "MR",
            },
            {
                name: "Mauritius",
                code: "MU",
            },
            {
                name: "Mayotte",
                code: "YT",
            },
            {
                name: "Mexico",
                code: "MX",
            },
            {
                name: "Micronesia, Federated States of",
                code: "FM",
            },
            {
                name: "Moldova, Republic of",
                code: "MD",
            },
            {
                name: "Monaco",
                code: "MC",
            },
            {
                name: "Mongolia",
                code: "MN",
            },
            {
                name: "Montserrat",
                code: "MS",
            },
            {
                name: "Morocco",
                code: "MA",
            },
            {
                name: "Mozambique",
                code: "MZ",
            },
            {
                name: "Myanmar",
                code: "MM",
            },
            {
                name: "Namibia",
                code: "NA",
            },
            {
                name: "Nauru",
                code: "NR",
            },
            {
                name: "Nepal",
                code: "NP",
            },
            {
                name: "Netherlands",
                code: "NL",
            },
            {
                name: "Netherlands Antilles",
                code: "AN",
            },
            {
                name: "New Caledonia",
                code: "NC",
            },
            {
                name: "New Zealand",
                code: "NZ",
            },
            {
                name: "Nicaragua",
                code: "NI",
            },
            {
                name: "Niger",
                code: "NE",
            },
            {
                name: "Nigeria",
                code: "NG",
            },
            {
                name: "Niue",
                code: "NU",
            },
            {
                name: "Norfolk Island",
                code: "NF",
            },
            {
                name: "Northern Mariana Islands",
                code: "MP",
            },
            {
                name: "Norway",
                code: "NO",
            },
            {
                name: "Oman",
                code: "OM",
            },
            {
                name: "Pakistan",
                code: "PK",
            },
            {
                name: "Palau",
                code: "PW",
            },
            {
                name: "Palestinian Territory, Occupied",
                code: "PS",
            },
            {
                name: "Panama",
                code: "PA",
            },
            {
                name: "Papua New Guinea",
                code: "PG",
            },
            {
                name: "Paraguay",
                code: "PY",
            },
            {
                name: "Peru",
                code: "PE",
            },
            {
                name: "Philippines",
                code: "PH",
            },
            {
                name: "Pitcairn",
                code: "PN",
            },
            {
                name: "Poland",
                code: "PL",
            },
            {
                name: "Portugal",
                code: "PT",
            },
            {
                name: "Puerto Rico",
                code: "PR",
            },
            {
                name: "Qatar",
                code: "QA",
            },
            {
                name: "Reunion",
                code: "RE",
            },
            {
                name: "Romania",
                code: "RO",
            },
            {
                name: "Russian Federation",
                code: "RU",
            },
            {
                name: "RWANDA",
                code: "RW",
            },
            {
                name: "Saint Helena",
                code: "SH",
            },
            {
                name: "Saint Kitts and Nevis",
                code: "KN",
            },
            {
                name: "Saint Lucia",
                code: "LC",
            },
            {
                name: "Saint Pierre and Miquelon",
                code: "PM",
            },
            {
                name: "Saint Vincent and the Grenadines",
                code: "VC",
            },
            {
                name: "Samoa",
                code: "WS",
            },
            {
                name: "San Marino",
                code: "SM",
            },
            {
                name: "Sao Tome and Principe",
                code: "ST",
            },
            {
                name: "Saudi Arabia",
                code: "SA",
            },
            {
                name: "Senegal",
                code: "SN",
            },
            {
                name: "Serbia and Montenegro",
                code: "CS",
            },
            {
                name: "Seychelles",
                code: "SC",
            },
            {
                name: "Sierra Leone",
                code: "SL",
            },
            {
                name: "Singapore",
                code: "SG",
            },
            {
                name: "Slovakia",
                code: "SK",
            },
            {
                name: "Slovenia",
                code: "SI",
            },
            {
                name: "Solomon Islands",
                code: "SB",
            },
            {
                name: "Somalia",
                code: "SO",
            },
            {
                name: "South Africa",
                code: "ZA",
            },
            {
                name: "South Georgia and the South Sandwich Islands",
                code: "GS",
            },
            {
                name: "Spain",
                code: "ES",
            },
            {
                name: "Sri Lanka",
                code: "LK",
            },
            {
                name: "Sudan",
                code: "SD",
            },
            {
                name: "Suriname",
                code: "SR",
            },
            {
                name: "Svalbard and Jan Mayen",
                code: "SJ",
            },
            {
                name: "Swaziland",
                code: "SZ",
            },
            {
                name: "Sweden",
                code: "SE",
            },
            {
                name: "Switzerland",
                code: "CH",
            },
            {
                name: "Syrian Arab Republic",
                code: "SY",
            },
            {
                name: "Taiwan, Province of China",
                code: "TW",
            },
            {
                name: "Tajikistan",
                code: "TJ",
            },
            {
                name: "Tanzania, United Republic of",
                code: "TZ",
            },
            {
                name: "Thailand",
                code: "TH",
            },
            {
                name: "Timor-Leste",
                code: "TL",
            },
            {
                name: "Togo",
                code: "TG",
            },
            {
                name: "Tokelau",
                code: "TK",
            },
            {
                name: "Tonga",
                code: "TO",
            },
            {
                name: "Trinidad and Tobago",
                code: "TT",
            },
            {
                name: "Tunisia",
                code: "TN",
            },
            {
                name: "Turkey",
                code: "TR",
            },
            {
                name: "Turkmenistan",
                code: "TM",
            },
            {
                name: "Turks and Caicos Islands",
                code: "TC",
            },
            {
                name: "Tuvalu",
                code: "TV",
            },
            {
                name: "Uganda",
                code: "UG",
            },
            {
                name: "Ukraine",
                code: "UA",
            },
            {
                name: "United Arab Emirates",
                code: "AE",
            },
            {
                name: "United Kingdom",
                code: "GB",
            },
            {
                name: "United States",
                code: "US",
            },
            {
                name: "United States Minor Outlying Islands",
                code: "UM",
            },
            {
                name: "Uruguay",
                code: "UY",
            },
            {
                name: "Uzbekistan",
                code: "UZ",
            },
            {
                name: "Vanuatu",
                code: "VU",
            },
            {
                name: "Venezuela",
                code: "VE",
            },
            {
                name: "Viet Nam",
                code: "VN",
            },
            {
                name: "Virgin Islands, British",
                code: "VG",
            },
            {
                name: "Virgin Islands, U.S.",
                code: "VI",
            },
            {
                name: "Wallis and Futuna",
                code: "WF",
            },
            {
                name: "Western Sahara",
                code: "EH",
            },
            {
                name: "Yemen",
                code: "YE",
            },
            {
                name: "Zambia",
                code: "ZM",
            },
            {
                name: "Zimbabwe",
                code: "ZW",
            },
        ];

        var country = document.getElementById("country");
        window.onload = () => {
            countryData.forEach((c) => {

                const option = document.createElement("option");
                option.value = c.name;
                option.textContent = c.name;
                if (c.name == '<?php echo $row['country'] ?>') {
                    option.setAttribute("selected", "selected");
                }
                country.appendChild(option);
            });
        };
    </script>
</body>

</html>