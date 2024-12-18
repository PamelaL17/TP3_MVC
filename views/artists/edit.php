{{ include('layouts/header.php', {title: 'Modifier l\'artiste'}) }}

<h1>Modifier l'artiste</h1>
<form action="{{ base }}/artists/edit" method="POST">
    <input type="hidden" name="id" value="{{ artist.id }}">

    <label for="name">Nom de l'artiste:</label>
    <input type="text" name="name" id="name" value="{{ artist.name }}" required><br>

    <label for="biography">Biographie:</label>
    <textarea name="biography" id="biography">{{ artist.biography }}</textarea><br>

    <button type="submit">Modifier</button>
</form>

{{ include('layouts/footer.php') }}