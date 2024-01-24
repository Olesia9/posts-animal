<?php

class Admin
{
    // подключение к базе данных и таблице "blog_posts"
    public $conn;
    private $table_name = "blog_posts";

    // свойства объекта
    public $id;
    public $user_name;
    public $animal_name;
    public $article_text;
    public $image_data;
    public $image_name;

    // конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // метод для создания данных статьи
    function create($user_name, $animal_name, $article_text, $image_data)
    {
        // запрос для вставки (создания) статьи
        $query = "INSERT INTO " . $this->table_name . " (user_name, animal_name, article_text, image_data) VALUES (?, ?, ?, ?)";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // привязка значений
        $stmt->bindParam("1", $user_name);
        $stmt->bindParam("2", $animal_name);
        $stmt->bindParam("3", $article_text);
        $stmt->bindParam("4", $image_data);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // метод для удаления статьи
    function delete()
    {
        // запрос для удаления статьи
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $this->id = htmlspecialchars(strip_tags($this->id));

        // привязываем id записи для удаления
        $stmt->bindParam(1, $this->id);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // метод для получения статей
    function read()
    {
        // выбираем все записи
        $query = "SELECT * FROM " . $this->table_name;

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // выполняем запрос
        $stmt->execute();
        return $stmt;
    }
}