<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Part 2</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php
    if (!isset($_COOKIE['user_id'])) {
    ?>
        <form id="login_form" clas="form">
            <div class="error" id="error"></div>
            <label for="login">Введите логин</label>
            <input type="text" name="login" id="login"><br>
            <label for="login">Введите пароль</label>
            <input type="text" name="password" id="password"><br>
            <div class="btn">
                <input type="submit" class="submit" value="Login">
            </div>
            <div class="btn">
                <input type="submit" class="submit" value="Logup">
            </div>
        </form>
    <?php
        } else {
            echo '
                <script id="client_data" type="text/json">' . json_encode($_COOKIE['user_id']) 
                    . '</script>
            ';
        }
    ?>
    <script src="js/login.js"></script>
</body>

</html>