<?php
session_start(); // Розпочинаємо сесію для зберігання та використання даних сесії
require_once 'includes/connect.php';

if (!isset($_SESSION['user'])) { //Перевіряємо, чи у сесії користувач авторизований
    header('Location: ../login.php'); //Якщо ні, то переправляємо на сторінку login.php
} elseif ($_SESSION['user']['permission']  != "admin") {
    // // Якщо користувач авторизований, але його рівень дозволу не є "admin", виводимо повідомлення і завершуємо виконання скрипту
    die("<p>You are not admin</p>");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Додати товар</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Шрифт Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google шрифт -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="/css/login.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 order-md-1 mt-5">
                <!-- Заголовок додавання  -->
                <h4 class="mb-3 text-center">Add smartphone</h4>
                <!-- Форма для додавання  -->
                <form class="needs-validation" novalidate="" id="smartphone" action="includes/addmob.php" method="post" enctype="multipart/form-data">
                    <!-- Ряд для елементів форми -->
                    <div class="row">
                        <!-- Колонка для вибору виробника (vendor) -->
                        <div class="col-md-3 mb-3">
                            <!-- Випадаючий список для вибору виробника -->
                            <label for="vendor">Vendor:</label>
                            <select class="custom-select d-block" name="vendor" id="vendor" form="smartphone">
                                <?php
                                // Запит до бази даних для отримання списку виробників
                                $querry = "SELECT * FROM vendor_list";
                                $result = mysqli_query($connect, $querry);
                                // Виведення опцій випадаючого списку на основі результатів запиту
                                while ($row_vendor = mysqli_fetch_array($result)) {
                                    echo ("<option value=" . $row_vendor['id_vendor'] . ">" . $row_vendor['name'] . "</option>");
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Колонка  для введення моделі  -->
                        <div class="col-md-3 mb-3">
                            <!-- Мітка для поля вводу моделі  -->
                            <label for="model">Model:</label>
                            <!-- Поле вводу для введення моделі  -->
                            <input type="text" class="form-control" id="model" value="" required name="model" placeholder="Galaxy t-shirt ">
                            <!-- Повідомлення про помилку, яке виводиться, якщо введена модель недійсна -->
                            <div class="invalid-feedback">
                                Valid model is required.
                            </div>
                
                    <div class="row">
                        <!-- Ідентично з ціною -->
                        <div class="col-md-2 mb-3">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" id="price" value="" required="" name="price" placeholder="4000">
                            <div class="invalid-feedback">
                                Valid price is required.
                            </div>
                        </div>
                        <!-- Ідентично з типами мережива -->
                        <div class="col-md-4 mb-3">
                            <label for="gsm">Network types:</label>
                            <div class="invalid-feedback">
                                Valid gsm is required.
                            </div>
                        </div>
                        <!-- Ідентично з фото -->
                        <div class="col-md-6 mb-3">
                            <label for="foto">Foto:</label>
                            <input type="file" class="form-control-file" id="foto" value="" required="" name="foto" placeholder="foto">
                            <div class="invalid-feedback">
                                Valid foto is required.
                            </div>
                        </div>
                            
                    </div>
                    <!-- Виведення повідомлення про успішність дії або помилку -->
                    <p><?php echo(isset($_SESSION['message'])); unset($_SESSION['message']); ?></p>
                    <!-- Горизонтальна лінія для відділення блоків у формі -->
                    <hr class="mb-4">
                    <!-- Кнопка для відправлення форми або виконання іншої дії (додавання ) -->
                    <button class="btn btn-primary btn-lg btn-block greenbtn" type="submit">Add</button>
                    <!-- Посилання на домашню сторінку -->
                    <a class="btn btn-primary btn-lg btn-block" href="index.php">Home</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
