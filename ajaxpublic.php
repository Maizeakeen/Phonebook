<?php
$user = 'root';
$pass = '';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=countries;', $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
}


$sql = "SELECT * FROM users";
try {
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchALL();
} catch (PDOException $e) {
    print $e->getMessage();
}
foreach ($data as $key => $value) {
    $output.='<div class="item">
            <div class="content">
                <p>' . $value["name"] . ' ' . $value["lastname"] . '<a class="right">show</a></p>
            </div>
           </div>';
}
echo '<div class="ui relaxed divided list">'.$output.'</div>';

