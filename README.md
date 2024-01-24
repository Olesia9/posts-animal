1. Создаем таблицу (использую phpMyAdmin)

```CREATE TABLE blog_posts (
id INT AUTO_INCREMENT PRIMARY KEY,
user_name TEXT,
animal_name TEXT,
article_text TEXT,
image_data LONGBLOB,
image_name VARCHAR(255)
);
```

Объяснение:  
Для сохранения изображений в базе данных, использую тип данных BLOB (Binary Large Object).  
image_data - это тип данных BLOB, который хранит бинарные данные изображения  
image_name - это строка, которая будет хранить имя файла изображения

Изображение сохранится в бд с помощью ``INSERT``

Запросы для postman

1. Read
```angular2html
curl --location 'http://localhost/posts-animal/api/blog/read.php'
```

2. Create
```angular2html
curl --location 'http://localhost/posts-animal/api/blog/create.php' \
--form 'user_name="Анна"' \
--form 'animal_name="Мия"' \
--form 'article_text="Это моя коза Мия. Ей 2 года. Она отлично поддается дресировке и любит яблоки."' \
--form 'image_data=@"postman-cloud:///1eeb7768-8090-4320-9866-5e36da5bf6b6"'
```

3. Delete
```angular2html
curl --location 'http://localhost/posts-animal/api/blog/delete.php' \
--header 'Content-Type: application/json' \
--data '{
    "id": 10
}'
```