<?php
require_once('vendor/autoload.php');

use GuzzleHttp\Client;

$movie = [];
$movieUrl = '';

if (isset($_GET['movie_id']) && !empty($_GET['movie_id'])) {
    $movieId = $_GET['movie_id'];
    $client = new Client();

    try {
        // Fetch movie details from the TMDb API
        $response = $client->request('GET', "https://api.themoviedb.org/3/movie/$movieId", [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiNWM1MmE0OGI4MGI2MTBjZjNlOTkzMzQxOTY0YTA5YSIsIm5iZiI6MTcyNTk5Mjg0Ni4zMDM5Nywic3ViIjoiNjZlMDhlYmFjN2NmMmRkOTlmNWM3ZGYxIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.mHmEZ6DKNIENGtAsJG7XoEhoLU_3C5AdhKfpw1QyBtc',
                'Accept' => 'application/json',
            ],
            'query' => [
                'language' => 'en-US'
            ]
        ]);

        $movie = json_decode($response->getBody(), true);
        
        // Set initial movie URL
        $movieUrl = "https://www.2embed.stream/embed/movie/$movieId";

    } catch (Exception $e) {
        echo '<p>Error fetching movie details: ' . $e->getMessage() . '</p>';
        exit; // Exit the script if there's an error
    }
} else {
    echo '<p>Invalid parameters provided!</p>';
    exit; // Exit if parameters are not valid
}

// Render the movie video player
if (!empty($movie)) :
?>

<h2 style="text-align:center; background-color:white;"><?= htmlspecialchars($movie['title']); ?></h2>
<div id="modalOverlay" style="position:fixed; top:0; left:0; width:100vw; height:100vh; background-color:rgba(0, 0, 0, 0.7); z-index: 1000; display:flex; justify-content:center; align-items:center;">
    <div class="movie-details-card" id="movieDetailsModal" style="background: none; width: 80vw; height: 90vh; position: relative; padding: 20px; border-radius: 10px; display: flex; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
        <div class="movie-info" style="border-radius:15px;z-index:1;height:100%;width:100%;overflow:hidden;">
            <div style="position:absolute;top: 5px;right:-5px">
                <button id="closeModalButton" onMouseOver="this.style.color='red'" 
                   onMouseOut="this.style.color='black'" style="font-size: 24px; background: none; border-radius: 50%; border:none;cursor: pointer;">&times;</button>
            </div>
            <button id="switchSourceButton" style="position:absolute;bottom:10px;right:10px;padding:10px 20px;border:none;background-color:blue;color:white;border-radius:5px;cursor:pointer;">
                Switch Server
            </button>
            <iframe id="moviePlayer" src="<?= htmlspecialchars($movieUrl); ?>" width="100%" height="100%" frameborder="0" scrolling="no" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script>
    // Function to navigate to details1.php with the movie_id
    document.getElementById('closeModalButton').addEventListener('click', function() {
        window.location.href = "details1.php?movie_id=<?= htmlspecialchars($movieId); ?>"; // Correct URL without extra quotes
    });

    // JavaScript to toggle the movie source
    document.getElementById('switchSourceButton').addEventListener('click', function() {
        var iframe = document.getElementById('moviePlayer');
        var originalUrl = "<?= htmlspecialchars($movieUrl); ?>";
        var alternateUrl = "https://v1.sdsp.xyz/embed/movie/<?= $movieId; ?>";

        // Toggle the iframe source between the original and alternate URL
        iframe.src = (iframe.src === originalUrl) ? alternateUrl : originalUrl;
    });
</script>

<?php else : ?>
    <p>No movie details available!</p>
<?php endif; ?>
