{{ include('layouts/header.php', { title: artwork.title }) }}
<div class="show-container">
    <h1>{{ artwork.title }}</h1>
    <p>{{ artwork.description }}</p>
    <p><strong>Nom de l'artiste:</strong> {{ artwork.artist_name }}</p>
    <p><strong>Catégorie:</strong> {{ artwork.category_name }}</p>
    <p>{{ artwork.image }}</p>

    {% if artwork.image %}
        <div class="artwork-image">
            <img src="{{ base }}/uploads/{{ artwork.image }}" alt="{{ artwork.title }}">
        </div>
    {% endif %}

    <div class="action-links">
        <a href="{{ base }}/artworks/edit?id={{ artwork.id }}">Modifier</a>
        <form action="{{ base }}/artworks/delete" method="POST">
            <input type="hidden" name="id" value="{{ artwork.id }}">
            <button type="submit">Supprimer</button>
        </form>
        <a href="{{ base }}/artworks">Retour à la liste</a>
    </div>
</div>

{{ include('layouts/footer.php') }}