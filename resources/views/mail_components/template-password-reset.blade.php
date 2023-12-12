<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Променяне на парола</title>
</head>

<body>

    <h2>Променяне на паролата в нашият сайт</h2>

    <p>Този имейл е изпратен поради заявка за смяна на забравена парола.</p>

    <p>Ако искате да промените вашата парола, моля, кликнете на следния линк:</p>

    <p>
        <a href="http://localhost:8000/reset-password?token={{ $token }}&email={{ $email }}">Промяна на паролата</a>
    </p>

    <p>
        <strong>Линкът е валиден за 1 час след изпращането на имейла!</strong>
    </p>

</body>