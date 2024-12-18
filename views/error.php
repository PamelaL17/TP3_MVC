{{ include('layouts/header.php', {title:'Error 404'})}}
    <div class="container">
        <h2>Error</h2>
        <strong class="error"> 404 page not found! </strong>
        <p>{{ msg }}</p>
    </div>
{{ include('layouts/footer.php')}}