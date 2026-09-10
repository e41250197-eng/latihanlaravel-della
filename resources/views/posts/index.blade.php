<!DOCTYPE html>
<html>
    <head>
        <title>Posts</title>
    </head>
    <body>
        <h1>Posts</h1>

        @foreach ($posts as $post)
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
        @endforeach
    </body>
</html>
