{{ include('layouts/header.php', { title: categorie.name }) }}

<div class="show-container">
    <h1>{{ categorie.name }}</h1>

    <div class="action-links">
        <a href="{{ base }}/categories/edit?id={{ categorie.id }}">Modifier</a>
        <form action="{{ base }}/categories/delete" method="POST">
            <input type="hidden" name="id" value="{{ categorie.id }}">
            <button type="submit">Supprimer</button>
        </form>
        <a href="{{ base }}/categories">Retour à la liste</a>
    </div>
</div>

{{ include('layouts/footer.php') }}