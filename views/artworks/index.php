{{ include('layouts/header.php', { title: 'Liste des œuvres' }) }}

<div class="artworks-container">
    <h1>Liste des œuvres</h1>
    <ul>
        {% for artwork in artworks %}
            <li><a href="{{ base }}/artworks/show?id={{ artwork.id }}">{{ artwork.title }}</a></li>
        {% endfor %}
    </ul>

    <a href="{{ base }}/artworks/create" class="add-artwork-link">Ajouter une œuvre</a>
</div>

{{ include('layouts/footer.php') }}