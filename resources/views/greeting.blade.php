<!DOCTYPE html>
<html>
<head>
    <title>Greeting Della</title>
</head>
<body>
    <h1>Welcome to the Greeting Page Della</h1>
    <p>Hello, {{ $name }}</p>

    @if($isAdmin)
<p>Welcome, Admin!</p>
@else
<p>Welcome, User!</p>
@endif
</body>
</html>
