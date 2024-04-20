@include('default._navbar')
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link href="{{ asset('storage/css/profile_styles.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="profile-container">
        <div >
            <img class="profile-picture" src="{{ asset('storage/images/profile_picture/' . $user->profile_picture) }}" alt="Profile Picture">
        </div>
        
        
        <div class="profile-details">
            <h2>{{ $user->name }}</h2>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Description:</strong> {{ $user->description }}</p>
        </div>
    </div>

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
</body>
</html>