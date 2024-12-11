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

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $search = mysqli_real_escape_string($conn, $search); 

    $sql = "SELECT * FROM Books WHERE
            Номер LIKE '%$search%' OR
            Наименование LIKE '%$search%' OR
            Автор LIKE '%$search%' OR
            Жанр LIKE '%$search%' OR
            Год_издания LIKE '%$search%' OR
            Издательство LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<ul>"; // Начало списка
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>
                    Номер: " . $row['Номер'] . ", 
                    Наименование: " . $row['Наименование'] . ", 
                    Автор: " . $row['Автор'] . ", 
                    Жанр: " . $row['Жанр'] . ", 
                    Год издания: " . $row['Год_издания'] . ", 
                    Издательство: " . $row['Издательство'] . "
                  </li>";
        }
        echo "</ul>"; // Конец списка
    } else {
        echo "Результатов не найдено";
    }
} else {
    echo "Запрос на поиск не предоставлен";
}
?>