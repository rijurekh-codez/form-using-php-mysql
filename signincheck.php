
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
            $_SESSION['user'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            echo "<script>
  Toastify({
    text: 'Invalid Credentials!',
    duration: 3000,
    backgroundColor: 'linear-gradient(to right, #ff5f6d, #ffc3a0)',
    position: 'top-left',
    close: true,
  }).showToast();
</script>";
        }
    } else {
        echo "<script>
  Toastify({
    text: 'Invalid Credentials!',
    duration: 3000,
    backgroundColor: 'linear-gradient(to right, #ff5f6d, #ffc3a0)',
    position: 'top-right',
    close: true,
  }).showToast();
</script>";
    }

    $stmt->close();
    $conn->close();
}
?>