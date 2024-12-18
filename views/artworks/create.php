{{ include('layouts/header.php', { title: 'Ajouter une œuvre' }) }}

<h1>Ajouter une œuvre</h1>
<form action="{{ base }}/artworks/create" method="POST" enctype="multipart/form-data">
    <label for="title">Titre de l'œuvre:</label>
    <input type="text" name="title" id="title" required><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea><br>

    <label for="artists_id">ID de l'artiste:</label>
    <input type="number" name="artists_id" id="artists_id" required><br>

    <label for="image">Image de l'œuvre:</label>
    <input type="file" name="image" id="image" accept="image/*"><br>

    <button type="submit">Ajouter</button>
</form>

{{ include('layouts/footer.php') }}