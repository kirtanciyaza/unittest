<!DOCTYPE html>
<html lang="en">

<head>
    <title>product create</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>product create form</h2>
        <p><a href="{{ route('product.index') }}" class="btn btn-primary">BACK</a></p>
        <br>
        <form class="form-horizontal" action="{{ route('product.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="price">price:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" placeholder="Enter price" name="price">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="desc">description:</label>
                <div class="col-sm-10">
                    <textarea id="summernote" name="desc">

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
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Submit</button>
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
