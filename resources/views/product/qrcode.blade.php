<!DOCTYPE html>
<html lang="en">

<head>
    <title>QR CRUD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>PRODUCT TABLE</h2>
        <p><a href="{{ route('product.create') }}" class="btn btn-primary">CREATE PRODUCT</a></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>QR Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{!! $product->desc !!}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <img src="{{ asset($product->image) }}" class="rounded mx-auto d-block" alt="..."
                                width="200" height="200">
                        </td>
                        <td>
                            @if (isset($qrCodes[$product->id]))
                                {!! $qrCodes[$product->id] !!}
                            @else
                                No QR Code
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('product.delete', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">EDIT</a>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-success">SHOW</a>
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
