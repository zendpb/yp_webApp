<?php
$servername = "127.0.0.1"; // или ваш сервер
$username = "root"; // замените на ваше имя пользователя
$password = ""; // замените на ваш пароль
$dbname = "myTestDb"; // замените на имя вашей базы данных

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $login = $_POST['login'];
    $password = $_POST['password'];

    // SQL запрос для проверки существования логина
    $sql = "SELECT `Пароль` FROM `login` WHERE `Логин` = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Логин существует, проверяем пароль
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Пароль'])) {
            // Пароль верный, перенаправляем на search.html
            echo "<script>
                    window.location.href = 'search.html';
                    
                  </script>";
        } else {
            // Неправильный пароль
            echo "<script>
                    alert('Неправильный пароль');
                    window.location.href = 'login.html';
                  </script>";
        }
    } else {
        // Логин не существует
        echo "<script>
                alert('Такого логина нету, зарегистрируйтесь');
                window.location.href = 'login.html';
              </script>";
    }
}

$conn->close(); // Закрываем соединение
?>