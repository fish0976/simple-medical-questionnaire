<?php
// 数据库配置
$servername = "localhost";
$dbname = "cleanhome_top_22";
$username = "cleanhome_top_22";
$password = "py38bx6cre"; // 你的数据库密码

try {
    // 连接数据库
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 获取表单数据
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 加密存储密码
    $gender = $_POST['gender'] ?? null;
    $hobbies = isset($_POST['hobbies']) ? implode(',', $_POST['hobbies']) : '';
    $city = $_POST['city'] ?? '';
    $intro = $_POST['intro'] ?? '';

    // 插入数据
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, gender, hobbies, city, intro) 
                          VALUES (:name, :email, :password, :gender, :hobbies, :city, :intro)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':hobbies', $hobbies);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':intro', $intro);
    $stmt->execute();

    echo "注册成功！";
} catch(PDOException $e) {
    echo "错误: " . $e->getMessage();
}
$conn = null;
?>