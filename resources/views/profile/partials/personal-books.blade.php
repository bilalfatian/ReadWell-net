<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link href="{{ asset('storage/css/profile_styles.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/css/toggle_style.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container" style="margin-top: 70px;">
    <h1 class="table-title">Personal Books</h1>
    <div class="book-grid">
        @forelse ($user->books as $book)
            <div class="book-box">
                <a href="{{ route('books.show', $book->id) }}">
                    <div class="book-cover" style="background-image: url('{{ asset('storage/images/' . $book->cover_image) }}')">
                    </div>
                </a>
                <div class="book-information">
                    <h1>{{ $book->title }} <br>
                        <a id="author-link-{{ $book->id }}" href="{{ route('user.profile', $book->user->id) }}">{{ $book->user->name }}</a>
                    </h1>
                    <language>  {{ $book->language }} </language>
                </div>

                
                <?php if ($user->id==Auth::id())  {?>
                    @if ($book->approved == 1)
                        <p> status : approved </p>
                    @else
                        <p> status : not yet </p>
                    @endif

                    <div class="togglee {{ $book->hidden ? 'toggle-on' : '' }}" id="switch-{{ $book->id }}" data-number="{{ $book->id }}">
                        <div class="toggle-text-off">HIDDEN</div>
                        <div class="glow-comp"></div>
                        <div class="toggle-button"></div>
                        <div class="toggle-text-on">VISIBLE</div>
                    </div>

                    <div class="book-actions">
                        <a href="{{ route('books.edit', $book->id) }}" class="action-btn edit-btn">Edit</a>
                        <form action="{{ route('books.delete', $book->id) }}" method="POST" style="display: inline-block;"
                            onsubmit="return confirm('Are you sure you want to delete?');">
                            @csrf
                            <button type="submit" class="action-btn delete-btn">Delete</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        @empty
            <p>No books found.</p>
        @endforelse
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
                  url: '/update-hidden/' + number,
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