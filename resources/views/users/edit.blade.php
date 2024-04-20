<form method="POST" action="{{ route('updateuser', $user->id) }}" onsubmit="return confirm('Are you sure you want to update your account? This action cannot be undone.')">
    @csrf
    @method('PUT')

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ $user->name }}" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ $user->email }}" required>
    <br>

    <label for="description">Description:</label>
    <textarea name="description">{{ $user->description }}</textarea>
    <br>

    <button type="submit">Update</button>

    
</form>
