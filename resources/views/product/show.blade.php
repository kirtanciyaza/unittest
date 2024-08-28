<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product Show</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Product Show</h2>
        <div class="card" style="width:400px">
            <img class="card-img-top" src="{{ asset($product->image) }}" alt="Card image" width="300" height="300">
            <br>
            {!! $qrCode !!}
            <div class="card-body">
                <h4 class="card-title">{{ $product->name }}</h4>
                <p class="card-text">{!! $product->desc !!}</p>
                <h4 class="card-price">{{ $product->price }}</h4>
                <a href="{{ route('product.index') }}" class="btn btn-primary">BACK</a>
            </div>
        </div>
    </div>

</body>

</html>
