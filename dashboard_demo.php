<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: signin.php');
    exit;
}
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'db.php';

$username = $_SESSION['user'];

$sql = "SELECT * FROM Persons WHERE username = '$username'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();
$activeWorksheet->setCellValue('A1', 'First name');
$activeWorksheet->setCellValue('B1', 'Last name');
$activeWorksheet->setCellValue('C1', 'Username');
$activeWorksheet->setCellValue('D1', 'Email');
$activeWorksheet->setCellValue('E1', 'Phone number');
$activeWorksheet->setCellValue('F1', 'Gender');
$activeWorksheet->setCellValue('G1', 'Street');
$activeWorksheet->setCellValue('H1', 'City');
$activeWorksheet->setCellValue('I1', 'State');
$activeWorksheet->setCellValue('J1', 'Country');
$activeWorksheet->setCellValue('K1', 'Zipcode');
$activeWorksheet->setCellValue('L1', 'Languages');


$spreadsheet->getActiveSheet()->getStyle('A1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('9400D3');
$spreadsheet->getActiveSheet()->getStyle('B1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('4B0082');
$spreadsheet->getActiveSheet()->getStyle('C1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('0000FF');
$spreadsheet->getActiveSheet()->getStyle('D1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('00FF00');
$spreadsheet->getActiveSheet()->getStyle('E1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF00');
$spreadsheet->getActiveSheet()->getStyle('F1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FF7F00');
$spreadsheet->getActiveSheet()->getStyle('G1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FF0000');
$spreadsheet->getActiveSheet()->getStyle('H1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('9400D3');
$spreadsheet->getActiveSheet()->getStyle('I1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('4B0082');
$spreadsheet->getActiveSheet()->getStyle('J1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('0000FF');
$spreadsheet->getActiveSheet()->getStyle('K1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('00FF00');
$spreadsheet->getActiveSheet()->getStyle('L1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF00');

$row = 1;
$col = 0;

$rowss;
while ($value = $result->fetch_assoc()) {
    $row++;
    $col = 65;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['firstname']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['lastname']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['username']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['email']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['phoneno']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['gender']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['street']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['city']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['state']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['country']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['zipcode']);
    $col++;
    $activeWorksheet->setCellValue(chr($col) . $row, $value['languages']);
    $rowss = $value;
}

$image_paths = explode(',', $rowss['image_path']);
$first_image = $image_paths[0];


$writer = new Xlsx($spreadsheet);
$filename = $username . ".xlsx";
$writer->save("output/" . $filename);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


</head>

<body class="px-4 mt-2 flex justify-center">

    <div class="border-2 border-gray-300 rounded-lg p-5 w-200 bg-gray-100">
        <div class="flex flex flex-col md:flex-row items-center gap-4 mb-7  ">
            <img class="w-[150px] rounded-full mt-2" src="<?php echo $first_image ?>" alt="Profile Picture">

            <div>
                <p class="text-[30px] font-semibold"><?php echo $rowss['firstname'] . ' ' . $rowss['lastname']; ?></p>
                <p class="text-[16px] text-gray-600"><?php echo '@' . $rowss['username'] ?></p>
                <div class="mt-2 flex gap-2">

                    <a href="update.php" class=" text-black border-1 px-3 py-1 rounded-sm text-[14px] text-center">Update Profile</a>


                    <a href="logout.php" class="bg-black text-white px-3 py-1 rounded-sm text-[14px] text-center">Log Out</a>

                    <a class="bg-green-600 text-white px-3 py-1 rounded-sm text-[14px] text-center" href="output/<?php echo $filename; ?>">Download Excel</a>

                    <!-- <form action="export_sheet.php" method="post">
                        <button type="submit" name="export_excel" class="bg-green-600 cursor-pointer  text-white px-3 py-1 pb-2 rounded-sm text-[14px] text-center">Export sheet</buttom>
                    </form> -->
                </div>
            </div>

            <!-- details -->

        </div>
        <div class="grid lg:grid-cols-2 md:grid-cols-2 gap-4 sm:grid-cols-2 xs:grid-cols-1 gap-4">

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
                <p class="mb-3 text-[17px] font-small"><?php echo $rowss['email'] ?></p>


                <div class="text-center flex items-center gap-2">
                    <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg>
                    <p class="text-gray-600">Phone No</p>
                </div>
                <p class="mb-3 text-[17px] font-small"><?php echo $rowss['phoneno'] ?></p>


                <?php if ($rowss["add_phoneno"] != null) { ?>
                    <div class="text-center flex items-center gap-2">
                        <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        </svg>
                        <p class="text-gray-600">Additional Phone No</p>
                    </div>
                    <p class="mb-3 text-[17px] font-small"><?php echo $rowss["add_phoneno"]; ?></p>
                <?php } ?>

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
                <p class="mb-3 text-[17px] font-small"><?php echo $rowss['gender'] ?></p>

                <div class="text-center flex items-center gap-2">
                    <svg class="h-6 w-6 text-gray-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M5 7h7m-2 -2v2a5 8 0 0 1 -5 8m1 -4a7 4 0 0 0 6.7 4" />
                        <path d="M11 19l4 -9l4 9m-.9 -2h-6.2" />
                    </svg>
                    <p class="text-gray-600">Languages</p>
                </div>
                <p class="mb-3 text-[17px] font-small"><?php if (isset($rowss['languages'])) print_r($rowss['languages']) ?></p>
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
                <p class="mb-3 text-[17px] font-small"><?php echo $rowss['street'] ?></p>


                <div class="text-center flex items-center gap-2">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <p class="text-gray-600">City</p>
                </div>
                <p class="mb-3 text-[17px] font-small"><?php echo $rowss['city'] ?></p>


                <div class="text-center flex items-center gap-2">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <p class="text-gray-600">State</p>
                </div>

                <p class="mb-3 text-[17px] font-small"><?php echo $rowss['state'] ?></p>


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
                <p class="mb-3 text-[17px] font-small"><?php echo $rowss['country'] ?></p>


                <div class="text-center flex items-center gap-2">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p class="text-gray-600">Zip code</p>
                </div>
                <p class="mb-3 text-[17px] font-small"><?php echo $rowss['zipcode'] ?></p>
            </div>
        </div>
    </div>





</body>

</html>