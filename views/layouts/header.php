<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{asset}}/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                {% if guest %}
                    <li><a href="{{base}}/login">Login</a></li>
                
                {% else %}
                    <li><a href="{{ base }}/artists">Artistes</a></li>
                    <li><a href="{{ base }}/artworks">Œuvres d'art</a></li>
                    <li><a href="{{ base }}/exhibitions">Expositions</a></li>
                    <li><a href="{{ base }}/categories">Categories</a></li>
                    {% if session.privilege_id == 1 %}
                        <li><a href="{{base}}/users/create">Users</a></li>
                        <li><a href="{{base}}/logs/index">Logs</a></li>
                    {% endif %}
                    <li><a href="{{base}}/logout">Logout</a></li>
                {% endif %}
            </ul>
        </nav>
    </header>
        {% if guest is empty %}
            <div class="user-greeting">Bonjour {{ session.user_name }}</div>
        {% endif %}