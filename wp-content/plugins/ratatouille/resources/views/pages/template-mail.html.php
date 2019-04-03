<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Email</title>  
  <style>
    body{
      background-color: #e6f2f2;
    }
    .container {
      margin: 150px auto 0 auto;
      width: 60%;
    }
    h1{
      color: #e6f2f2;
      background-color: #3e3e3e;
      padding-left: 10px;
    }
    p{
      color: #e6f2f2;
      background-color: #3e3e3e;
      padding: 30px;
      min-height: 200px;
    }
  </style>
</head>
<body>
  <section class="container">
    <h1>
      Bonjour <?= $name . ' ' . $firstname ?>
    </h1>
    <p>
      <?= $message ?>
    </p>
  </section>
</body>
</html>
