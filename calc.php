<?php
    session_start();

    if(!isset($_SESSION['calc'])) {
        $_SESSION['calc'] = ['display' => '0', 'preValue' => null, 'operator' => null];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = $_POST['button'];
        $display = &$_SESSION['calc']['display'];
        $prevValue = &$_SESSION['calc']['preValue'];
        $operator = &$_SESSION['calc']['operator'];
    
        if($input == "C") {
            $display = "0";
            $prevValue = null;
            $operator = null;
        } elseif($input == "+" || $input == "-" || $input == "×" || $input == "÷") {
            if($operator !== null) {
                $display = calc($prevValue, $display, $operator);
            }
            $prevValue = $display;
            $operator = $input;
            $display = "0";
        } elseif($input == "=") {
            if($operator !== null) {
                $display = calc($prevValue, $display, $operator);
                $prevValue = null;
                $operator = null;
            }
        } else {
            if($display === "0") {
                $display = $input;
            } else {
                $display .= $input;
            }
        }
    }

    function calc($value1, $value2, $op) {
        switch($op) {
            case "+":
                return strval(floatval($value1) + floatval($value2));
                break;

            case "-":
                return strval(floatval($value1) - floatval($value2));
                break;

            case "×":
                return strval(floatval($value1) * floatval($value2));
                break;

            case "÷":
                if ($value2 != "0") {
                    return strval(floatval($value1) / floatval($value2));
                } else {
                    return $display = "ERROR";
                }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>電卓</title>
    </head>

    <body>
        <h1>電卓</h1>
        <p><?php echo $_SESSION['calc']['display']; ?></p>
        
        <form action="" method="post">
        <table>
            <tr align="justify">
                <td><button type="submit" name="button" value="C">C</button></td>
                <td><button type="submit" name="button" value="%">%</button></td>
            </tr>

            <tr align="center">
                <td><button type="submit" name="button" value="7">7</button></td>
                <td><button type="submit" name="button" value="8">8</button></td>
                <td><button type="submit" name="button" value="9">9</button></td>
                <td><button type="submit" name="button" value="÷">÷</button></td>
            </tr>

            <tr align="center">
                <td><button type="submit" name="button" value="4">4</button></td>
                <td><button type="submit" name="button" value="5">5</button></td>
                <td><button type="submit" name="button" value="6">6</button></td>
                <td><button type="submit" name="button" value="×">×</button></td>
            </tr>

            <tr align="center">
                <td><button type="submit" name="button" value="1">1</button></td>
                <td><button type="submit" name="button" value="2">2</button></td>
                <td><button type="submit" name="button" value="3">3</button></td>
                <td><button type="submit" name="button" value="-">-</button></td>
            </tr>

            <tr align="center">
                <td><button type="submit" name="button" value="0">0</button></td>
                <td><button type="submit" name="button" value=".">.</button></td>
                <td><button type="submit" name="button" value="=">=</button></td>
                <td><button type="submit" name="button" value="+">+</button></td>
            </tr>
        </table>
        </form>
    </body>
</html>