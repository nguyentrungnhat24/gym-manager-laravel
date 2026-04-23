<?php
// Giải thích timestamp 1753518648
$timestamp = 1753518648;
$date = date('Y-m-d H:i:s', $timestamp);
echo "Timestamp: " . $timestamp . "\n";
echo "Ngày giờ: " . $date . "\n";

// Tạo timestamp hiện tại
$currentTimestamp = time();
echo "Timestamp hiện tại: " . $currentTimestamp . "\n";
echo "Ngày giờ hiện tại: " . date('Y-m-d H:i:s', $currentTimestamp) . "\n";

// Ví dụ tên file
$originalName = "fine.jpg";
$fileName = $timestamp . "_" . $originalName;
echo "Tên file: " . $fileName . "\n";
?> 