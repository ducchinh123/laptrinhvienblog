<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Khách hàng đã liên hệ bạn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1 style="padding: 20px 0;">Chào Chính, có khách hàng đã liên hệ cho bạn từ website blog của bạn</h1>
    <div style="border-bottom: 2px solid black;"></div>
    <div class="row">
        <div class="col-md-12">Họ và tên: {{ $fullname }}</div>
        <div class="col-md-12">Email: {{ $email }}</div>
        <div class="col-md-12">Nội dung: {{ $content }}</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>