@include('default._navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Books</title>
    <link href="{{ asset('storage/css/styles.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/buttons/book-stack.png') }}">
</head>

<body>
    <div class="container" style="margin-top: 30px;">
        <h1 class="table-title">All Books</h1>
        <div class="book-grid">
            @foreach ($all_books as $book)
                <div class="book-box">
                    <a href="{{ route('books.show', $book->id) }}">
                        <div class="book-cover" style="background-image: url('{{ asset('storage/images/' . $book->cover_image) }}')">
                        </div>
                    </a>
                    <div class="book-information">
                        <h1>{{ $book->title }} <br>
                            @if ($book->user->id == Auth::id())
                                <a id="author-link-{{ $book->id }}" href="{{ route('profile.edit') }}">{{ $book->user->name }}</a>
                            @else
                                <a id="author-link-{{ $book->id }}" href="{{ route('user.profile', $book->user->id) }}">{{ $book->user->name }}</a>
                            @endif
                        </h1>
                        <language>  {{ $book->language }} </language>
                    </div>
                </div>
            @endforeach
        </div>
        <center>Click <a href="{{ route('books.create') }}">here</a> to create another book.</center>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookLinks = document.querySelectorAll('[id^="author-link-"]');
            bookLinks.forEach((link) => {
                const linkText = link.textContent;
                const transformedLinkText = linkText.charAt(0).toUpperCase() + linkText.slice(1);
                link.textContent = transformedLinkText;
            });
        });
    </script>
    


</body>

</html>
