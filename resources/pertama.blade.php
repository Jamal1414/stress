<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukk kalkulator</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <style>
        body {
            background-color:  #BAD8B6;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div clas="text-center">
        <h1 class="text-center">Salken</h1>
        <a href="{{ url('/kalkulator') }}" class="btn btn-primary btn-lg">Kalkulator</a>
        <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modal">Data Diri</button>
    </div>
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100">Data Diri</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama:</strong> Kicau Mania</p>
                    <p><strong>Kelas:</strong> XII RPL</p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
