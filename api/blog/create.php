<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// получаем соединение с базой данных
include_once "../config/database.php";
include_once "../config/methods.php";

// создание объекта записи статьи
$database = new Database();
$db = $database->getConnection();
$product = new Admin($db);

// убеждаемся, что данные не пусты
if (
    !empty($_POST['user_name']) &&
    !empty($_POST['animal_name']) &&
    !empty($_POST['article_text']) &&
    !empty($_FILES['image_data'])
) {
    // устанавливаем значения свойств статьи
    $product->user_name = $_POST['user_name'];
    $product->animal_name = $_POST['animal_name'];
    $product->article_text = $_POST['article_text'];

    // Путь для сохранения загруженного изображения
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image_data"]["name"]);

    if (move_uploaded_file($_FILES["image_data"]["tmp_name"], $target_file)) {
        // Имя файла для вставки в базу данных
        $image_data = $target_file;

        // создание самой статьи
        if ($product->create($_POST['user_name'], $_POST['animal_name'], $_POST['article_text'], $image_data)) {
            // установим код ответа - 201 создано
            http_response_code(201);
            echo json_encode(array("message" => "Статья добавлена."), JSON_UNESCAPED_UNICODE);
        } else {
            // установим код ответа - 503 сервис недоступен
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно добавить статью."), JSON_UNESCAPED_UNICODE);
        }
    } else {
        // установим код ответа - 503 сервис недоступен
        http_response_code(503);
        echo json_encode(array("message" => "Ошибка загрузки изображения."), JSON_UNESCAPED_UNICODE);
    }
} else {
    // установим код ответа - 400 неверный запрос
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно добавить статью. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>