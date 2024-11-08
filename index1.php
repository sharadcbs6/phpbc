<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

// Fetch top-rated movies
$response = $client->request('GET', 'https://api.themoviedb.org/3/movie/popular?language=en-US&page=1', [
  'headers' => [
    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiNWM1MmE0OGI4MGI2MTBjZjNlOTkzMzQxOTY0YTA5YSIsIm5iZiI6MTcyNTk5Mjg0Ni4zMDM5Nywic3ViIjoiNjZlMDhlYmFjN2NmMmRkOTlmNWM3ZGYxIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.mHmEZ6DKNIENGtAsJG7XoEhoLU_3C5AdhKfpw1QyBtc',
    'accept' => 'application/json',
  ],
]);

$data = json_decode($response->getBody(), true);
$movies = $data['results'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular Movies</title>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
      *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
body {
           height: 100vh;
           overflow hidden;
           display: flex;
           flex-direction: column;
}

#particles-js {
    /* Make the particles background fixed */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* Ensure the particles are behind the content */
    z-index:-1;
}
        .search-bar {
            margin: 20px 0;
            text-align: center;
}
        .search-bar h1 {
            font-size: 32px;
            color: #333;
}
        .search-bar form {
            margin-top: 15px;
}
        .search-bar input[type="text"] {
            padding: 10px 15px;
            font-size: 18px;
            width: 300px;
            border: 2px solid #007bff;
            border-radius: 25px;
            outline: none;
            transition: all 0.3s ease;
}
        .search-bar input[type="text"]:focus {
            border-color: #0056b3;
}
        .search-bar button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-left: 10px;
}
        .search-bar button:hover {
            background-color: #0056b3;
}
        .movie-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Ensures the grid layout adapts */
            gap: 20px;
            padding: 20px;
            justify-items: center;
            overflow-y: auto;
      }
        .movie-card {
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 200px;
      }
        .movie-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
      }
        .movie-card h3 {
            font-size: 16px;
            margin-top: 10px;
            color: #333;
            text-align: center;
        }
        .movie-card a {
            text-decoration: none;
            color: #333;
      }
        .movie-card a:hover {
            color: #007bff;
    }
    
h1{
  background: linear-gradient(to right,red,slateblue,green,purple);
  -webkit-text-fill-color: transparent;
  -webkit-background-clip: text;
  font-style: cursive !important;
}

</style>

</head>
<body>
<div id="particles-js"></div> <!-- Particle background -->
<div style="position: absolute; top: 10px; right: 10px;">
                <button id="closeModalButton" style="font-size: 24px;  background: none;border: none; cursor: pointer;"onMouseOver="this.style.color='red'" 
       onMouseOut="this.style.color='black'" >&times;</button>
            </div>
    <div class="search-bar">
        <h1>Popular Movies</h1>
        <form method="GET" action="search1.php">
            <input type="text" name="query" placeholder="Search for a movie..." required>
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="movie-grid">
    <?php foreach ($movies as $movie) : ?>
        <div class="movie-card">
            <a href="details1.php?movie_id=<?= htmlspecialchars($movie['id']); ?>">
                <img src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($movie['poster_path']); ?>" alt="<?= htmlspecialchars($movie['title']); ?>">
                <h3><?= htmlspecialchars($movie['title']); ?></h3>
            </a>
        </div>
    <?php endforeach; ?>
    </div>

<script>
    // Store the previous URL using document.referrer


// Function to navigate back to the stored previous page URL
document.getElementById('closeModalButton').addEventListener('click', function() {
    
        window.location.href ="index.php"; // Navigate to the previous page URL
    
});
  window.particlesJS('particles-js', {
    particles: {
      number: { value: 200, density: { enable: true, value_area: 800 } },
      color: { value: '#000000' },
      shape: {
        type: 'circle',
        stroke: { width: 0, color: '#000000' },
        polygon: { nb_sides: 6 },
      },
      opacity: {
        value: 0.5,
        random: true,
        anim: { enable: true, speed: 1, opacity_min: 0.1, sync: false },
      },
      size: {
        value: 4,
        random: true,
        anim: { enable: true, speed: 2, size_min: 0.1, sync: false },
      },
      line_linked: {
        enable_auto: true,
        distance: 100,
        color: '#000000',
        opacity: 1,
        width: 1,
      },
      move: {
        enable: true,
        speed: 4,
        direction: 'none',
        random: true,
        straight: false,
        out_mode: 'out',
        bounce: false,
        attract: { enable: false, rotateX: 600, rotateY: 1200 },
      },
    },
    interactivity: {
      detect_on: 'canvas',
      events: {
        onhover: { enable: true, mode: 'grab' },
        onclick: { enable: true, mode: 'push' },
        resize: true,
      },
      modes: {
        grab: { distance: 200, line_linked: { opacity: 1 } },
        bubble: { distance: 400, size: 40, duration: 2, opacity: 8, speed: 4 },
        repulse: { distance: 200, duration: 0.4 },
        push: { particles_nb: 6 },
        remove: { particles_nb: 2 },
      },
    },
    retina_detect: true,
  });

  const NUMBER_OF_SNOWFLAKES = 300;
const MAX_SNOWFLAKE_SIZE = 5;
const MAX_SNOWFLAKE_SPEED = 2;
const SNOWFLAKE_COLOUR = 'skyblue';
const snowflakes = [];

const canvas = document.createElement('canvas');
canvas.style.position = 'absolute';
canvas.style.pointerEvents = 'none';
canvas.style.top = '0px';
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
document.body.appendChild(canvas);

const ctx = canvas.getContext('2d');


const createSnowflake = () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    radius: Math.floor(Math.random() * MAX_SNOWFLAKE_SIZE) + 1,
    color: SNOWFLAKE_COLOUR,
    speed: Math.random() * MAX_SNOWFLAKE_SPEED + 1,
    sway: Math.random() - 0.5 // next
});

const drawSnowflake = snowflake => {
    ctx.beginPath();
    ctx.arc(snowflake.x, snowflake.y, snowflake.radius, 0, Math.PI * 2);
    ctx.fillStyle = snowflake.color;
    ctx.fill();
    ctx.closePath();
}

const updateSnowflake = snowflake => {
    snowflake.y += snowflake.speed;
    snowflake.x += snowflake.sway; // next
    if (snowflake.y > canvas.height) {
        Object.assign(snowflake, createSnowflake());
    }
}

const animate = () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    snowflakes.forEach(snowflake => {
        updateSnowflake(snowflake);
        drawSnowflake(snowflake);
    });

    requestAnimationFrame(animate);
}

for (let i = 0; i < NUMBER_OF_SNOWFLAKES; i++) {
    snowflakes.push(createSnowflake());
}

window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
});

window.addEventListener('scroll', () => {
    canvas.style.top = `${window.scrollY}px`;
});

// setInterval(animate, 15);
animate()
</script>

</body>
</html>
