<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>GUI</title>
    <link rel="stylesheet" href="../style/all.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/add.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header class="header">
    <div class="header__container">
        <span class="header__title">Animal post</span>
        <a class="header__link" href="../index.php">Вернуться к статьям</a>
    </div>
</header>
<main class="container posts">
    <section class="posts__add">
        <div class="posts__add-title">
            <span class="posts__title">Добавление статьи</span>
        </div>
        <div class="posts__add-form">
            <form class="posts__form" id="form">
                <div class="posts__input-container">
                    <label class="posts__label">Ваше имя</label>
                    <input class="posts__input" required name="user_name">
                </div>
                <div class="posts__input-container">
                    <label class="posts__label">Имя питомца</label>
                    <input class="posts__input" required name="animal_name">
                </div>
                <div class="posts__input-container">
                    <label class="posts__label">Информация о питомце</label>
                    <input class="posts__input" required name="article_text">
                </div>
                <div class="posts__input-container">
                    <input required id="file" type="file" name="image_data">
                </div>
                <button class="posts__btn-submit" type="submit">Опубликовать</button>
            </form>
        </div>
    </section>
</main>
<script src="../js/add-post.js"></script>
</body>
</html>