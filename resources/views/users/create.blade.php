<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <link href="{{ asset('storage/css/create_styles.css') }}" rel="stylesheet">
</head>
<body>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
        @csrf
        <h1>Create User</h1>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" onchange="displayProfilePicture(this)">
            <label for="profile_picture" class="custom-file-upload">Upload</label>
            <div id="profile_picture_preview"></div>
            @error('profile_picture')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input type="hidden" name="remember_token" value="{{ Str::random(10) }}">
        </div>
        <div>
            <button type="submit">Create User</button>
        </div>
    </form>
    <script>
        function displayProfilePicture(input) {
            var profilePicturePreview = document.getElementById("profile_picture_preview");
            profilePicturePreview.innerHTML = ""; // Clear previous preview (if any)

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgElement = document.createElement("img");
                    imgElement.setAttribute("src", e.target.result);
                    imgElement.setAttribute("width", "150");
                    imgElement.setAttribute("height", "150");
                    profilePicturePreview.appendChild(imgElement);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
