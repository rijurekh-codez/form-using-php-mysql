<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'db.php';

$sql = "SELECT * FROM OutageData;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$tmp = [];
while ($row = $result->fetch_assoc()) {
    $tmp[] = $row;
}

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

$activeWorksheet->setCellValue('A1', 'ID');
$activeWorksheet->setCellValue('B1', 'Circle');
$activeWorksheet->setCellValue('C1', 'Entity');
$activeWorksheet->setCellValue('D1', 'Outage Month');
$activeWorksheet->setCellValue('E1', 'State');
$activeWorksheet->setCellValue('F1', 'Cluster');
$activeWorksheet->setCellValue('G1', 'Site ID');
$activeWorksheet->setCellValue('H1', 'ERP ID');
$activeWorksheet->setCellValue('I1', 'Site Name');
$activeWorksheet->setCellValue('J1', 'Category');
$activeWorksheet->setCellValue('K1', 'Sub Category');
$activeWorksheet->setCellValue('L1', 'Tenant Onair Date');
$activeWorksheet->setCellValue('M1', 'Operator Name');
$activeWorksheet->setCellValue('N1', 'Operator Product');
$activeWorksheet->setCellValue('O1', 'Operator ID');
$activeWorksheet->setCellValue('P1', 'Vendor Name');
$activeWorksheet->setCellValue('Q1', 'IP Fee');
$activeWorksheet->setCellValue('R1', 'Signoff IP Slab');
$activeWorksheet->setCellValue('S1', 'Signoff Circle Customer Uptime');
$activeWorksheet->setCellValue('T1', 'Site Outage Mins');
$activeWorksheet->setCellValue('U1', 'Signoff Uptime');
$activeWorksheet->setCellValue('V1', 'Signoff Penalty');
$activeWorksheet->setCellValue('W1', 'Signoff Reward');
$activeWorksheet->setCellValue('X1', 'Cost of FO Loss Outage Mins');
$activeWorksheet->setCellValue('Y1', 'Status');


$row = 2;

foreach ($tmp as $value) {
    $activeWorksheet->setCellValue('A' . $row, $value['id']);
    $activeWorksheet->setCellValue('B' . $row, $value['Circle']);
    $activeWorksheet->setCellValue('C' . $row, $value['Entity']);
    $activeWorksheet->setCellValue('D' . $row, $value['OutageMonth']);
    $activeWorksheet->setCellValue('E' . $row, $value['State']);
    $activeWorksheet->setCellValue('F' . $row, $value['Cluster']);
    $activeWorksheet->setCellValue('G' . $row, $value['SiteID']);
    $activeWorksheet->setCellValue('H' . $row, $value['ERPID']);
    $activeWorksheet->setCellValue('I' . $row, $value['SiteName']);
    $activeWorksheet->setCellValue('J' . $row, $value['Category']);
    $activeWorksheet->setCellValue('K' . $row, $value['SubCategory']);
    $activeWorksheet->setCellValue('L' . $row, $value['TenantOnairDate']);
    $activeWorksheet->setCellValue('M' . $row, $value['OperatorName']);
    $activeWorksheet->setCellValue('N' . $row, $value['OperatorProduct']);
    $activeWorksheet->setCellValue('O' . $row, $value['OperatorID']);
    $activeWorksheet->setCellValue('P' . $row, $value['VendorName']);
    $activeWorksheet->setCellValue('Q' . $row, $value['IPFee']);
    $activeWorksheet->setCellValue('R' . $row, $value['SignoffIPSlab']);
    $activeWorksheet->setCellValue('S' . $row, $value['SignoffCircleCustomerUptime']);
    $activeWorksheet->setCellValue('T' . $row, $value['SiteOutageMins']);
    $activeWorksheet->setCellValue('U' . $row, $value['SignoffUptime']);
    $activeWorksheet->setCellValue('V' . $row, $value['SignoffPenalty']);
    $activeWorksheet->setCellValue('W' . $row, $value['SignoffReward']);
    $activeWorksheet->setCellValue('X' . $row, $value['CostOfFOLossOutageMins']);
    $activeWorksheet->setCellValue('Y' . $row, $value['Status']);
    $row++;
}

$filename = "outage_data.xlsx";
$writer = new Xlsx($spreadsheet);
$writer->save("output/" . $filename);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <table class="min-w-full table-auto bg-white border-collapse shadow-lg rounded-md">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Id</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Circle</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Entity</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Outage Month</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">State</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Cluster</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Site ID</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">ERP ID</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Site Name</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Category</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Sub Category</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Tenant Onair Date</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Operator Name</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Operator Product</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Operator ID</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Vendor Name</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">IP Fee</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Signoff IP Slab</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Signoff Circle Customer Uptime</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Site Outage Mins</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Signoff Uptime</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Signoff Penalty</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Signoff Reward</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600 border border-gray-400 border-t-0 border-l-0 border-r-1 border-b-0">Cost of FO Loss Outage Mins</th>
                <th class="px-3 py-1 text-left text-sm font-semibold text-gray-600">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tmp as $row): ?>
                <tr class="border-t border-gray-200">
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['id']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['Circle']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['Entity']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['OutageMonth']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['State']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['Cluster']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['SiteID']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['ERPID']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['SiteName']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['Category']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['SubCategory']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['TenantOnairDate']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['OperatorName']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['OperatorProduct']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['OperatorID']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['VendorName']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['IPFee']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['SignoffIPSlab']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['SignoffCircleCustomerUptime']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['SiteOutageMins']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['SignoffUptime']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['SignoffPenalty']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['SignoffReward']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700 border border-gray-300 border-t-0 border-l-0 border-r-1 border-b-0"><?php echo htmlspecialchars($row['CostOfFOLossOutageMins']); ?></td>
                    <td class="px-3 py-1 text-sm text-gray-700"><?php echo htmlspecialchars($row['Status']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a class="bg-green-600 text-white px-3 py-1 rounded-sm text-[14px] mt-4 inline-block" href="output/<?php echo $filename; ?>">Download Excel</a>

</body>

</html>