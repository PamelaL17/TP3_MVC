{{ include('layouts/header.php', { title: 'Modifier l\'exposition' }) }}

<h1>Modifier l'exposition</h1>
<form action="{{ base }}/exhibitions/edit" method="POST">
    <input type="hidden" name="id" value="{{ exhibition.id }}">

    <label for="name">Nom de l'exposition:</label>
    <input type="text" name="name" id="name" value="{{ exhibition.name }}" required><br>

    <label for="date">Date de l'exposition:</label>
    <input type="date" name="date" id="date" value="{{ exhibition.date }}" required><br>

    <label for="artist_id">ID de l'artiste:</label>
    <input type="number" name="artist_id" id="artist_id" value="{{ exhibition.artist_id }}" required><br>


    <button type="submit">Modifier</button>
</form>

{{ include('layouts/footer.php') }}