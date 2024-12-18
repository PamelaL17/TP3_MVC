{{ include('layouts/header.php', { title: 'Liste des expositions' }) }}

<div class="artworks-container">
    <h1>Liste des expositions</h1>
    <ul>
        {% for exhibition in exhibitions %}
            <li><a href="{{ base }}/exhibitions/show?id={{ exhibition.id }}">{{ exhibition.name }}</a></li>
        {% endfor %}
    </ul>

    <a href="{{ base }}/exhibitions/create" class="add-artwork-link">Ajouter une exposition</a>
</div>

{{ include('layouts/footer.php') }}