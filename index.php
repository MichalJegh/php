<?php
session_start();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<?php
if(empty($_SESSION["jazyk"]))
{
 $_SESSION["jazyk"]="sk";
}

    if(!empty($_GET["jazyk"]))
    {
        $_SESSION["jazyk"]=$_GET["jazyk"];
    }
    else{
        $_SESSION["jazyk"]="sk";
    }
//}
var_dump($_SESSION["jazyk"]);
?>

<a href=index.php?jazyk=sk>sk</a>
<a href=index.php?jazyk=en>en</a>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jegh";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(!empty($_GET["trieda"]))
{
    $where = " WHERE rozvrh.trieda= '".$_GET["trieda"]."'";
}
else{
    $where="";
}

$sql = "SELECT * FROM rozvrh " .$where;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    $rozvrh[$row["den"]][$row["hodina"]]=$row["predmet"];
    }
} else {
    echo "0 results";
}

//mysqli_close($conn);
?>
<?php
$rozvrh[4][7] = "NIČ";
$dni = array("Pondelok", "Utorok", "Streda", "Stvrtok", "Pondelok");
$hodiny = array(0, 1, 2, 3, 4, 5,6,7);
?>
<!DOCTYPE html>
<html>
<head>

    <title> tabulka</title>
</head>
</html>

<table border=1 class="table">
    <tr>
        <td>DEN</td>
        <? foreach ($hodiny as $i => $hodina): ?>
            <td><? echo $hodina; ?></td>
        <? endforeach; ?>
    </tr>
    <? foreach ($dni as $i => $den): ?>
        <tr>
            <td><? echo $den; ?><?echo $i;?></td>
            <? foreach ($hodiny as $j => $hodina): ?>
                <td><? echo @$rozvrh[$i][$j]; ?><?echo $j;?></td>
            <? endforeach; ?>
        </tr>
    <? endforeach; ?>
</table>



<table border =1>
</table>
<?php
echo "<pre>";
//var_dump($rozvrh);
?>
<?php
$sql = " SELECT trieda
        FROM rozvrh
        GROUP BY trieda ORDER BY trieda";
$result = mysqli_query ($conn,$sql);
while($row = mysqli_fetch_assoc($result))
    {
    echo "<a href=index.php?trieda=".$row["trieda"].">".$row["trieda"]."</a>
        <br/>";
    }
?>

