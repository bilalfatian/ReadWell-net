<form action="{{ route('password.update') }}" method="POST">
    @csrf

    <div>
        <label for="current_password">Mot de passe actuel:</label>
        <input type="password" name="current_password" id="current_password">
    </div>

    <div>
        <label for="new_password">Nouveau mot de passe:</label>
        <input type="password" name="new_password" id="new_password">
    </div>

    <div>
        <label for="new_password_confirmation">Confirmer le nouveau mot de passe:</label>
        <input type="password" name="new_password_confirmation" id="new_password_confirmation">
    </div>

    <button type="submit">Modifier le mot de passe</button>
</form>
