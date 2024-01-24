<?php
//вывод в json
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключение базы данных и файл, содержащий объекты
include_once "../config/database.php";
include_once "../config/methods.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$product = new Admin($db);

// запрашиваем статьи
$stmt = $product->read();
$num = $stmt->rowCount();

// проверка, найдено ли больше 0 записей
if ($num > 0) {
    // массив статей
    $products_arr = array();
    $products_arr["data"] = array();

    // получаем содержимое нашей таблицы
    // fetch() быстрее, чем fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // извлекаем строку
        array_push($products_arr["data"], $row);
    }

    // устанавливаем код ответа - 200 OK
    http_response_code(200);

    // выводим данные о статьях в формате JSON
    echo json_encode($products_arr);
} // "статьи не найдены"
else {
    // установим код ответа - 404 Не найдено
    http_response_code(404);

    // сообщаем пользователю, что статьи не найдены
    echo json_encode(array("message" => "Записи пациентов не найдены."), JSON_UNESCAPED_UNICODE);
}