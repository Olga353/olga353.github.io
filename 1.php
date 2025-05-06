<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Авторизація через Telegram</title>
</head>
<body>
<h1>Авторизація через Telegram</h1>
<p>Натисніть кнопку нижче, щоб авторизуватись:</p>

<!-- Telegram кнопка -->
<script async src="https://telegram.org/js/telegram-widget.js?22"
        data-telegram-login="NameNestBot"
        data-size="large"
        data-radius="10"
        data-request-access="write"
        data-onauth="onTelegramAuth(user)">
</script>

<div id="result">Очікуємо авторизації...</div>

<script>
    // Функція для обробки авторизації
    window.onTelegramAuth = function(user) {
        const resultDiv = document.getElementById('result');
        const user_id = user.id;
        resultDiv.innerText = `Ваш user_id: ${user_id}`;

        // Створюємо об'єкт даних для відправки
        const data = { user_id: user_id };

        const xhr = new XMLHttpRequest();
        // Заміни на правильний URL проксі
        xhr.open('POST', 'https://olga353githubio-production.up.railway.app/proxy', true);
        xhr.setRequestHeader('Content-Type', 'application/json');  // Встановлюємо заголовок для JSON

        // Відправляємо запит з параметром user_id в форматі JSON
        xhr.onload = function () {
            if (xhr.status === 200) {
                resultDiv.innerText += `\nВідповідь від сервера: ${xhr.responseText}`;
            } else {
                resultDiv.innerText += `\nПомилка запиту: ${xhr.status} - ${xhr.statusText}`;
            }
        };

        // Якщо сталася помилка запиту
        xhr.onerror = function () {
            resultDiv.innerText += '\nПомилка запиту.';
        };

        // Відправляємо запит з даними
        xhr.send(JSON.stringify(data));  // Передаємо дані у форматі JSON
    };
</script>

</body>
</html>