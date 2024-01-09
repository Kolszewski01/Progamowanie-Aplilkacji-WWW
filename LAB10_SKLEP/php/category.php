<?php
require_once 'cfg.php';
class Kategoria
{
    private int $id;
    private $rodzic;
    private string $nazwa;

    public function __construct(int $id)
    {
        $bazaDanych = CFG::getInstance();

        $wynik = $bazaDanych->query("SELECT * FROM `kategorie` WHERE `id` = $id LIMIT 1");
        $dane = $wynik->fetch_assoc();
        $this->id = $id;
        if (intval($dane['matka']) != 0)
            $this->rodzic = new Kategoria(intval($dane['matka']));
        else
            $this->rodzic = NULL;
        $this->nazwa = $dane['nazwa'];
    }

    public function __toString()
    {
        $dzieci = $this->pobierzDzieci();
        $tekst = "<h3>$this->nazwa</h3>";
        if (count($dzieci) != 0) {
            $tekst .= "<ul>";
            foreach ($dzieci as $dziecko) {
                $tekst .= "<li>$dziecko</li>";
            }
            $tekst .= "</ul>";
        }
        return $tekst;
    }

    private function pobierzDzieci()
    {
        $dzieci = [];
        $bazaDanych = CFG::getInstance();
        $wynik = $bazaDanych->query("SELECT id FROM `kategorie` WHERE `matka` = $this->id");
        while ($dane = $wynik->fetch_assoc()) {
            $kategoriaDziecka = new Kategoria(intval($dane['id']));
            array_push($dzieci, $kategoriaDziecka);
        }
        return $dzieci;
    }

    public static function pobierzWszystkieKategorie()
    {
        $bazaDanych = CFG::getInstance();
        $wynik = $bazaDanych->query("SELECT `id`, `matka`, `nazwa` FROM `kategorie` LIMIT 100");
        $kategorie = [];
        while ($dane = $wynik->fetch_assoc()) {
            $daneKategorii = ['id' => $dane['id'], 'matka' => $dane['matka'], 'nazwa' => $dane['nazwa']];
            array_push($kategorie, $daneKategorii);
        }
        return $kategorie;
    }

    public static function pokazWszystkieKategorie()
    {
        $bazaDanych = CFG::getInstance();
        $wynik = $bazaDanych->query("SELECT `id`, `matka`, `nazwa` FROM `kategorie` LIMIT 100");
        $select = '<h1>KATEGORIE</h1><form nazwa="wybierzKategorie" method="get" action="' . $_SERVER['REQUEST_URI'] . '"><select nazwa = "categories" id = "listaKategorii">';

        while ($dane = $wynik->fetch_assoc()) {
            $select .= '<option value="' . $dane['id'] . '">' . $dane['nazwa'] . '</option>';
        }
        $select .= '<option value="add">Dodaj nową kategorię</option></select>';
        $select .= '<input type="submit" nazwa = "subCat" value="Wybierz">';
        $select .= '<input type="submit" nazwa = "subCat" value="Usuń"></form>';
        return $select;
    }



    public static function dodajKategorie(array $dane)
    {
        $bazaDanych = CFG::getInstance();
        $stmt = $bazaDanych->prepare("INSERT INTO `kategorie`( `nazwa`, `matka`) VALUES (?, ?)");
        $stmt->bind_param("si", $dane[0], $dane[1]);

        if ($stmt->execute()) {
            echo "Kategoria dodana pomyślnie";
            header("REFRESH:0");
        } else {
            echo "Nie udało się dodać kategorii";
        }

        $stmt->close();
    }

    public static function aktualizujKategorie(array $dane)
    {
        $bazaDanych = CFG::getInstance();
        $stmt = $bazaDanych->prepare("UPDATE `kategorie` SET `name` = ?, `parent` = ? WHERE `id` = ?");
        $stmt->bind_param("ssi", $dane[1], $dane[2], $dane[0]);

        if ($stmt->execute()) {
            echo "Kategoria zaktualizowana pomyślnie";
            header("Location:admin.php");
        } else {
            echo "Nie udało się zaktualizować kategorii";
        }

        $stmt->close();
    }

    public function pobierzId(): int
    {
        return $this->id;
    }

    public function ustawId(int $id): void
    {
        $this->id = $id;
    }

    public function pobierzRodzica()
    {
        return $this->rodzic;
    }

    public function ustawRodzica($rodzic): void
    {
        $this->rodzic = $rodzic;
    }

    public function pobierzNazwe(): string
    {
        return $this->nazwa;
    }

    public function ustawNazwe(string $nazwa): void
    {
        $this->nazwa = $nazwa;
    }
}
?>