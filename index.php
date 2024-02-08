<?php
    use MyApp\data\Database;
    require("vendor/autoload.php");
    $db = new Database;

    $url = 'https://www.omdbapi.com/?apikey=8efb52d2&s=[busqueda]';
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    $dataResponse = $data['Search'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Películas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

<div class="container mt-5">
    <div class="row">
        <?php foreach ($dataResponse as $result){ ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $result['Title']; ?></h5>
                        <p class="card-text">Año: <?php echo $result['Year']; ?></p>
                        <p class="card-text">Tipo: <?php echo $result['Type']; ?></p>
                        <p class="card-text">ID de IMDb: <?php echo $result['imdbID']; ?></p>

                        <button class="btn btn-primary add-to-favorites" 
                            data-imdb-id="<?php echo $result['imdbID']; ?>"
                            data-title="<?php echo $result['Title']; ?>"
                            data-year="<?php echo $result['Year']; ?>"
                            data-type="<?php echo $result['Type']; ?>"
                            data-poster="<?php echo $result['Poster']; ?>">Añadir a favoritos
                        </button>

                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.add-to-favorites').click(function(){
            var imdbID = $(this).data('imdb-id');
            var title = $(this).data('title');
            var year = $(this).data('year');
            var type = $(this).data('type');
            var poster = $(this).data('poster');
            
            $.ajax({
                url: 'agregar_a_favoritos.php',
                method: 'POST',
                data: {title: title, year: year, type: type, imdb_id: imdbID, poster: poster},
                success: function(response){
                    alert('Película añadida a favoritos');
                }
            });
        });
    });
</script>



$(document).ready(function(){
    $('.btn-delete').click(function(){
        var movieID = $(this).data('movie-id');
        $.ajax({
            url: 'eliminar_favorito.php',
            method: 'POST',
            data: {movie_id: movieID},
            success: function(response){
                // Actualizar la lista de favoritos en la página sin recargarla
                // Puedes hacer esto eliminando la película de la lista HTML o recargando la lista de favoritos
                alert('Película eliminada de favoritos');
            }
        });
    });
});


</body>
</html>
