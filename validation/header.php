<header>
    <div class="logo">
        <a href="/projects.php">Bugtracking</a>
    </div>
    <div class="quit">
        <?php
        echo $_SESSION["user_obj"]->login;
        ?>
        <a href='validation/quit.php'> Выйти </a>
    </div>
</header>
