const express = require('express');
const cors = require('cors');
const axios = require('axios'); // Для роботи з HTTP-запитами

const app = express();
const port = process.env.PORT || 3000;

app.use(cors());
app.use(express.json());

// Додаємо обробник для GET-запиту на корінь
app.get('/', (req, res) => {
    res.send('Привіт, це проксі-сервер!');  // Текст, який відправляється у відповідь на GET запит
});

// Маршрут для проксі
app.post('/proxy', async (req, res) => {
    console.log('Запит отримано:', req.body); // Перевірка, що приходить

    try {
        // Здійснюємо запит до зовнішнього API
        const response = await axios.post(
            'https://ws.zolotiyvik.ua:8443/Buffer/hs/Incoming/test/', // Заміни на свій API
            req.body, // Передаємо ті ж самі дані, що отримали
            {
                headers: {
                    'Content-Type': 'application/json'
                }
            }
        );

        // Відповідаємо клієнту з результатом
        res.status(response.status).json(response.data);
    } catch (error) {
        console.error('Помилка запиту до зовнішнього API:', error.message);
        res.status(500).json({ error: 'Не вдалося здійснити запит до зовнішнього API' });
    }
});

app.listen(port, () => {
    console.log(`Сервер працює на порту ${port}`);
});