<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поръчката е завършена успешно</title>
</head>
<body>
    <p>Здравейте, {{ session('logged_username') }}, вашата поръчка е приета успешно!</p>
    <ul>
        @foreach($products as $product)
            <li>Вид продукт: {{ $product->name }}</li>
            <li>Количество: {{ $product->qty }}</li>
            <li>Единична цена: {{ $product->price }}</li>
            <li>Грамаж: {{ $product->options->weight }}</li>
            <br>
        @endforeach
        <li><strong>Обща цена: {{ $total_price }} лева.</strong></li>
    </ul>
</body>
</html>