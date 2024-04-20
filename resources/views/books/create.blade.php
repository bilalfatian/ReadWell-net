<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create a New Book</title>
    <link href="{{ asset('storage/css/styles.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/buttons/book-stack.png') }}">
    <style>
        .container {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-primary {
            padding: 10px 20px;
            font-size: 16px;
        }

        .all-books {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create a New Book</h1>
        <a href="{{ route('books.index') }}" class="btn btn-primary all-books">All Books</a>
        <form action="{{ route('storebook') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="language" class="form-label">Language</label>
                <select class="form-control" id="language" name="language" required>
                @include('default._languages')
                </select>
            </div>

            <div class="form-group">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input type="file" class="form-control-file" id="cover_image" name="cover_image">
            </div>

            <div class="form-group">
                <label for="book_path" class="form-label">Book File</label>
                <input type="file" class="form-control-file" id="book_path" name="book_path">
            </div>

            <button type="submit" class="btn btn-primary">Create Book</button>
        </form>
    </div>
</body>
</html>
