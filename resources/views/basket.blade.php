<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if($cartItems->Count() > 0)
        <table>
            <tr>
                <td>works</td>
            </tr>
        </table>
    @else
        <h1>Нямате продукти в количката!</h1>
    @endif

    @foreach($cartItems as $items)
        <h1>{{ $item->model->name }}</h1>
    @endforeach
</body>
</html>