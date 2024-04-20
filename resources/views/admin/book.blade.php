<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $book->title }}</title>
    <link href="{{ asset('storage/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/css/navbar_styles.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/buttons/book-stack.png') }}">

    <script src="{{ asset('js/pdf.js') }}"></script>
    <script src="{{ asset('js/pdf.worker.js') }}"></script>

</head>
<body>
    <@include('default._navbar')> 
    <div class="container" style="margin-top: 30px;">
        <h1>{{ $book->title }}</h1>
        <div class="book-container">
            <div class="book-image">
                <img src="{{ asset('storage/images/' . $book->cover_image) }}" alt="Book Cover">
            </div>
            <div class="book-info">
                <div class="book-details">
                    <p>{{ $book->description }}</p>
                    <p>Language: {{ $book->language }}</p>
                    <p class="book-metadata">Author: <a href="{{ route('admin.user.profile', $book->user) }}">{{ $book->user->name }}</a></p>
                    <a href="{{ asset('storage/pdf/'.$book->book_path) }}" download>Download PDF</a>

                    <!--iframe id="pdfIframe" src="{{ asset('storage/pdf/' . $book->book_path) }}" style="width: 100%; height: 800px;"></iframe-->

                </div>
            </div>
        </div>

        <div class="blade.comments-container">
            <h2>Comments</h2>
            @if ($book->comments !== null && count($book->comments) > 0)
                <ul class="blade.comments-list">
                    @foreach ($book->comments as $comment)
                        <li class="blade.comment">
                        <strong class="blade.comment-author"><a href="{{ route('user.profile', $comment->user) }}">{{ $comment->user->name }}</a></strong>
                            <p class="blade.comment-content">{{ $comment->content }}</p>
                            <p class="blade.comment-time">Uploaded on {{ $comment->created_at ? $comment->created_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
                        </li>

                        <form action="{{ route('admin.comments.delete', $comment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        
                        @endforeach
                </ul>
            @else
                <p class="blade.no-comments">No comments yet.</p>
            @endif
        </div>

        <center><a href="{{ route('admin.books.index') }}" class="btn btn-primary">See all books</a></center>
    </div>

    <style>
        .pdf-container {
          position: relative;
          width: 100%;
          height: 800px;
        }

        .pdf-button {
          position: absolute;
          top: 38px;
          right: 270px;
          background-color: transparent;
          border: none;
          z-index: 999;
          cursor: pointer;
          transition: opacity 0.3s;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          overflow: hidden;
          padding: 0px;
        }
      
        .pdf-button img {
          width: 80%;
          height: 80%;
          object-fit: contain;
        }
      </style>

      <div class="pdf-container">
        <iframe id="pdfIframe" src="{{ asset('storage/pdf/' . $book->book_path) }}" style="width: 100%; height: 100%;"></iframe>
        <button onclick="openPDFInNewTab()" class="pdf-button">
          <img src="{{ asset('storage/images/buttons/open_new_tab.png') }}">
        </button>
      </div>
      
  
  <script>
    function openPDFInNewTab() {
      const pdfURL = "{{ asset('storage/pdf/' . $book->book_path) }}";
      window.open(pdfURL, '_blank');
    }
  </script>

</body>
</html>
