<?php
// user-data.php

// دریافت داده‌ها از فرم یا جاوااسکریپت
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$status = $_POST['status'] ?? 'registered'; // registered | subscribed | completed_profile
$date = date("Y-m-d H:i:s");

// بررسی اینکه اطلاعات خالی نباشن
if (!$username || !$email) {
  echo json_encode(['success' => false, 'message' => 'فیلدهای ضروری خالی هستند.']);
  exit;
}

// آماده‌سازی اطلاعات برای ذخیره
$userData = [
  'username' => $username,
  'email' => $email,
  'status' => $status,
  'date' => $date
];

// تبدیل به رشته JSON
$json = json_encode($userData);

// ذخیره در یک فایل
file_put_contents('users.json', $json . PHP_EOL, FILE_APPEND);

// پاسخ به کاربر
echo json_encode(['success' => true, 'message' => 'اطلاعات ذخیره شد.']);
?>
