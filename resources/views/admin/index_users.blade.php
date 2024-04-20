@include('default._navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Users</title>
    <link href="{{ asset('storage/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/css/toggle_style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container" style="margin-top: 30px;">
        <h1 class="table-title">All Users</h1>
        <div class="book-grid">
            @foreach ($all_users as $user)
                <div class="book-box">
                    <a href="{{ route('admin.user.profile', $user->id) }}">
                        <div class="book-cover" style="background-image: url('{{ asset('storage/images/profile_picture/' . $user->profile_picture) }}')">
                        </div>
                    </a>
                    <div class="book-information">
                        <h1>{{ $user->name }} <br> </h1>
                    </div>
                    <div class="togglee {{ $user->user_role == 'professional' ? 'toggle-on' : '' }}" id="switch-{{ $user->id }}" data-number="{{ $user->id }}">
                      <div class="toggle-text-off">AMATEUR</div>
                      <div class="glow-comp"></div>
                      <div class="toggle-button"></div>
                      <div class="toggle-text-on">PROFESSIONAL</div>
                  </div>

                  
                  
                  
                    <form action="{{ route('admin.user.delete', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="action-btn delete-btn">Delete</button>
                  </form>
                  
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const usersLinks = document.querySelectorAll('[id^="author-link-"]');
            userLinks.forEach((link) => {
                const linkText = link.textContent;
                const transformedLinkText = linkText.charAt(0).toUpperCase() + linkText.slice(1);
                link.textContent = transformedLinkText;
            });
        });
    </script>


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
              url: '/update-role/' + number,
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
