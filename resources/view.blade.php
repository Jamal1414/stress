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

        .calculator {
            width: 300px;
            background-color:  #4635B1;
            border-radius: 10px;
        }

        .btn-calc {
            width: 60px;
            height: 45px;
            font-size: 1.2rem;
        }

        .display {
            height: 60px;
            font-size: 1.5rem;
            text-align: right;
            border-radius: 5px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-3 shadow calculator">
        <h4 class="text-center text-white">Kalk</h4>
        <form action="/hasil" method="POST">
            @csrf
            <input type="hidden" name="angka1" id="angka1">
            <input type="hidden" name="operator" id="operator">
            <input type="hidden" name="angka2" id="angka2">
            <div class="mb-2">
                <input type="text" id="display" class="form-control display" disabled value="{{ $hasil ?? '' }}">
            </div>
            <div class="d-grid gap-2">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-calc" onclick="setNumber(1)">1</button>
                    <button type="button" class="btn btn-secondary btn-calc" onclick="setNumber(2)">2</button>
                    <button type="button" class="btn btn-secondary btn-calc" onclick="setNumber(3)">3</button>
                    <button type="button" class="btn btn-warning btn-calc" onclick="setOperator('+')">+</button>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-calc" onclick="setNumber(4)">4</button>
                    <button type="button" class="btn btn-secondary btn-calc" onclick="setNumber(5)">5</button>
                    <button type="button" class="btn btn-secondary btn-calc" onclick="setNumber(6)">6</button>
                    <button type="button" class="btn btn-warning btn-calc" onclick="setOperator('-')">-</button>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-calc" onclick="setNumber(7)">7</button>
                    <button type="button" class="btn btn-secondary btn-calc" onclick="setNumber(8)">8</button>
                    <button type="button" class="btn btn-secondary btn-calc" onclick="setNumber(9)">9</button>
                    <button type="button" class="btn btn-warning btn-calc" onclick="setOperator('*')">*</button>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-danger btn-calc" onclick="resetCalc()">C</button>
                    <button type="button" class="btn btn-secondary btn-calc" onclick="setNumber(0)">0</button>
                    <button type="submit" class="btn btn-primary btn-calc">=</button>
                    <button type="button" class="btn btn-warning btn-calc" onclick="setOperator('/')">/</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        let angka1 ="";
        let angka2 ="";
        let operator ="";

        function setNumber(num) {
            if (operator === "") {
                angka1 += num;
            } else {
                angka2 += num;
            }
            document.getElementById("display").value = angka1 + (operator ? " " + operator + " " : "") + angka2;
        }

        function setOperator(op) {
            if (angka1 !== "") {
                operator = op;
                document.getElementById("operator").value = operator;
                document.getElementById("display").value = angka1 + " " + operator;
            }
        }

        function resetCalc() {
            angka1 = "";
            angka2 = "";
            operator = "";
            document.getElementById("angka1").value = "";
            document.getElementById("angka2").value = "";
            document.getElementById("operator").value = "";
            document.getElementById("display").value = "";
        }

        document.querySelector("form").addEventListener("submit", function() {
            document.getElementById("angka1").value = angka1;
            document.getElementById("angka2").value = angka2;
        });

        window.onload = function() {
            @if (isset($hasil) && $hasil === 'Tidak dpt membagi 0')
                alert("{{ $hasil }}");
            @endif
        }
    </script>
</body>
</html>
