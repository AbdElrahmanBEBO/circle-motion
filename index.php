<?php
    $ball_radius = 250;
    $point_radius = 5;
    $no_of_points = 6;
    $speed = 2000;
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
        </style>
    </head>
    <body>
        <div id="root"></div>
        <div class="bebo">BEBO</div>
        
        <script>
            let root = document.getElementById('root');

            for (let i = 0; i < <?= $no_of_points ?>; i++) 
                root.innerHTML += '<div class="point"></div>';

            let points = document.getElementsByClassName('point');
            
            const BALL_RADIUS = <?= $ball_radius ?>;
            const POINT_RADIUS = <?= $point_radius ?>;
            
            let x = -1 * (BALL_RADIUS+POINT_RADIUS)
            let y = 0;

            for (let i = 0; i < points.length; i++) {
                points[i].style.left = `calc((100vw/2) + ${x}px)`;
                points[i].style.top = `calc((100vh/2) + ${y}px)`;

                movePoint(points[i], x, y, i*100)
                
                x += (BALL_RADIUS*2)/(points.length)
                y = Math.sqrt(Math.pow(BALL_RADIUS, 2) - Math.pow(x+POINT_RADIUS, 2)) - POINT_RADIUS;
            }

            function movePoint(p, x, y, interval) {
                let curX = x, curY = y;
                setInterval(() => {                    
                    curX = curX == -x-(POINT_RADIUS*2) ? x : -x-(POINT_RADIUS*2)
                    curY = -curY-(POINT_RADIUS*2);

                    p.style.left = `calc((100vw/2) + ${curX}px)`;
                    p.style.top = `calc((100vh/2) + ${curY}px)`;
                }, <?= $speed ?> + interval)

            }
        </script>
    </body>
</html>