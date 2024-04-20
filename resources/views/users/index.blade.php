@include('default._navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Users</title>
    <link href="{{ asset('storage/css/styles.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container" style="margin-top: 30px">
        <h1 class="table-title">All Users</h1>
        <div class="book-grid">
            @foreach ($all_users as $user)
                <div class="book-box">
                    <a href="{{ route('user.profile', $user->id) }}">
                        <div class="book-cover" style="background-image: url('{{ asset('storage/images/profile_picture/' . $user->profile_picture) }}')">
                        </div>
                    </a>
                    <div class="book-information">
                        <h1>{{ $user->name }} <br> </h1>
                        <language>{{ $user->user_role }} </language>
                    </div>
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

</body>

</html>
