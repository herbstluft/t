<?php
    use MyApp\data\Database;
    require("vendor/autoload.php");
    $db = new Database;

    if(isset($_POST['title']) && isset($_POST['year']) && isset($_POST['type']) && isset($_POST['imdb_id']) && isset($_POST['poster'])){
        $title = $_POST['title'];
        $year = $_POST['year'];
        $type = $_POST['type'];
        $imdbID = $_POST['imdb_id'];
        $poster = $_POST['poster'];

       
       $insert_fav="INSERT INTO `favoritos` (`nombre`, `ano`, `imdb`, `tipo`, `imagen`) VALUES ('$title', '$year', '$imdbID', '$type', '$poster')";
       $db->ejecutarConsulta($insert_fav);
        echo 'success';
    } else {
        echo 'error';
    }
?>
