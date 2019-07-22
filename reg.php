<?= include 'validation/head.php' ?>
    <body>
        <div class="meeting">
            <h1>Регистрация</h1>
            <form action="validation/check.php" method="post">
                <input type="text" name="login" required placeholder="Login" /><br/>
                <input type="password" name="pass" required placeholder="password" /><br/>
                <input type="email" name="email" required placeholder="email" /><br/>
                <button type="submit">Добавить</button><br/>
                <a href="index.html"> Авторизация</a></p>
            </form>
        </div>
    </body>
</html>
