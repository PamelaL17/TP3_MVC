{{ include('layouts/header.php', { title: 'Liste des catégories' }) }}

<div class="categories-container">
    <h1>Liste des catégories</h1>
    <ul>
        {% for categorie in categories %}
            <li><a href="{{ base }}/categories/show?id={{ categorie.id }}">{{ categorie.name }}</a></li>
        {% endfor %}
    </ul>

    <a href="{{ base }}/categories/create" class="add-category-link">Ajouter une catégorie</a>
</div>

{{ include('layouts/footer.php') }}