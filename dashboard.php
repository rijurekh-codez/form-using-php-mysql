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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="px-4">


    <div class="flex items-center gap-4">
        <img class="w-[150px] rounded-full mt-2" src="<?php echo 'Uploads/' . $row['image_path']; ?>" alt="">

        <div>
            <p class="text-[30px] fomt-medium"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></p>
            <p class="text-[18px] font-medium text-gray-600"><?php echo '@' . $row['username'] ?></p>
            <div class="mt-2">
                <a href="logout.php" class="bg-black text-white px-3 py-1 rounded-sm ">Log Out</a>
            </div>
        </div>

        <!-- details -->

    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>

            <p class="text-[20px] font-medium text-gray-800">Personal Information: </p>

            <p>Email</p>
            <p><?php echo $row['email'] ?></p>
            <p>Phone No</p>
            <p><?php echo $row['phoneno'] ?></p>
            <p>Gender</p>
            <p><?php echo $row['gender'] ?></p>
            <p>Language</p>
            <p><?php echo $row['language'] ?></p>
        </div>
        <div>
            <p class="text-[20px] font-medium text-gray-800">Address: </p>
            <p>Street</p>
            <p><?php echo $row['street'] ?></p>
            <p>City</p>
            <p><?php echo $row['city'] ?></p>
            <p>State</p>
            <p><?php echo $row['state'] ?></p>
            <p>Country</p>
            <p><?php echo $row['country'] ?></p>
            <p>Zip code</p>
            <p><?php echo $row['zipcode'] ?></p>
        </div>
    </div>





</body>

</html>