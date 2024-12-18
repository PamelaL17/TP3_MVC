{{ include('layouts/header.php', { title: 'Journal des actions' }) }}

<div class="logs-container">
    <h1>Journal des actions</h1>
    <table class="logs-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Adresse IP</th>
                <th>Page visitée</th>
                <th>Date de visite</th>
            </tr>
        </thead>
        <tbody>
            {% for log in logs %}
                <tr>
                    <td>{{ log.id }}</td>
                    <td>{{ log.username }}</td>
                    <td>{{ log.ip_address }}</td>
                    <td>{{ log.visited_page }}</td>
                    <td>{{ log.visit_date }}</td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
</div>

{{ include('layouts/footer.php') }}