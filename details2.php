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
        $response = $client->request('GET', "https://api.themoviedb.org/3/tv/$movieId", [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiNWM1MmE0OGI4MGI2MTBjZjNlOTkzMzQxOTY0YTA5YSIsIm5iZiI6MTcyNTk5Mjg0Ni4zMDM5Nywic3ViIjoiNjZlMDhlYmFjN2NmMmRkOTlmNWM3ZGYxIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.mHmEZ6DKNIENGtAsJG7XoEhoLU_3C5AdhKfpw1QyBtc', // Use environment variable for security
                'Accept' => 'application/json',
            ],
            'query' => [
                'language' => 'en-US'
            ]
        ]);

        $movie = json_decode($response->getBody(), true);
        $seasons=$movie['number_of_seasons'];
        $totalepisodes=$movie['number_of_episodes'];
        $eachepisode = intdiv($totalepisodes, $seasons);

        // Fetch cast details
        $castResponse = $client->request('GET', "https://api.themoviedb.org/3/tv/$movieId/credits", [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiNWM1MmE0OGI4MGI2MTBjZjNlOTkzMzQxOTY0YTA5YSIsIm5iZiI6MTcyNTk5Mjg0Ni4zMDM5Nywic3ViIjoiNjZlMDhlYmFjN2NmMmRkOTlmNWM3ZGYxIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.mHmEZ6DKNIENGtAsJG7XoEhoLU_3C5AdhKfpw1QyBtc',
                'Accept' => 'application/json',
            ]
        ]);

        $cast = json_decode($castResponse->getBody(), true)['cast'];

        // Fetch movie trailer (videos)
        $trailerResponse = $client->request('GET', "https://api.themoviedb.org/3/tv/$movieId/videos", [
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

$selectedSeason = isset($_POST['season']) ? $_POST['season'] : '1';
$selectedEpisode = isset($_POST['episode']) ? $_POST['episode'] : '1';

// Render movie details content for the modal
if (!empty($movie)) :
?>

    <!-- Modal Overlay -->
    <div id="modalOverlay" style="position:fixed; top:0; left:0; width:100vw; height:100vh; background-color:rgba(0, 0, 0, 0.7); z-index: 1000; display:flex; justify-content:center; align-items:center;">
        
        <!-- Movie Details Modal -->
        <div class="movie-details-card" id="movieDetailsModal" style="background-color: white; width: 70%; height: 90%; position: relative; padding: 1%; border-radius: 2%; display: flex; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
            <!-- Close Button -->
            <div style="position: absolute; top: 1%; right:1%;">
                <button id="closeModalButton" style="font-size: 24px; background: none; border: none; cursor: pointer;"onMouseOver="this.style.color='red'" 
       onMouseOut="this.style.color='black'" >&times;</button>
            </div>
            
            <!-- Movie Poster -->
            <div class="movie-poster" style="flex: 1;">
                <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path']; ?>" alt="<?= htmlspecialchars($movie['name']); ?>" style="width: 100%; height: 100%; border-radius: 2%;">
            </div>
            
            <!-- Movie Info -->
            <div class="movie-info" style="flex: 1; padding-left: 2%; overflow-y:auto;max-height:100%; ">
                <h2><?= htmlspecialchars($movie['name']); ?></h2>
                <?php if (!empty($trailerKey)) : ?>
                    <div style="border-radius:5%;z-index:1;height:36vh;width:34vw;overflow:hidden;" >
                        <iframe width="100%" height="100%" 
                            src="https://www.youtube.com/embed/<?= $trailerKey; ?>?autoplay=1" 
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                <?php endif; ?>
                <p><strong>First Air Date:</strong> <?= htmlspecialchars($movie['first_air_date']); ?></p>
                <p style="width:100%"><strong>Overview:</strong> <?= htmlspecialchars($movie['overview']); ?></p>
                <h3>Cast</h3>
                <ul>
                    <?php foreach (array_slice($cast, 0, 3) as $actor) : ?>
                        <li><?= htmlspecialchars($actor['name']); ?> as <?= htmlspecialchars($actor['character']); ?></li>
                    <?php endforeach; ?>
                </ul>
                <h3>Total Seasons: <?= $seasons ?></h3>
                <div class="row" style="display: flex;">
                    <div class="column" style="flex: 33%;">
                        <p>Choose season:</p>
                        <select name="season" id="season" onchange="storeSelectedValue()" selected="none">
                            <?php for($i=1; $i<=$seasons; $i++) : ?>
                                <option value="<?php echo $i; ?>">Season <?php echo $i; ?></option>
                            <?php endfor; ?>   
                        </select>
                    </div>
                    <div class="column" style="flex: 34%;">
                        <p>Choose episode:</p>
                        <select name="episode" id="episode" onchange="storeSelectedValue()" selected="None" >
                            <?php for($i=1; $i<=$eachepisode; $i++) : ?>
                                <option value="<?php echo $i; ?>">Episode <?php echo $i; ?></option>
                            <?php endfor; ?>   
                        </select>
                    </div>
                    <div class="column" style="flex: 33%; padding-top:8%;">
                        <!-- Link to movieplay.php with parameters -->
                        <a id="playButton" href="tvplay.php?tv_id=<?= htmlspecialchars($movie['id']) ?>&season=<?= $selectedSeason ?>&episode=<?= $selectedEpisode ?>">
                            <button style="padding: 2% 20%; margin-top:1%; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Play Show</button>
                        </a>
                    </div>
                </div>
            </div>

            <script>
                // Function to store the selected values and update them dynamically
                function storeSelectedValue() {
            let selectedSeason = document.getElementById("season").value; 
            let selectedEpisode = document.getElementById("episode").value;
            let playButton = document.getElementById("playButton");
            let movieId = <?= json_encode($movie['id']); ?>;  // PHP value passed to JavaScript
            console.log(`Selected Season: ${selectedSeason}, Selected Episode: ${selectedEpisode}`);
            // Update the href of the play button
            playButton.href = `tvplay.php?tv_id=${movieId}&season=${selectedSeason}&episode=${selectedEpisode}`;
        }
    


    // Function to navigate back to the stored previous page URL
    document.getElementById('closeModalButton').addEventListener('click', function() {
  
        window.location.href = "index2.php"; // Navigate to the previous page URL
    
});
            </script>
            
           
       
        </div>
    </div>

<?php else : ?>
    <p>No show details available!</p>
<?php endif; ?>
