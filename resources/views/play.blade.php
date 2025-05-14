<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Game</title>
</head>
<body>
    <h1>Game {{ $gameId }}</h1>
    <iframe src="/temp/{{ $gameId }}/index.html" width="800" height="600"></iframe>

    <script src="{{ asset('js/game.js') }}"></script>
</body>
</html>
