{{ include('layouts/header.php', { title: 'Ajouter une exposition' }) }}

<h1>Ajouter une exposition</h1>
<form action="{{ base }}/exhibitions/create" method="POST">
    <label for="name">Nom de l'exposition:</label>
    <input type="text" name="name" id="name" value="{{ inputs.name }}" required><br>

    <label for="date">Date de l'exposition:</label>
    <input type="date" name="date" id="date" value="{{ inputs.date }}" required><br>

    <label for="artist_id">ID de l'artiste:</label>
    <input type="number" name="artist_id" id="artist_id" value="{{ inputs.artist_id }}" required><br>

    <button type="submit">Ajouter</button>
</form>

{{ include('layouts/footer.php') }}