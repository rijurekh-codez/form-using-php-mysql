<?php
ini_set('memory_limit', '1024M');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'db.php';

if (isset($_POST['export_submit'])) {

    $downloadQuery = "SELECT *from OutageData";
    $stmt = $conn->prepare($downloadQuery);
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
    header("location:output/" . $filename);
}
