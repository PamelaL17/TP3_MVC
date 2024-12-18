{{ include('layouts/header.php', {title: 'Ajouter un artiste'}) }}

<h1>Ajouter un artiste</h1>
<form action="{{ base }}/artists/create" method="POST">
    <label for="name">Nom de l'artiste:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="biography">Biographie:</label>
    <textarea name="biography" id="biography"></textarea><br>

    <button type="submit">Ajouter</button>
</form>

{{ include('layouts/footer.php') }}