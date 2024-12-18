{{ include('layouts/header.php', { title: 'Liste des artistes' }) }}

<div class="artists-container">
    <h1>Liste des artistes</h1>
    <ul>
        {% for artist in artists %}
            <li><a href="{{ base }}/artists/show?id={{ artist.id }}">{{ artist.name }}</a></li>
        {% endfor %}
    </ul>

    <a href="{{ base }}/artists/create" class="add-artist-link">Ajouter un artiste</a>
</div>

{{ include('layouts/footer.php') }}