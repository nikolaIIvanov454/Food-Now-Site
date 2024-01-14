<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Количка</title>
    <script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @vite('resources/js/app.js')
    <script src="{{ asset('js/script_menu.js') }}"></script>
    <script src="{{ asset('js/shopping_cart_logic.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shopping-cart-style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
</head>
<body>
    @include('components.navbar')

    <div id="container">
    <div id="name">
        <h1>Моята количка</h1>
    </div>
    @if($basket_items->Count() > 0)
        @foreach($basket_items as $item)
        <div id="item">
                <div id="left-content">
                    <h1>{{ $item->name }}</h1>
                </div>
                <div id="right-content">
                    <h3>Грамаж: {{ $item->options->weight }}</h3>
                    <h3>Количество: {{ $item->qty }}</h3>
                    <strong>Цена: {{ $item->price }}</strong>
                </div>
                <div id="buttons-container">
                    <div id="item">
                        <input type="hidden" id="row-id" name="id" value="{{ $item->rowId }}">
                        @csrf
                        <i class="fa-solid fa-xmark" onclick="removeProduct()"></i>
                    </div>
                </div>
            </div>

            @php
                $totalPrice = 0;
                foreach($basket_items as $item) {
                    $totalPrice += $item->price * $item->qty;
                }   
            @endphp
        @endforeach

        <div id="total">
            <h1>Обща Цена: {{ $totalPrice }}</h1>
        </div>

        <div id="complete-order">
            <form id="checkout-form">
                @csrf
                <input type="hidden" name="items-total-price" value="{{ $totalPrice }}">
                <input type="submit" onclick="checkout(event)" style="display: flex; align-items: center;" value="Завърши поръчката">
            </form>
        </div>
    @else
        <h1 style="text-align: center;">Нямате продукти в количката!</h1>
    @endif
    </div>

    @include('components.footer')
</body>
</html>