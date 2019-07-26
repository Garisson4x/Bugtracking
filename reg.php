<?= include 'validation/head.php' ?>
    <body>
        <div class="meeting">
            <p class="glav">Регистрация</p>
            <div class="login">
                <form action="validation/check.php" method="post">
                    <p>
                    <strong>Логин:</strong>
                    <input type="text" name="login" required placeholder="Login" /></p>
                    <p>
                    <strong>Пароль:</strong>
                    <input type="password" name="pass" required placeholder="password" /></p>
                    <p>
                    <strong>Почта:</strong>
                    <input type="email" name="email" required placeholder="email" /></p>
                    <div>
                        <button class="enter" type="submit">Добавить</button>
                    </div>
                    <a class="registr" href="index.html"> Авторизация</a></p>
                </form>
            </div>
        </div>
    </body>
</html>
