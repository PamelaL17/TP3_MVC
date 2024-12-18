{{ include('layouts/header.php', {title:'Login'})}}
<div class="container">
        {% if errors is defined %}
        <div class="error">
            <ul>
                {% for error in errors %}
                    <li>{{ error }}</li>
                {% endfor %}
            </ul>
        </div>
        {% endif %}
        <form method="post">
            <h2>Login</h2>
             <label>Username
                <input type="email" name="username" value="{{ inputs.username }}">
            </label>
            <label>Password
                <input type="password" name="password">
            </label>
            <input type="submit" class="btn" value="Login">
            <div class="visitor-option">
                <p><a href="{{ base }}/login/visitor">Se connecter en tant que visiteur</a></p>
            </div>
        </form>
    </div>
{{ include('layouts/footer.php')}}