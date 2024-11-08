<?php
require_once('vendor/autoload.php');

use GuzzleHttp\Client;

$tvShow = [];
$episodeUrl = '';

if (isset($_GET['tv_id']) && !empty($_GET['tv_id']) && isset($_GET['season']) && isset($_GET['episode'])) {
    $tvId = $_GET['tv_id'];
    $season = $_GET['season'];
    $episode = $_GET['episode'];
    $client = new Client();

    try {
        // Fetch episode details from the TMDb API
        $response = $client->request('GET', "https://api.themoviedb.org/3/tv/$tvId", [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiNWM1MmE0OGI4MGI2MTBjZjNlOTkzMzQxOTY0YTA5YSIsIm5iZiI6MTcyNTk5Mjg0Ni4zMDM5Nywic3ViIjoiNjZlMDhlYmFjN2NmMmRkOTlmNWM3ZGYxIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.mHmEZ6DKNIENGtAsJG7XoEhoLU_3C5AdhKfpw1QyBtc',
                'Accept' => 'application/json',
            ],
            'query' => [
                'language' => 'en-US'
            ]
        ]);

        $tvShow = json_decode($response->getBody(), true);

        // Set initial episode URL
        $episodeUrl = "https://multiembed.mov/directstream.php?video_id=$tvId&tmdb=1&s=$season&e=$episode";

    } catch (Exception $e) {
        echo '<p>Error fetching episode details: ' . $e->getMessage() . '</p>';
        exit; // Exit the script if there's an error
    }
} else {
    echo '<p>Invalid parameters provided!</p>';
    exit; // Exit if parameters are not valid
}

// Render the episode video player
if (!empty($tvShow)) :
?>

<h2 style="text-align:center; background-color:white;"><?= htmlspecialchars($tvShow['name']); ?></h2>
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
            <iframe id="episodePlayer" src="<?= htmlspecialchars($episodeUrl); ?>" width="100%" height="100%" frameborder="0" scrolling="no" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script>
    // Function to navigate to details2.php with the movie_id
    document.getElementById('closeModalButton').addEventListener('click', function() {
        window.location.href = "details2.php?movie_id=<?= htmlspecialchars($tvId); ?>"; // Correct URL without extra quotes
    });

    // JavaScript to toggle the episode source
    document.getElementById('switchSourceButton').addEventListener('click', function() {
        var iframe = document.getElementById('episodePlayer');
        var originalUrl = "<?= htmlspecialchars($episodeUrl); ?>";
        var alternateUrl = "https://v1.sdsp.xyz/embed/tv/<?= $tvId; ?>_<?= $season; ?>_<?= $episode; ?>";

        // Toggle the iframe source between the original and alternate URL
        iframe.src = (iframe.src === originalUrl) ? alternateUrl : originalUrl;
    });
</script>

<?php else : ?>
    <p>No movie details available!</p>
<?php endif; ?>
