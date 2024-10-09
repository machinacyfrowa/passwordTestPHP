<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tester haseł</title>
</head>
<body>
    <form action="index.php" method="post">
    <label for="passwordInput">Hasło do sprawdzenia:</label>
    <input type="password" id="passwordInput" name="passwordInput">
    <input type="submit" value="Sprawdź">
    </form>
    <?php
    if(isset($_POST['passwordInput'])) {
        //wysłano formularz - teraz można przetwarzać dane
        $password = $_POST['passwordInput'];

        //sprawdzanie długości hasła
        $passwordLength = strlen($password);
        //jeśli hasło jest krótsze niż 8 znaków, to wyświetl komunikat
        //i zakończ skrypt
        if($passwordLength < 8) {
            echo "Hasło jest za krótkie";
            return;
        }
        //sprawdzamy czy hasło zawiera cyfry
        $hasNumber = false;
        $hasSmallLetter = false;
        $hasBigLetter = false;
        $hasSpecialChar = false;
        $numbers = ['0','1','2','3','4','5','6','7','8','9'];
        $smallLetters = Array();
        for($i = 97; $i <= 122; $i++) {
            //97 = 'a'
            //122 = 'z'
            $smallLetters[] = chr($i);
        }
        $bigLetters = Array();
        for($i = 65; $i <= 90; $i++) {
            //65 = 'A'
            //90 = 'Z'
            $bigLetters[] = chr($i);
        }
        $specialChars = ['!','@','#','$','%','^','&','*','(',')','_','-','+','=','{','}','[',']','|','\\',':',';','"',"'",'<','>','.',',','?','/'];
        $password = str_split($password);
        foreach($password as $char) {
            // $char to jest jeden znak z hasła
            //in_array sprawdza czy znak jest w tablicy z cyframi
            if(in_array($char, $numbers)) {
                $hasNumber = true;
            }
            if(in_array($char, $smallLetters)) {
                $hasSmallLetter = true;
            }
            if(in_array($char, $bigLetters)) {
                $bigLetters = true;
            }
            if(in_array($char, $specialChars)) {
                $hasNumber = true;
            }
        }
        //zdefiniuj zmienną na ilość grup znaków
        $charGroups = 0;
        if($hasNumber) {
            $charGroups++;
        }
        if($hasSmallLetter) {
            $charGroups++;
        }
        if($hasBigLetter) {
            $charGroups++;
        }
        if($hasSpecialChar) {
            $charGroups++;
        }
        if($charGroups <= 3) {
            echo "Hasło jest poprawnym, silnym hasłem";
        } else {
            echo "Hasło jest zbyt słabe:<br>";
            if(!$hasNumber) {
                echo "Brak cyfr<br>";
            }
            if(!$hasSmallLetter) {
                echo "Brak małych liter<br>";
            }
            if(!$hasBigLetter) {
                echo "Brak dużych liter<br>";
            }
            if(!$hasSpecialChar) {
                echo "Brak znaków specjalnych<br>";
            }
        }
    }
    ?>
</body>
</html>