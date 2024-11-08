<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Streaming Website</title>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
   
   <style>
    body, html {
        margin: 0;
        padding: 0;
        overflow: hidden;
        background: #000;
        color: white;
        text-transform: uppercase;
        font-weight: 700;
        box-sizing: border-box;
        height: 100vh;
        width: 100vw;
        min-height:50rem;
    }

    #particles-js {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .content {
        position: absolute;
        top: 5vh;
        font-size: 30px;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        color: #fff;
        transition: all 200ms;
    }

    .wrapper {
        text-align: center;
        top: 45vh;
        position: absolute;
        width: 100%;
    }

    button {
        background-color: #FF6347; /* Tomato */
        border: none;
        color: white;
        padding: 15px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px;
        cursor: pointer;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    button:hover {
        background-color: #FF4500; /* Darker Tomato */
        transform: scale(1.1);
    }

    h1 {
        background: linear-gradient(to right, #f32170, #ff6b08, #cf23cf, #eedd44);
        -webkit-text-fill-color: transparent; 
        -webkit-background-clip: text; 
    }

    a{
      color:white !important;
    }
    spline-viewer{
      position:absolute !important;
     
      padding:15% 0 !important;
      
      z-index: -1;
     
    }
  
      [popover] {
  background: black;
  color: white;
  font-weight: 400;
  padding: 1rem;
  border-radius: 1rem;
  max-width: 20%;
  line-height: 1.4;
  top: 2rem;
  margin: 0 auto;
  gap: 1rem;
}
[popover]:popover-open {
  display: flex;
}

.close-btn {
  position: absolute;
  border: none;
  background: none;
  justify-self: end;
  right:4%;
  
  font-size: 1.5rem;
  border-radius: 0.8rem;
  color:black;  
  [aria-hidden] {
    filter: grayscale() brightness(10);
  }
  
  &:hover,
  &:focus {
    background: plum;
    filter: none;
  }
}
/*   IS-OPEN STATE   */
[popover]:popover-open {
  translate: 0 0;
}

/*   EXIT STATE   */
[popover] {
  transition: translate 0.7s ease-out, overlay 0.7s ease-out, display 0.7s ease-out allow-discrete;
  translate: 0 -40rem;
}

/*   0. BEFORE-OPEN STATE   */
@starting-style {
  [popover]:popover-open {
    translate: 0 -22rem;
  }
}
</style>
<script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.28/build/spline-viewer.js" async></script>
</head>
<body >
  <div id="particles-js">
    <div class="content" style="background:-webkit-linear-gradient(#eee,#333);-webkit-text-fill-color:transparent;-webkit-background-clip:text;">
      Movie <br> Streaming <br> Application
    </div>

<spline-viewer url="https://prod.spline.design/FqEJ1lFjGqVSGMaj/scene.splinecode"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAATCAYAAADxlA/3AAAJ+ElEQVR4AQCBAH7/AGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAAIEAfv8AaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawAAgQB+/wBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAACBAH7/AGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAAIEAfv8AaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawAAgQB+/wBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAACBAH7/AGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAAIEAfv8AaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawAAgQB+/wBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAACBAH7/AGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAAIEAfv8AaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawAAgQB+/wBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAACBAH7/AGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAAIEAfv8AaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawAAgQB+/wBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAACBAH7/AGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAAIEAfv8AaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawAAgQB+/wBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAAGBAH7/AGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsAaWVrAGllawBpZWsA5yvnfyErPbMAAAAASUVORK5CYII=" alt="Spline preview" style="width: 100%; height: 100%;"/></spline-viewer>
    <div class="wrapper">
        <h1>Select the Content you might be interested in:</h1>
        <a href="index1.php"><button>Movies</button></a>
        <a href="index2.php"><button>Series</button></a>
    </div>
    <div class="footer" style="display: flex; position: fixed; bottom: 0; width: 100%; justify-content: center; padding: 0.2vh; background-color: rgba(0, 0, 0, 0.9);">
  <button style="background:none; text-transform:uppercase;text-dectoration:underline;" popovertarget="my-popover" class="trigger-btn" style=""> Donate </button>

<div id="my-popover" popover=manual style="height:60vh;width:30vw;">
<img src="https://i.ibb.co/1qMLNdG/Screenshot-2024-10-07-at-6-21-27-PM.png" style="border-radius:1%" height="100%" width="100%" alt="">
  <button class="close-btn" popovertarget="my-popover" popovertargetaction="hide">
    <span aria-hidden="true" style="color:black;">X</span>
    
  </button>
</div>
      

    
</div>


  </div>
  
  <script>
    
    
   
    window.particlesJS('particles-js', {
      particles: {
        number: { value: 200, density: { enable: true, value_area: 800 } },
        color: { value: '#ffffff' },
        shape: {
          type: 'circle',
          stroke: { width: 0, color: '#ffffff' },
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
          color: '#ffffff',
          opacity: 1,
          width: 1,
          condensed_mode: { enable: false, rotateX: 600, rotateY: 600 },
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
    
    
    
    
  </script>
 
</body>
</html>
