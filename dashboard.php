<?php

include 'db.php';

$limit = 100;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM OutageData LIMIT {$offset},{$limit};";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$tmp = [];
while ($row = $result->fetch_assoc()) {
    $tmp[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="pagination.css">
</head>

<body class="bg-gray-100 p-2">

    <div class="overflow-auto max-h-[70vh] max-w-full border border-gray-500">
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
    </div>

    <div class="pagination-container">
        <ul class="pagination">
            <?php
            $sql1 = "SELECT * FROM OutageData;";
            $result1 = mysqli_query($conn, $sql1) or die("Query failed");

            if (mysqli_num_rows($result1) > 0) {
                $total_records = mysqli_num_rows($result1);
                $total_page = ceil($total_records / $limit);
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                if ($current_page > 1) {
                    echo '<li><a href="dashboard.php?page=' . ($current_page - 1) . '"><< Prev</a></li>';
                }

                $start = max(1, $current_page - 1);

                $end = min($total_page, $current_page + 1);

                for ($i = $start; $i <= $end; $i++) {
                    $active = ($i == $current_page) ? 'active' : '';
                    echo '<li><a class="' . $active . '" href="dashboard.php?page=' . $i . '">' . $i . '</a></li>';
                }

                if ($current_page < $total_page) {
                    echo '<li><a href="dashboard.php?page=' . ($current_page + 1) . '">Next >></a></li>';
                }
            }
            ?>
        </ul>
    </div>

    <form action="import_sheet.php" method="post" enctype="multipart/form-data" style="display: inline;">
        <input type="file" name="file" accept=".xls,.xlsx" required class="p-1 border border-black">
        <button class="bg-black text-white px-3 py-1  rounded-sm text-[14px] mt-4 inline-block" type="submit" name="submit">Export Excel</button>
    </form>
    <form action="export_sheet.php" method="post" enctype="multipart/form-data" style="display: inline;">
        <button class="bg-green-600 text-white px-3 py-1 rounded-sm text-[16px] mt-4 inline-block" type="submit" name="export_submit">Export Excel</button>
    </form>

    <!-- <a class="bg-green-600 text-white px-3 py-1 rounded-sm text-[16px] mt-4 inline-block" href="output/">Download Excel</a> -->



</body>

</html>