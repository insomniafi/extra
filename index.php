<?php



function readData($name){
    $file = __DIR__.'/datastore/'.$name.'.json';

    if(file_exists($file)){
        try {
            return json_decode(file_get_contents($file), true);
        } catch (\Error $e) {

        }
    }

    return [];
}

if (!function_exists('str_contains')) {
    function str_contains (string $haystack, string $needle)
    {
        return empty($needle) || strpos($haystack, $needle) !== false;
    }
}

if(isset($_GET['date']) && $_GET['date'] != ''){
    $date = $_GET['date'];
} else {
    $date = date('d.m.Y');
}

?>
<!DOCTYPE html>
<html lang="fi">
    <head>
        <title>Insomnia XXII - Extra</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <style>
            * {
                box-sizing: border-box;
            }

            @font-face {
                font-family: "Roboto Medium";
                src: url('./assets/fonts/Roboto-Medium.ttf');
            }

            @font-face {
                font-family: "Bebas Neue Regular";
                src: url('./assets/fonts/BebasNeue-Regular.ttf');
            }

            @font-face {
                font-family: "Orbitron Black";
                src: url('./assets/fonts/Orbitron-Black.otf');
            }

            body {
                background-image: linear-gradient(to bottom, #040200, #380672);
                margin: 0;
                display: flex;
                flex-direction: column;
            }

            header, nav, main, section, article, footer {
                display: flex;
                align-items: center;
                justify-content: center;
                padding-top: 5vh;
                flex-direction: column;
                width: 100%;
                text-align: center;
            }

            main {
                display: grid;
                grid-template-rows: auto;
                grid-template-columns: 1fr 1fr;
                align-items: flex-start;
            }

            section {
                width: 100%;
            }

            section:first-child(){
                padding-top: 0;
            }

            main header {
                padding: 0;
            }

            *, *:active, *:focus, *:hover, *:visited, *:link {
                color: #ffffff;
                font-family: "Roboto Medium", sans-serif;
                text-decoration: none;
            }


            h1 {
                display: none;
            }

            h2, h2:active, h2:focus, h2:hover, h2:visited, h2:link {
                font-family: "Orbitron Black", sans-serif;
                font-size: 2.5em;
                text-align: center;
            }

            .logo {
                max-width: 75vw;
            }

            nav ul, main section ul {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                text-align: center;
            }

            nav ul li:first-child, main section ul li:first-child {
                margin-left: 0vmin;
            }

            nav ul li, main section ul li {
                margin-left: 5vmin;
            }

            main section ul li a {
                display: flex;
                align-items: center;
            }

            main section ul li a span {
                margin-left: 1vmin;
                font-size: 2em;
            }

            section#schedule article, section#tournaments article {
                padding: 2.5vh;
            }

            section#schedule article:hover, section#tournaments article:hover {
                background-color: #ffffff11;
            }

            section#schedule article h3, section#tournaments article h3 {
                font-size: 1.5em;
                margin-bottom: 0;
            }

            section#schedule article .area {
                margin-top: 0;
            }

            section#schedule article .time, section#tournaments article .time {
                font-size: 1.5em;
            }

            section#schedule article a, section#tournaments article a {
                font-size: 1.25em;
            }

            .top {
                font-size: 1.5em;
                margin-top: 5vmin;
            }

            nav ul li a, nav ul li a:active, nav ul li a:focus, nav ul li a:hover, nav ul li a:visited, nav ul li a:link {
                font-family: "Bebas Neue Regular", sans-serif;
                font-size: 3em;
            }

            ul {
                list-style-type: none;
                padding: 0;
            }

            footer {
                font-size: 1.5em;
                text-align: center;
            }

            .wg-logo {
                background-image: url(https://cdn.waren.io/logos/warengroup/logo-light.svg);
                background-repeat: no-repeat;
                background-position: center;
                background-size: contain;
                color: transparent;
            }

            .area[x-extra-area="Insomnia XXII"] {
                color: #fff
            }

            @media (orientation: portrait) {
                nav ul {
                    flex-direction: column;
                }

                nav ul li {
                    margin-left: 0vmin;
                }

                main {
                    display: flex;
                    align-items: center;
                }

                section#info ul {
                    flex-direction: column;
                }

                section#info ul li {
                    margin-top: 5vmin;
                }

                section#info ul li:first-child() {
                    margin-top: 0vmin;
                }
            }
        </style>

        <!-- Link: Preconnect & DNS Prefetch & Preload -->
        <link rel="preconnect" href="//cdn.waren.io">
        <link rel="dns-prefetch" href="//cdn.waren.io">
        <link rel="preload" as="font" type="font/woff2" href="https://cdn.waren.io/frameworks/font-awesome/7.1.0/webfonts/fa-solid-900.woff2" crossorigin="anonymous">
        <link rel="preload" as="style" href="https://cdn.waren.io/frameworks/font-awesome/7.1.0/css/all.min.css" crossorigin="anonymous">

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.waren.io/frameworks/font-awesome/7.1.0/css/all.min.css" crossorigin="anonymous" media="screen, print">

    </head>
    <body>
            <header id="header">
                <h1>Insomnia XXII</h1>
                <img class="logo" title="Insomnia XXII" alt="Insomnia XXII" src="./assets/images/logo.svg">
            </header>
            <nav id="menu">
                <ul>
                    <li><a href="#schedule"><i class="fa-regular fa-clock"></i> Aikataulu</a></li>
                    <!--<li><a href="#map"><i class="fa-solid fa-map"></i> Kartta</a></li>-->
                    <!--<li><a href="#streams"><i class="fa-solid fa-circle-play"></i> Striimit</a></li>-->
                    <li><a href="#tournaments"><i class="fa-solid fa-trophy"></i> Turnaukset</a></li>
                    <li><a href="#info"><i class="fa-solid fa-circle-info"></i> Info</a></li>
                </ul>
            </nav>
            <main id="content">

                <section id="schedule">
                    <header>
                        <h2><i class="fa-regular fa-clock fa-2x"></i> Aikataulu</h2>
                    </header>

                    <?php

                        $schedule = readData("schedule");

                        foreach($schedule as $program){
                            $time = http_build_query($program['time'],'',', ');

                            if(str_contains($time, $date) || $_GET['all'] == '1'){
echo '
<article>
    <header>
        <h3>'.$program['title'].(isset($program['partner']['name']) && $program['partner']['name'] != '' && $program['title'] != $program['partner']['name'] ? ' by '.$program['partner']['name'] : "").'</h3>
        <p class="area" x-extra-area="'.$program['area'].'">'.$program['area'].'</p>
        <p>
';

                                foreach($program['time'] as $startTime => $endTime){
                                    $startTime = explode(" ", $startTime);
                                    $endTime = explode(" ", $endTime);

                                    if($startTime[0] == $date || $endTime[0] == $date || $_GET['all'] == '1'){
                                        if($startTime[0] != $endTime[0]){
                                            echo implode(" ", $startTime).' - '.implode(" ", $endTime).'<br>';
                                        } else {
                                            if(isset($startTime[2]) && isset($endTime[2])){
                                                if($_GET['all'] == '1'){
                                                    echo $startTime[0].' klo '.$startTime[2].' - '.$endTime[2].'<br>';
                                                } else {
                                                    echo '<span class="time">'.$startTime[2].' - '.$endTime[2].'</span>'.'<br>';
                                                }
                                            } else {
                                                echo $startTime[0].'<br>';
                                            }
                                        }
                                    }
                                }

echo '
        </p>
    </header>
</article>
';
                            }
                        }

                    ?>

                    <a href="./?all=1#schedule" class="show-all"><i class="fa-solid fa-list-check"></i> N&auml;yt&auml; kaikki</a>
                    <p class="disclamer"><i class="fa-solid fa-triangle-exclamation"></i> Varaamme oikeudet muutoksiin</p>

                    <a href="#header" class="top"><i class="fa-solid fa-caret-up"></i> Siirry yl&ouml;s</a>
                </section>

                <!--<section id="map">
                    <header>
                        <h2><i class="fa-solid fa-map fa-2x"></i> Kartta</h2>
                    </header>

                    <a href="#header" class="top"><i class="fa-solid fa-caret-up"></i> Siirry yl&ouml;s</a>
                </section>-->

                <!--<section id="streams">
                    <header>
                        <h2><i class="fa-solid fa-circle-play fa-2x"></i> Striimit</h2>
                    </header>

                    <ul>
                        <li><a href="https://www.youtube.com/channel/UC2qYgQZALCwIM5G0mNMm5xg"><i class="fa-brands fa-youtube fa-5x"></i></a></li>

                        <li><a href="https://twitch.tv/insomniafi"><i class="fa-brands fa-twitch fa-5x"></i></a> </li>
                    </ul>

                    <a href="#header" class="top"><i class="fa-solid fa-caret-up"></i> Siirry yl&ouml;s</a>
                </section>-->


                <section id="tournaments">
                    <header>
                        <h2><i class="fa-solid fa-trophy fa-2x"></i> Turnaukset</h2>
                    </header>

                    <?php

                        $tournaments = readData("tournaments");

                        foreach($tournaments as $tournament){
                            $time = http_build_query($tournament['time'],'',', ');

                            if(str_contains($time, $date) || $_GET['all'] == '1'){
echo '
<article>
    <header>
        <h3>'.$tournament['title'].(isset($tournament['partner']['name']) && $tournament['partner']['name'] != '' ? ' by '.$tournament['partner']['name'] : "").'</h3>
        <p>
';

            foreach($tournament['time'] as $startTime => $endTime){
                $startTime = explode(" ", $startTime);
                $endTime = explode(" ", $endTime);

                if($startTime[0] == $date || $endTime[0] == $date || $_GET['all'] == '1'){
                    if($startTime[0] != $endTime[0]){
                        echo implode(" ", $startTime).' - '.implode(" ", $endTime).'<br>';
                    } else {
                        if(isset($startTime[2]) && isset($endTime[2])){
                            if($_GET['all'] == '1'){
                                echo $startTime[0].' klo '.$startTime[2].' - '.$endTime[2].'<br>';
                            } else {
                                echo '<span class="time">'.$startTime[2].' - '.$endTime[2].'</span>'.'<br>';
                            }
                        } else {
                            echo $startTime[0].'<br>';
                        }
                    }
                }
            }

echo '
        </p>
    </header>

    <a href="'.$tournament['link'].'"><i class="fa-solid fa-circle-info"></i> Lis&auml;tietoa turnauksesta</a>
</article>
';
                            }
                        }

                    ?>

                    <a href="./?all=1#tournaments" class="show-all"><i class="fa-solid fa-list-check"></i> N&auml;yt&auml; kaikki</a>
                    <p class="disclamer"><i class="fa-solid fa-triangle-exclamation"></i> Varaamme oikeudet muutoksiin</p>

                    <a href="#header" class="top"><i class="fa-solid fa-caret-up"></i> Siirry yl&ouml;s</a>
                </section>

                <section id="info">
                    <header>
                        <h2><i class="fa-solid fa-circle-info fa-2x"></i> Info</h2>
                    </header>

                    <ul>
                        <li><a href="https://discord.gg/4fy7uprb85"><i class="fa-brands fa-discord fa-3x"></i> <span>#apua</span></a></li>
                        <li><a href="mailto:infoxxii@insomnia.fi"><i class="fa-solid fa-at fa-3x"></i> <span>infoxxii@insomnia.fi</span></a></li>
                        <!--<li style="<?php if(date('H') >= 1 && date('H') <= 8){ echo "opacity: 50%;"; print_r(date('H'));} ?>"><a href="tel:+358931574170"><i class="fa-solid fa-phone fa-3x"></i> <span title="+358 9 31574170 (9:00 - 1:00)">+358 9 31574170</span></a></li>-->
                    </ul>

                    <a href="#header" class="top"><i class="fa-solid fa-caret-up"></i> Siirry yl&ouml;s</a>
                </section>

                <section id="socials">
                    <header>
                        <h2>Seuraa meitä somessa</h2>
                    </header>

                    <ul>
                        <li><a href="https://instagram.com/insomnia.fi"><i class="fa-brands fa-instagram fa-5x"></i></a></li>

                        <li><a href="https://tiktok.com/@insomniafi"><i class="fa-brands fa-tiktok fa-5x"></i></a></li>

                        <li><a href="https://twitter.com/insomnia.fi"><i class="fa-brands fa-twitter fa-5x"></i></a></li>
                    </ul>

                    <a href="#header" class="top"><i class="fa-solid fa-caret-up"></i> Siirry yl&ouml;s</a>
                </section>
            </main>
            <footer id="footer">
                <p class="powered-by">
                    Sivun on toteuttanut<br>
                    <a href="https://waren.io" class="wg-logo">War&eacute;n Group</a>
                </p>
            </footer>
    </body>
</html>
