@include('default._navbar')
<!DOCTYPE html>
<html>
<head>
    <title>book</title>
    <link href="{{ asset('storage/css/profile_styles.css') }}" rel="stylesheet">
</head>
<body>

<div class="profile-container">
    <div class="profile-picture">
        <img src="{{ asset('storage/images/' . $book->cover_image) }}" alt="Book Cover" style="width: 100%;">
        <div class="line">
            <a href="{{ asset('storage/pdf/'.$book->book_path) }}" download>
                <div class="read-more">               
                    <img src="{{ asset('storage/images/buttons/telecharger.png') }}" style='width: 60px; margin-top: 10px;'>
                </div>
            </a>
        </div>
    </div>
    <div class="profile-info">
        <div class="date">
            <span> {{$book->created_at}} </span>    
        </div>
        <h1>{{ $book->title }}</h1>
        
        <h2>Language : {{ $book->language }}</h2>
        <h2>Description</h2>
        <p style="margin-left: 100px">{{ $book->content }}</p>

        <div class="author">
            <a href="{{ route('user.profile', $user->id) }}">
            <span>{{$user->name}}</span>
            </a>
        </div>
    </div>
</div>

<div class="comments-container" >
    <h2>Comments</h2>
    
    @if ($book->comments !== null && count($book->comments) > 0)
      <table class="comments-table">
        @foreach ($book->comments as $comment)
          <tr class="comment">
            <td class="comment-author">
              <strong>
                <a href="{{ route('user.profile', $comment->user) }}">{{ $comment->user->name }}</a>
              </strong>
            </td>
            <td class="comment-content">
              <p>{{ $comment->content }}</p>
            </td>
            <td class="comment-time" >
              <p style="font-size: 10px !important;">Uploaded on {{ $comment->created_at ? $comment->created_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
            </td>
            <td class="comment-delete">
              @if ($comment->user_id == $id)
                <form action="{{ route('user.comments.delete', $comment->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              @endif
            </td>
          </tr>
        @endforeach
      </table>
    @else
      <p class="no-comments">No comments yet.</p>
    @endif
    
    
    <div class="add-comment-container">
        <h3>Add a Comment</h3>
        <form action="{{ route('books.comments.store',$book->id) }}" method="POST">
          @csrf
          <input type="hidden" name="book_id" value="{{ $book->id }}">
          <div class="form-group">
            <textarea name="content" class="form-control" rows="3" placeholder="Enter your comment"></textarea>
          </div>
          <center>
            <button type="submit" class="btn btn-primary">Submit</button>
          </center>
        </form>
      </div>
      
  </div>
  

</body>


<script>
    // Wait for the document to be ready
    document.addEventListener('DOMContentLoaded', function() {
      // Get the elements
      var commentContainer = document.querySelector('.add-comment-container');
      var commentTextArea = commentContainer.querySelector('textarea');
      var submitButton = commentContainer.querySelector('button');
  
      // Hide the text area and submit button initially
      commentTextArea.style.display = 'none';
      submitButton.style.display = 'none';
  
      // Add event listener to show the text area and submit button when clicking the "Add a Comment" heading
      commentContainer.querySelector('h3').addEventListener('click', function() {
        commentTextArea.style.display = 'block';
        submitButton.style.display = 'block';
      });
    });
  </script>
  
  
  

</html>
