<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анкета</title>
</head>
<body>
    <section class="form_action">
        <h1>Анкета</h1>
        <form action="action.php" method="POST" enctype="multipart/form-data">
        <p>
            <input type="text" placeholder="Имя" name="name">
        </p>
        <p>
            <input type="text" placeholder="Фамилия" name="surname">
        </p>
        <p>
            <input type="text" placeholder="Отчество" name="secondname">
        </p>
        <p>
            <input type="text" placeholder="Email" name="email">
        </p>
        <p>
            <input type="text" placeholder="Phone" name="phone">
        </p>
        <p>
            <textarea name="about" id="about" cols="30" rows="10" placeholder="О себе:"></textarea>
        </p>
        <p>
            <input type="file" name="file">
        </p>
            <button type="submit">Отправить</button>
        </form>
    </section>
</body>
</html>