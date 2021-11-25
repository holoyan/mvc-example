<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>

<h1>
    <?php echo $hello ?>
</h1>


<form action="/user" method="post">
    <div>
        name
        <input type="text" name="name">
    </div>
    <div>
        email
        <input type="email" name="email">
    </div>
    <div>
        pass
        <input type="password" name="password">
    </div>
    <input type="submit" value="Save">
</form>
</body>
</html>