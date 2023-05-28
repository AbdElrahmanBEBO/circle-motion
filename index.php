<?php
    $ball_radius = 300; 
    $point_radius = !empty($_GET['point_radius']) ? $_GET['point_radius'] : 10;
    $no_of_points = !empty($_GET['no_of_points']) ? $_GET['no_of_points'] : 10;
    $speed = !empty($_GET['speed']) ? $_GET['speed'] : 2000;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                display: flex; justify-content: center; align-items: center;
                width: auto; height: 100vh;
                padding: 0px; margin: 0px;
                overflow: hidden;
            }
            #root{
                display: flex;
                justify-content: center; align-items: center;
                width: <?= $ball_radius*2 ?>px; height: <?= $ball_radius*2 ?>px;
                border: 1px solid black; border-radius: 50%;
            }
            .point{
                display: flex;
                justify-content: center; align-items: center;
                background: black;
                width: <?= $point_radius*2 ?>px; height: <?= $point_radius*2 ?>px;
                border-radius: 50%;
                position: absolute;
                transition: all <?= $speed ?>ms;
                transition-timing-function: linear;
            }
            .bebo{
                display: flex;
                justify-content: center;
                align-items: center;
                position: absolute;
                font-size: 50px;
                width: 50px; height: 20px;
                top: calc(100vh/6);  left: calc(100vw/2 - 25px);
                z-index: -1;
            }
            .form{
                position: absolute;
                display: flex;
                flex-direction: column;
                left: 100px; top: calc(100vh/2 - 50px);
            }
            
        </style>
    </head>
    <body>
        <div id="root"></div>
        
        <div class="bebo">BEBO</div>

        <form class="form"  method="GET">
            <input type="number" placeholder="point radius" name="point_radius">
            <input type="number" placeholder="number of points" name="no_of_points">
            <input type="number" placeholder="speed" name="speed">
            <button>change</button>
        </form>
        
        <script>
            const BALL_RADIUS = <?= $ball_radius ?>;
            const POINT_RADIUS = <?= $point_radius ?>;
            
            let root = document.getElementById('root');

            for (let i = 0; i < <?= $no_of_points ?>; i++) 
                root.innerHTML += '<div class="point"></div>';

            let points = document.getElementsByClassName('point');
            
            
            let x = -1 * (BALL_RADIUS+POINT_RADIUS), y = 0, Ps = [];

            for (let i = 0; i < points.length; i++) {
                Ps.push([points[i], x, y])
                
                points[i].style.left = `calc((100vw/2) + ${x}px)`;
                points[i].style.top = `calc((100vh/2) + ${y}px)`;
                       
                x += (BALL_RADIUS*2)/(points.length)
                y = Math.sqrt(Math.pow(BALL_RADIUS, 2) - Math.pow(x+POINT_RADIUS, 2)) - POINT_RADIUS;
            }

            for (let i = 0; i < Ps.length; i++) 
                setTimeout(() => movePoint(Ps[i]), i*220)


            function movePoint([p, x, y]) {
                let flag = 0;

                let Ps = [
                    {x: -x-(POINT_RADIUS*2), y: -y-(POINT_RADIUS*2)},
                    {x: x,y: y}
                ]

                setInterval(() => {
                    p.style.left = `calc((100vw/2) + ${Ps[flag].x}px)`;
                    p.style.top = `calc((100vh/2) + ${Ps[flag].y}px)`;
                    flag = flag == 1 ? 0 : 1;
                }, <?= $speed ?>)
            }
        </script>
    </body>
</html>