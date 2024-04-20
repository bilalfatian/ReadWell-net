<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Books</title>
    <link href="{{ asset('storage/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/css/toggle_style.css') }}" rel="stylesheet">
</head>

<body>
    @include('default._navbar')
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
                            <a id="author-link-{{ $book->id }}" href="{{ route('admin.user.profile', $book->user->id) }}">{{ $book->user->name }}</a>
                        </h1>
                        <language>  {{ $book->language }} </language>
                    </div>
                    
                    <div class="togglee {{ $book->approved ? 'toggle-on' : '' }}" id="switch-{{ $book->id }}" data-number="{{ $book->id }}">
                        <div class="toggle-text-off">DISAPPROVED</div>
                        <div class="glow-comp"></div>
                        <div class="toggle-button"></div>
                        <div class="toggle-text-on">APPROVED</div>
                    </div>  

                    <div class="delete-button" style="margin-left: 70%;" >
                      <form action="{{ route('admin.books.delete', $book->id) }}" method="POST" style="display: inline-block;"
                        onsubmit="return confirm('Are you sure you want to delete?');">
                        @csrf
                        <button type="submit" class="action-btn delete-btn" style="margin-top: 30%;">Delete</button>
                      </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById("switch").addEventListener("click", function() {
      this.classList.toggle("toggle-on");
    });
  </script>
    <script>
        $('[id^="switch-"]').each(function() {
          var switchId = $(this).attr('id');
          var number = switchId.split('-')[1];
    
          $("#" + switchId).click(function() {
            $(this).toggleClass("toggle-on");
            var isChecked = $(this).hasClass("toggle-on");
    
            $.ajax({
              type: 'GET',
              url: '/update-approved/' + number,
              data: {
                isChecked: isChecked
              },
              success: function(response) {
                // Handle the response if needed
              },
              error: function(xhr) {
                // Handle any errors
              }
            });
          });
        });
      </script>

</body>
</html>
