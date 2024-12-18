{{ include('layouts/header.php', { title: 'Modifier la catégorie' }) }}

<h1>Modifier la catégorie</h1>
<form action="{{ base }}/categories/edit" method="POST">
    <input type="hidden" name="id" value="{{ categorie.id }}">

    <label for="name">Nom de la catégorie:</label>
    <input type="text" name="name" id="name" value="{{ categorie.name }}" required><br>

    <button type="submit">Modifier</button>
</form>

{{ include('layouts/footer.php') }}