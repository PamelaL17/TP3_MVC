{{ include('layouts/header.php', { title: exhibition.name }) }}

<div class="show-container">
    <h1>{{ exhibition.name }}</h1>
    <p>Date de l'exposition: {{ exhibition.date }}</p>
    <p><strong>Artiste:</strong> {{ exhibition.artist_name }}</p> <!-- Affichage du nom de l'artiste -->

    <div class="action-links">
        <a href="{{ base }}/exhibitions/edit?id={{ exhibition.id }}">Modifier</a>
        <form action="{{ base }}/exhibitions/delete" method="POST">
            <input type="hidden" name="id" value="{{ exhibition.id }}">
            <button type="submit">Supprimer</button>
        </form>
        <a href="{{ base }}/exhibitions">Retour à la liste</a>
    </div>
</div>

{{ include('layouts/footer.php') }}