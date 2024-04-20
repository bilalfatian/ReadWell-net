<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Book - {{ $book->title }}</title>
    <link href="{{ asset('storage/css/styles.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/buttons/book-stack.png') }}">
    <style>
        .container {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
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

        .cover-section {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .cover-photo-container {
            margin-right: 20px;
        }

        .cover-photo {
            cursor: pointer;
            max-width: 200px;
        }

        .cover-info {
            flex-grow: 1;
            text-align: left;
        }
    </style>
</head>
<body>
    <form action="{{ route('books.update',$book->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container">
            <h1>Edit Book - {{ $book->title }}</h1>
            <a href="{{ route('books.index') }}" class="btn btn-primary all-books">All Books</a>
            <div class="cover-section">
                <div class="cover-photo-container">
                    @if ($book->cover_image)
                        <img src="{{ asset('storage/images/'.$book->cover_image) }}" alt="Current Cover Photo" class="cover-photo">
                    @endif
                </div>
                <div class="cover-info">
                    <h2>{{ $book->title }}</h2>
                    <p>{{ $book->content }}</p>
                    <p>Language: {{ $book->language }}</p>
                    <label for="cover_image" class="btn btn-primary">Change Cover Photo</label>
                    <section hidden><input type="file" class="form-control-file" id="cover_image" name="cover_image"></section>
                </div>
            </div>

            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ $book->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="language" class="form-label">Language</label>
                <select class="form-control" id="language" name="language" required>
                    @php
                    $languages = [
                        'Afrikaans', 'Arabic', 'Bengali', 'Bulgarian', 'Chinese', 'Croatian', 'Czech', 'Danish',
                        'Dutch', 'English', 'Estonian', 'Farsi', 'Finnish', 'French', 'German', 'Greek', 'Hebrew',
                        'Hindi', 'Hungarian', 'Icelandic', 'Indonesian', 'Irish', 'Italian', 'Japanese', 'Korean',
                        'Latvian', 'Lithuanian', 'Malay', 'Maori', 'Norwegian', 'Polish', 'Portuguese', 'Punjabi',
                        'Romanian', 'Russian', 'Samoan', 'Scottish Gaelic', 'Serbian', 'Slovak', 'Slovenian',
                        'Spanish', 'Swahili', 'Swedish', 'Tagalog', 'Tahitian', 'Thai', 'Turkish', 'Urdu',
                        'Vietnamese', 'Welsh', 'Yiddish'
                    ];
                    @endphp
                    @foreach ($languages as $language)
                        <option value="{{ $language }}" {{ $language === $book->language ? 'selected' : '' }}>
                            {{ $language }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Book</button>
        </div>
    </form>

    <script>
        document.getElementById('cover_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            const coverPhoto = document.querySelector('.cover-photo');

            reader.onload = function(e) {
                coverPhoto.src = e.target.result;
            }

            reader.readAsDataURL(file);
        });
    </script>
</body>
</html>
