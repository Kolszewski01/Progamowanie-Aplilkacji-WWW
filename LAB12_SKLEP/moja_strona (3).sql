-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 11, 2024 at 03:09 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `matka` int(11) NOT NULL DEFAULT 0,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `matka`, `nazwa`) VALUES
(1, 0, 'Laptopy'),
(2, 0, 'Smartfony i smartwatche'),
(3, 0, 'Dom i ogród'),
(4, 1, 'Akcesoria do Laptopów'),
(5, 1, 'Laptopy'),
(6, 2, 'Smartfony'),
(7, 2, 'Smartwatche i zegarki'),
(8, 3, 'Narzędzia'),
(9, 3, 'Klucze');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'ab', '    <div id=\"main\">\r\n        <div id=\"divup\">\r\n            <h1>NAJWYŻSZE BUDOWLE ŚWIATA</h1>\r\n        </div>\r\n\r\n        <div id=\"divcenter2\" class=\"zdjecia\" >\r\n\r\n            <h2 class=\"h1\">Abradż al-Bajt</h2>\r\n        \r\n            <img src=\"img/aab1.jpg\" alt=\"Zdjęcie 1\" style=\"width: 250px;\" >\r\n            <img src=\"img/aab2.jpg\" alt=\"Zdjęcie 2\" style=\"width: 250px;\" >\r\n            <img src=\"img/aab3.jpeg\" alt=\"Zdjęcie 3\" style=\"width: 250px;\" >\r\n\r\n            <p class=\"tekstp\"><b>Abradż al-Bajt (arab. أبراج البيت, Abrāǧ al-Bayt) to okazały kompleks hotelowy w Mekce, Arabii Saudyjskiej, wznoszący się na wysokość około 601 metrów. To wyjątkowe miejsce stanowi nie tylko komfortowe zakwaterowanie, ale również symbol głębokich tradycji religijnych, przyciągając pielgrzymów oraz turystów z całego świata.</p>\r\n\r\n        </div>\r\n\r\n\r\n    </div>\r\n', 1),
(2, 'bc', '\r\n    <div id=\"main\">\r\n        <div id=\"divup\">\r\n            <h1>NAJWYŻSZE BUDOWLE ŚWIATA</h1>\r\n        </div>\r\n\r\n        <div id=\"divcenter2\" class=\"zdjecia\" >\r\n\r\n            <h2 class=\"h1\">Burdż chalifa</h2>\r\n            \r\n            <img src=\"img/bc1.jpg\" alt=\"Zdjęcie 1\" style=\"width: 250px;\" >\r\n            <img src=\"img/bc2.jpg\" alt=\"Zdjęcie 2\" style=\"width: 250px;\" >\r\n            <img src=\"img/bc3.jpg\" alt=\"Zdjęcie 3\" style=\"width: 250px;\" >\r\n\r\n            <p class=\"tekstp\"><b>Burdż Chalifa to jedna z najwyższych budowli na świecie, znajdująca się w Dubaju, Zjednoczonych Emiratach Arabskich. Została ukończona w 2010 roku i ma imponującą wysokość 828 metrów. Ten wieżowiec zrewolucjonizował architekturę i inżynierię, stanowiąc prawdziwe arcydzieło. Burdż Chalifa oferuje mieszkańcom i turystom wiele pięter, na których znajdują się luksusowe apartamenty, biura, restauracje i obserwatorium na najwyższym poziomie. Wspaniała fasada i nowoczesny design sprawiają, że to nie tylko symbol Dubaju, ale także całego świata. To ikona innowacji i luksusu, przyciągająca uwagę milionów ludzi z całego globu.</p>\r\n\r\n        </div>\r\n\r\n  \r\n    </div>\r\n', 1),
(3, 'lwt', '\r\n    <div id=\"main\">\r\n        <div id=\"divup\">\r\n            <h1>NAJWYŻSZE BUDOWLE ŚWIATA</h1>\r\n        </div>\r\n\r\n        <div id=\"divcenter2\" class=\"zdjecia\" >\r\n\r\n            <h2 class=\"h1\">Lotte World Tower</h2>\r\n            \r\n            <img src=\"img/lwt2.jpg\" alt=\"Zdjęcie 1\" style=\"width: 250px;\" >\r\n            <img src=\"img/lwt3 - Copy.jpg\" alt=\"Zdjęcie 2\" style=\"width: 250px;\" >\r\n            <img src=\"img/lwt4 - Copy.jpg\" alt=\"Zdjęcie 3\" style=\"width: 250px;\" >\r\n\r\n            <p class=\"tekstp\"><b>\r\n                Lotte World Tower to okazały drapacz chmur w Seulu, Korei Południowej. Z wysokością wynoszącą około 555 metrów jest jednym z najwyższych budynków na świecie. Kompleks ten obejmuje biura, luksusowy hotel, centrum handlowe i widokowe obserwatorium, które oferuje niesamowite widoki na miasto i okolicę. Lotte World Tower to nie tylko symbol nowoczesności Seulu, ale także ważne centrum kultury, rozrywki i biznesu w regionie Azji Wschodniej.\r\n\r\n            </p>\r\n\r\n        </div>\r\n\r\n    </div>\r\n', 1),
(4, 'pfc', '\r\n    <div id=\"main\">\r\n        <div id=\"divup\">\r\n            <h1>NAJWYŻSZE BUDOWLE ŚWIATA</h1>\r\n        </div>\r\n\r\n        <div id=\"divcenter2\" class=\"zdjecia\" >\r\n\r\n            <h2 class=\"h1\">Ping An Finance Center</h2>\r\n            \r\n            <img src=\"img/pfc1.jpg\" alt=\"Zdjęcie 1\" style=\"width: 250px;\" >\r\n            <img src=\"img/pfc3.jpg\" alt=\"Zdjęcie 2\" style=\"width: 250px;\" >\r\n            <img src=\"img/pfc2.jpg\" alt=\"Zdjęcie 3\" style=\"width: 250px;\" >\r\n\r\n            <p class=\"tekstp\"><b>Ping An Finance Center to wyjątkowy drapacz chmur w Shenzhen, Chińska Republika Ludowa. \r\n                Z wysokością wynoszącą około 599 metrów, jest jednym z najwyższych budynków na świecie. To architektoniczne \r\n                arcydzieło stanowi zarówno symbol gospodarczego rozwoju Chin, jak i oferuje różnorodne funkcje, obejmujące biura, \r\n                hotele, restauracje oraz spektakularne widoki z obserwatorium na najwyższym piętrze, co przyciąga zarówno biznesowych gości, \r\n                jak i turystów. Ping An Finance Center stanowi znakomicie zrealizowany projekt architektoniczny i inżynieryjny.\r\n\r\n            </p>\r\n        </div>\r\n    </div>\r\n', 1),
(5, 'st', '\r\n    <div id=\"main\">\r\n        <div id=\"divup\">\r\n            <h1>NAJWYŻSZE BUDOWLE ŚWIATA</h1>\r\n        </div>\r\n\r\n        <div id=\"divcenter2\" class=\"zdjecia\" >\r\n\r\n            <h2 class=\"h1\">Shanghai Tower</h2>\r\n            \r\n            <img src=\"img/st1.jpg\" alt=\"Zdjęcie 1\" style=\"width: 250px;\" >\r\n            <img src=\"img/st2.jpg\" alt=\"Zdjęcie 2\" style=\"width: 250px;\" >\r\n            <img src=\"img/st3.jpg\" alt=\"Zdjęcie 3\" style=\"width: 250px;\" >\r\n\r\n            <p class=\"tekstp\"><b>Shanghai Tower to jedna z najwyższych budowli na świecie, znajdująca się w Szanghaju, Chinach. Ma 632 metry wysokości i charakteryzuje się spiralnym kształtem. Zbudowany w 2015 roku, oferuje różnorodne zastosowania, w tym biura, hotele i obserwatorium na najwyższym piętrze z zapierającymi dech w piersiach widokami. To znakomity przykład nowoczesnej architektury.</p>\r\n\r\n        </div>\r\n</div>\r\n', 1),
(6, 'glowna', '<div id=\"main\">\r\n    <div id=\"divup\">\r\n        <h1>NAJWYŻSZE BUDOWLE ŚWIATA</h1>\r\n    </div>\r\n\r\n    <div id=\"divcenter\">\r\n        <div id=\"divleft\">\r\n            <h3> Skontaktu się z nami!</h3>\r\n            \r\n\r\n<form action=\"./contact.php\" method=\"post\">\r\n  <label for=\"fname\">Imię</label>\r\n  <input type=\"text\" id=\"fname\" name=\"firstname\" placeholder=\"Twoję imię...\">\r\n\r\n  <label for=\"email\">E-Mail</label>\r\n  <input type=\"text\" id=\"email\" name=\"email\" placeholder=\"Twój email...\">\r\n\r\n  <label for=\"subject\">Temat</label>\r\n  <textarea id=\"subject\" name=\"content\" placeholder=\"Napisz coś\" style=\"height:350px\"></textarea>\r\n\r\n  <input type=\"submit\" name = \"submit\" value=\"Wyślij\">\r\n</form>\r\n\r\n        </div>\r\n\r\n        <div id=\"divright\">\r\n            <h2>\r\n                Witamy Cię na naszej fascynującej stronie internetowej,\r\n                 poświęconej najwyższym budynkom na świecie! \r\n            </h2>\r\n            <br><br><br>\r\n            <span class=\"indexopis\"> Jeśli jesteś miłośnikiem architektury, inżynierii i \r\n                oszałamiających osiągnięć ludzkiej pomysłowości,\r\n                to jesteś we właściwym miejscu.<br><br>\r\n\r\n                Nasza witryna jest prawdziwym źródłem wiedzy i inspiracji.\r\n                Przeniesiemy Cię w podróż do niezwykłych miejsc,\r\n                gdzie gigantyczne wieżowce przyciągają uwagę i budzą zachwyt. \r\n                Odkryjesz historię, innowacje i wyzwania,\r\n                które towarzyszą konstrukcji tych monumentalnych budynków. <br><br>\r\n                \r\n                Prezentujemy Ci wieże, które wznoszą się na niebie i przesuwają granice tego,\r\n                 co jest możliwe. Dlaczego Burj Khalifa w Dubaju jest tak wyjątkowy? \r\n                 Jak Shanghai Tower w Szanghaju zmienia nasze postrzeganie architektury?\r\n                  Odpowiedzi na te pytania i wiele innych znajdziesz na naszej stronie.</span>\r\n                  \r\n        </div>\r\n    </div>', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) DEFAULT NULL,
  `opis` text NOT NULL,
  `data_utworzenia` date NOT NULL DEFAULT current_timestamp(),
  `data_modyfikacji` date NOT NULL DEFAULT current_timestamp(),
  `data_wygasniecia` date DEFAULT NULL,
  `cena_netto` float NOT NULL,
  `podatek_vat` float NOT NULL DEFAULT 1.23,
  `ilosc_dostepnych_sztuk` int(11) DEFAULT NULL,
  `status_dostepnosci` varchar(255) DEFAULT NULL,
  `kategoria` int(11) NOT NULL,
  `gabaryt_produktu` varchar(255) DEFAULT NULL,
  `zdjecie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `tytul`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `podatek_vat`, `ilosc_dostepnych_sztuk`, `status_dostepnosci`, `kategoria`, `gabaryt_produktu`, `zdjecie`) VALUES
(1, 'Podstawka Chłodząca XYZ', 'Ergonomiczna podstawka chłodząca do laptopów z regulowaną wysokością.', '2024-01-11', '2024-01-11', '2024-03-21', 99.99, 1.23, 20, 'Dostepny', 4, 'maly', '\\pawww\\LAB12_SKLEP\\img\\podstawka.png'),
(2, 'Zestaw Naklejek Dekoracyjnych', 'Zestaw kreatywnych naklejek do personalizacji laptopa.', '2024-01-11', '2024-01-11', NULL, 19.99, 1.23, 50, 'Dostepny', 4, 'maly', '\\pawww\\LAB12_SKLEP\\img\\naklejki.png'),
(3, 'Laptop UltraBook Pro', 'Wysokowydajny laptop dla profesjonalistów, idealny do pracy i rozrywki.', '2024-01-11', '2024-01-11', NULL, 4599.99, 1.23, 10, 'Dostepny', 5, 'sredni', '\\pawww\\LAB12_SKLEP\\img\\laptop1.png'),
(4, 'Laptop Gamingowy Monster', 'Laptop gamingowy z najnowszymi komponentami, zapewniający płynną rozgrywkę.', '2024-01-11', '2024-01-11', NULL, 4999.99, 1.23, 8, 'Dostepny', 5, 'sredni', '\\pawww\\LAB12_SKLEP\\img\\laptop3.png'),
(5, 'Smartfon Galaxy X', 'Zaawansowany smartfon z dużym wyświetlaczem i wysokiej jakości aparatem.', '2024-01-11', '2024-01-11', NULL, 2999.99, 1.23, 15, 'Dostepny', 6, 'maly', '\\pawww\\LAB12_SKLEP\\img\\tel1.png'),
(6, 'Smartfon Pixel Pro', 'Inteligentny smartfon z najnowszym systemem operacyjnym i innowacyjnymi funkcjami.', '2024-01-11', '2024-01-11', NULL, 2799.99, 1.23, 20, 'Dostepny', 6, 'maly', '\\pawww\\LAB12_SKLEP\\img\\tel2.png'),
(7, 'Smartwatch HealthTrack', 'Smartwatch z funkcjami monitorowania zdrowia i aktywności fizycznej.', '2024-01-11', '2024-01-11', NULL, 799.99, 1.23, 30, 'Dostepny', 7, 'maly', '\\pawww\\LAB12_SKLEP\\img\\smartwatch.png'),
(8, 'Elegant Watch Silver', 'Klasyczny zegarek z srebrnym wykończeniem, łączący styl i technologię.', '2024-01-11', '2024-01-11', NULL, 499.99, 1.23, 25, 'Dostepny', 7, 'maly', '\\pawww\\LAB12_SKLEP\\img\\rolex.png'),
(9, 'Wiertarka Elektryczna PowerDrill', 'Wysokiej jakości wiertarka elektryczna do zadań domowych i profesjonalnych.', '2024-01-11', '2024-01-11', NULL, 349.99, 1.23, 12, 'Dostepny', 8, 'sredni', '\\pawww\\LAB12_SKLEP\\img\\ryobi.png'),
(10, 'Zestaw Kluczy Uniwersalnych', 'Kompletny zestaw kluczy uniwersalnych do każdego warsztatu.', '2024-01-11', '2024-01-11', NULL, 199.99, 1.23, 20, 'Dostepny', 8, 'maly', '\\pawww\\LAB12_SKLEP\\img\\klucze.png'),
(12, 'Zestaw Kluczy Imbusowych', 'Wielofunkcyjny zestaw kluczy imbusowych dla majsterkowiczów.', '2024-01-11', '2024-01-11', NULL, 59.99, 1.23, 40, 'Dostepny', 9, 'maly', '\\pawww\\LAB12_SKLEP\\img\\imbus.png'),
(23, 'Klucz Francuski MaxGrip', 'Wytrzymały klucz francuski, idealny do prac hydraulicznych i mechanicznych.', '2024-01-11', '2024-01-11', NULL, 89.99, 1.23, 30, 'Dostepny', 9, 'maly', '\\pawww\\LAB12_SKLEP\\img\\francuz.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`) VALUES
(1, 'admin', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategoria` (`kategoria`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `fk_kategoria` FOREIGN KEY (`kategoria`) REFERENCES `kategorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
