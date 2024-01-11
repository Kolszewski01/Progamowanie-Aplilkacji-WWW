<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Koszyk - Prosty Sklep</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function zmienIlosc(idProduktu, zmiana) {
            var iloscInput = document.getElementById('ilosc_' + idProduktu);
            var nowaIlosc = parseInt(iloscInput.value) + zmiana;
            if (nowaIlosc < 1) nowaIlosc = 1;
            iloscInput.value = nowaIlosc;
            updateTotal();
        }

        function updateTotal() {
            var form = document.getElementById('koszykForm');
            var total = 0;
            for (var i = 0; i < form.elements.length; i++) {
                var element = form.elements[i];
                if (element.name.startsWith('ilosc[')) {
                    var cena = parseFloat(element.getAttribute('data-cena'));
                    total += cena * parseInt(element.value);
                }
            }
            document.getElementById('total').textContent = total.toFixed(2) + ' zł';
        }
        
    </script>
</head>
<body>
<div class="nav">
    <nav>
        <a href="index.php" class="przycisk">Strona Główna Sklepu</a>
        <a href="koszyk.php" class="przycisk">Koszyk</a>
    </nav>
</div>
<div id="koszyk" class="koszyk">
    <h2>Twój Koszyk</h2>
    <?php
    session_start();
    include 'cart.php'; 
    pokazKoszyk();
    ?>
</div>
</body>
</html>
