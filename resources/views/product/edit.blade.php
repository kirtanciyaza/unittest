<!DOCTYPE html>
<html lang="en">

<head>
    <title>product edit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>product create form</h2>
        <p><a href="{{ route('product.index') }}" class="btn btn-primary">BACK</a></p>
        <br>
        <form class="form-horizontal" action="{{ route('product.update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                        value="{{ $product->name }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="price">price:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" placeholder="Enter price" name="price"
                        value="{{ $product->price }}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="desc">description:</label>
                <div class="col-sm-10">
                    <textarea id="summernote" name="desc">
                        {!! $product->desc !!}
                    </textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="file">image:</label>
                <div class="col-sm-10">
                    <input type="file" name="image" id="image" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="imageshow">current image:</label>
                <div class="col-sm-10">
                    <img src="{{ asset($product->image) }}" class="rounded mx-auto d-block" alt="..."
                        width="200" height="200">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">UPDATE</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

</body>

</html>
