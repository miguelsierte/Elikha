<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    I am Artist
    <form action="{{ route('userslogin') }}" method="POST" class="d-flex" role="search">
        @csrf
        @method('post')
        <button class="btn btn-danger" type="submit">Logout</button>
    </form>
</body>
</html>