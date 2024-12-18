{{ include('layouts/header.php', {title: artist.name}) }}

<div class="show-container">
    <h1>{{ artist.name }}</h1>
    <p>{{ artist.biography }}</p>
    <div class="action-links">
        <a href="{{ base }}/artists/edit?id={{ artist.id }}">Modifier</a>
        <form action="{{ base }}/artists/delete" method="POST">
            <input type="hidden" name="id" value="{{ artist.id }}">
            <button type="submit">Supprimer</button>
        </form>
        <a href="{{ base }}/artists">Retour à la liste</a>
    </div>
</div>

{{ include('layouts/footer.php') }}