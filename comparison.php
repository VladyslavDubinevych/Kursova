<?php
session_start(); // Розпочинаємо сесію для зберігання та використання даних сесії
require_once 'includes/connect.php'; // Підключаємо файл для встановлення з'єднання з базою даних
// Перевірка наявності сесійної змінної для зберігання 
if (!isset($_SESSION['comp'])) {
    // Якщо змінної немає, створюємо пустий масив
    $_SESSION['comp'] = array();
}
// Перевірка, чи було відправлено ідентифікатор для порівняння через POST-запит
if (isset($_POST['id_mob'])) {
    // Отримання ідентифікатора пристрою з POST-запиту
    $id = $_POST['id_mob'];
    // Перевірка
    foreach ($_SESSION['comp'] as $row) {
        // Якщо так, перенаправлення на головну сторінку та завершення виконання скрипта
        if ($row == $id) {
            header('Location: index.php');
            die();
        }
    }
    // Додавання ідентифікатора
    array_push($_SESSION['comp'], $id);
    // Перенаправлення на головну сторінку та завершення виконання скрипта
    header('Location: index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Система з вибору </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Шрифт Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google шрифт -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<header>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <!-- Заголовок з посиланням на головну сторінку -->
        <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/">Вибір</a></h5>
        <!-- Поле для введення тексту пошуку -->
        <div class="md-form active-purple-4 col-lg-4">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
        </div>
        <!-- Навігаційне меню з посиланнями на сторінки порівнянь та закладок -->
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="comparison.php">Comparison</a>
            <a class="p-2 text-dark" href="bookmarks.php">Bookmarks</a>
        </nav>
        <!-- Блок для відображення інформації про користувача або посилання на авторизацію -->
        <?php
        if (isset($_SESSION['user'])) {
            // Якщо так, виведення блоку з посиланням на профіль користувача
            echo ("<a class='btn btn-outline-primary col-lg-1' href='profile.php'>Account(" . $_SESSION['user']['name'] . ")</a>");
        } else {
            // Якщо ні, виведення блоку з посиланням на сторінку авторизації
            echo ("<a class='btn btn-outline-primary col-lg-1' href='login.php'>Sign in</a>");
        }
        ?>

    </div>
</header>
<!-- Форма для видалення обраного для порівняння списку -->
<div class="container">
    <form action="/includes/kostul.php" method="post">
        <!-- Приховане поле для передачі ідентифікатора операції в обробник -->
        <input type="hidden" name="rmcomp" value="xyz">
        <!-- Кнопка для відправлення форми та виклику обробника для видалення порівнянь -->
        <button class="btn btn-outline-primary btn-lg btn-block mb-3" type="submit">Clear comparison</button>
    </form>
    <!-- Таблиця для відображення заголовків  -->
    <table class="table">
        <thead class="thead-light">
        <tr>
            <?php
            // Цикл для виведення заголовків колонок 
            foreach ($_SESSION['comp'] as $row) {
                // Запит до бази даних для отримання інформації за його ідентифікатором
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                // Виведення заголовків колонок на основі результату запиту
                while ($raw = mysqli_fetch_array($res)) {
                    echo ("<th scope='col'>" . $raw['name'] . " " . $raw['model'] . "</th>");
                }
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
            // Цикл для виведення значень фотографії 
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                while ($raw = mysqli_fetch_array($res)) {
                    echo ("<th scope='col'><img src='" . $raw['img'] . "' alt='' style='width: 100px'></th>");
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень 
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                while ($raw = mysqli_fetch_array($res)) {
                    
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень 
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                while ($raw = mysqli_fetch_array($res)) {
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень параметра 
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            foreach ($_SESSION['comp'] as $row) {
                // Цикл для виведення значень параметра 'ram' для порівнюваних мобільних пристроїв
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                 
            }
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень 
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
            }
               
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень параметра 'battery' для порівнюваних мобільних пристроїв
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                
                }
            
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень 
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                while ($raw = mysqli_fetch_array($res)) {
                    echo ("<td>" . $raw['weight'] ."g</td>");
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень 
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                while ($raw = mysqli_fetch_array($res)) {
                    echo ("<td>" . $raw['gsm'] ."</td>");
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень 
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                while ($raw = mysqli_fetch_array($res)) {
                    echo ("<td>" . $raw['os'] ."</td>");
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень параметра 'price'
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
                while ($raw = mysqli_fetch_array($res)) {
                    echo ("<td>" . $raw['price'] ." UAH </td>");
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень параметра 
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
               
            }
            ?>
        </tr>
        <tr>
            <?php
            // Цикл для виведення значень параметра 
            foreach ($_SESSION['comp'] as $row) {
                $query = "SELECT * FROM clothes INNER JOIN vendor_list v ON vendor = v.id_vendor WHERE id = $row";
                $res = mysqli_query($connect, $query);
            }
            ?>
        </tr>
       
        </tbody>
    </table>
</div>
</body>
</html>
