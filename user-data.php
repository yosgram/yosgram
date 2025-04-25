<?php
// بررسی اینکه اطلاعات از طریق POST فرستاده شده
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $phone = $_POST['phone'] ?? '';
    $fullname = $_POST['fullname'] ?? '';
    $password = $_POST['password'] ?? '';

    // بررسی اینکه اطلاعات خالی نباشن
    if (!$phone || !$fullname || !$password) {
        echo json_encode(['success' => false, 'message' => 'همه‌ی فیلدها باید پر شوند.']);
        exit;
    }

    // ساخت آرایه اطلاعات کاربر
    $newUser = [
        "phone" => $phone,
        "fullname" => $fullname,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "date" => date("Y-m-d H:i:s")
    ];

    $file = 'users.json';
    $users = [];

    // اگر فایل از قبل وجود داشت، بخونش
    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $users = json_decode($jsonData, true) ?: [];
    }

    // افزودن کاربر جدید به لیست
    $users[] = $newUser;

    // ذخیره مجدد فایل
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // پاسخ موفق
    echo json_encode(['success' => true, 'message' => 'اطلاعات با موفقیت ذخیره شد.']);
} else {
    echo json_encode(['success' => false, 'message' => 'درخواست نامعتبر.']);
}
?>
