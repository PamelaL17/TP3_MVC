{{ include('layouts/header.php', { title: 'Ajouter une catégorie' }) }}

<h1>Ajouter une catégorie</h1>
<form action="{{ base }}/categories/create" method="POST">
    <label for="name">Nom de la catégorie:</label>
    <input type="text" name="name" id="name" required><br>

    <button type="submit">Ajouter</button>
</form>

{{ include('layouts/footer.php') }}