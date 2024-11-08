<?php
require_once('vendor/autoload.php');

use GuzzleHttp\Client;

$movie = [];
$cast = [];
$trailerKey = '';

// Check if a movie ID is provided in the URL
if (isset($_GET['movie_id']) && !empty($_GET['movie_id'])) {
    $movieId = $_GET['movie_id'];
    $client = new Client();

    try {
        // Fetch movie details
        $response = $client->request('GET', "https://api.themoviedb.org/3/movie/$movieId", [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiNWM1MmE0OGI4MGI2MTBjZjNlOTkzMzQxOTY0YTA5YSIsIm5iZiI6MTcyNTk5Mjg0Ni4zMDM5Nywic3ViIjoiNjZlMDhlYmFjN2NmMmRkOTlmNWM3ZGYxIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.mHmEZ6DKNIENGtAsJG7XoEhoLU_3C5AdhKfpw1QyBtc', // Use environment variable for security
                'Accept' => 'application/json',
            ],
            'query' => [
                'language' => 'en-US'
            ]
        ]);

        $movie = json_decode($response->getBody(), true);

        // Fetch cast details
        $castResponse = $client->request('GET', "https://api.themoviedb.org/3/movie/$movieId/credits", [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiNWM1MmE0OGI4MGI2MTBjZjNlOTkzMzQxOTY0YTA5YSIsIm5iZiI6MTcyNTk5Mjg0Ni4zMDM5Nywic3ViIjoiNjZlMDhlYmFjN2NmMmRkOTlmNWM3ZGYxIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.mHmEZ6DKNIENGtAsJG7XoEhoLU_3C5AdhKfpw1QyBtc',
                'Accept' => 'application/json',
            ]
        ]);

        $cast = json_decode($castResponse->getBody(), true)['cast'];

        // Fetch movie trailer (videos)
        $trailerResponse = $client->request('GET', "https://api.themoviedb.org/3/movie/$movieId/videos", [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiNWM1MmE0OGI4MGI2MTBjZjNlOTkzMzQxOTY0YTA5YSIsIm5iZiI6MTcyNTk5Mjg0Ni4zMDM5Nywic3ViIjoiNjZlMDhlYmFjN2NmMmRkOTlmNWM3ZGYxIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.mHmEZ6DKNIENGtAsJG7XoEhoLU_3C5AdhKfpw1QyBtc',
                'Accept' => 'application/json',
            ],
            'query' => [
                'language' => 'en-US'
            ]
        ]);

        $videos = json_decode($trailerResponse->getBody(), true)['results'];
        
        // Find the YouTube trailer
        foreach ($videos as $video) {
            if ($video['site'] === 'YouTube' && $video['type'] === 'Trailer') {
                $trailerKey = $video['key']; // Get the YouTube video key
                break;
            }
        }

    } catch (Exception $e) {
        echo '<p>Error fetching movie details: ' . $e->getMessage() . '</p>';
    }
}

// Render movie details content for the modal
if (!empty($movie)) :
?>

    <!-- Modal Overlay -->
    <div id="modalOverlay" style="position:fixed; top:0; left:0; width:100vw; height:100vh; background-color:rgba(0, 0, 0, 0.7); z-index: 1000; display:flex; justify-content:center; align-items:center;">
        
        <!-- Movie Details Modal -->
        <div class="movie-details-card" id="movieDetailsModal" style="background-color: white; width: 70%; height: 90%; position: relative; padding: 1%; border-radius: 2%; display: flex; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
            <!-- Close Button -->
            <div style="position: absolute; top: 2%; right: 2%;">
                <button id="closeModalButton" style="font-size: 24px; background: none; border: none; cursor: pointer;" onMouseOver="this.style.color='red'" 
       onMouseOut="this.style.color='black'" >&times;</button>
            </div>
            
            <!-- Movie Poster -->
            <div class="movie-poster" style="flex: 1;">
                <img src="https://image.tmdb.org/t/p/w400<?= $movie['poster_path']; ?>" alt="<?= htmlspecialchars($movie['title']); ?>" style="width: 100%; height: 100%; border-radius: 2%;">
            </div>
            
            <!-- Movie Info -->
            <div class="movie-info" style="flex: 1; padding-left: 2%; overflow-y:auto;max-height:100%;">
                <h2><?= htmlspecialchars($movie['title']); ?></h2>
                <?php if (!empty($trailerKey)) : ?>
                    <div style="border-radius:3%;z-index:1;height:35vh;width:34vw;overflow:hidden;" >
                        <iframe width="100%" height="100%" 
                            src="https://www.youtube.com/embed/<?= $trailerKey; ?>?autoplay=1" 
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen p>
                        </iframe>
                    </div>
                <?php endif; ?>
                <p><strong>Release Date:</strong> <?= htmlspecialchars($movie['release_date']); ?></p>
                <p style="width:100%"><strong>Overview:</strong> <?= htmlspecialchars($movie['overview']); ?></p>
                <h3>Cast</h3>
                <ul>
                    <?php foreach (array_slice($cast, 0, 3) as $actor) : ?>
                        <li><?= htmlspecialchars($actor['name']); ?> as <?= htmlspecialchars($actor['character']); ?></li>
                    <?php endforeach; ?>
                </ul>

                <a href="movieplay.php?movie_id=<?=htmlspecialchars($movie['id'])?>">
                    <button style="padding: 2% 20%; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Play Movie</button>
                </a>
                <!-- YouTube Player for Trailer -->
            </div>
        </div>
    </div>


    <script>


// Function to navigate back to the stored previous page URL
document.getElementById('closeModalButton').addEventListener('click', function() {
    
        window.location.href = "index1.php"; // Navigate to the previous page URL
    
});
    </script>


<?php else : ?>
    <p>No movie details available!</p>
<?php endif; ?>
