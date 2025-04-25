<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $phone = $_POST['phone'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];

    $newUser = [
        "phone" => $phone,
        "fullname" => $fullname,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ];

    $file = 'users.json';
    $users = [];

    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $users = json_decode($jsonData, true);
    }

    $users[] = $newUser;

    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    header("Location: thankyou.html");
    exit;
} else {
    echo "دسترسی غیرمجاز 🚫";
}
?>


