<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<button type="button" onclick="create()">Click Me</button>
<script>
      $.ajax({
        url: 'myFunctions.php',
        type: 'post',
        data: { "callFunc1": "1"},
        success: function(response) { console.log(response); }
    });
</script>
</body>
</html>