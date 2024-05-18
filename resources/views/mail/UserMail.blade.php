<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>User Created Successfully</h1>
    @foreach ($credentials as $item)
    <p>Email: {{$item->email}}</p>
    <p>Temporary Password: {{$item->password}}</p>
    @endforeach
</body>
</html>