{{ include('layouts/header.php', { title: 'Modifier l\'œuvre' }) }}

<h1>Modifier l'œuvre</h1>
<form action="{{ base }}/artworks/edit" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{ artwork.id }}">

    <label for="title">Titre de l'œuvre:</label>
    <input type="text" name="title" id="title" value="{{ artwork.title }}" required><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description">{{ artwork.description }}</textarea><br>

    <label for="artists_id">ID de l'artiste:</label>
    <input type="number" name="artists_id" id="artists_id" value="{{ artwork.artists_id }}" required><br>

    <label for="image">Nouvelle image de l'œuvre (si changement):</label>
    <input type="file" name="image" id="image" accept="image/*"><br>

    <button type="submit">Modifier</button>
</form>

{{ include('layouts/footer.php') }}