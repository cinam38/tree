<?php
// Initialize the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us | Help Trees</title>
    <link rel="stylesheet" href="styles.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,900&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background-color: #f3f3df;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        li {
            list-style: none;
            text-decoration: none;
        }

        .page-title h1 {
            text-align: center;
            font-weight: 800;
            margin-bottom: 30px;
        }

        .navbar-toggler {
            background-color: #000;
        }

        .navbar-brand img {
            width: 80px;
            height: auto;
        }

        .bg-light {
            background-color: #faf9e7 !important;
            height: 100px;
            box-shadow: 0px -1px 5px 0px;
            margin-bottom: 50px;
            z-index: 999;
        }

        .navbar-light .navbar-nav .nav-link {
            color: rgba(0, 0, 0, .55);
            border-radius: 50px;
        }

        .navbar-expand-lg .navbar-nav .nav-link {
            padding: 8px 30px;
        }

        .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .show > .nav-link {
            color: rgba(0, 0, 0, .9);
            background-color: #08bf01bc;
            border-radius: 50px;
        }

        .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
            color: rgba(0, 0, 0, .7);
            background-color: #00da2cdf;
        }

        .d-flex a i {
            background-color: #497a43;
            width: 40px;
            height: 40px;
            text-align: center;
            color: #fff;
            border-radius: 50%;
            font-size: 20px;
            padding: 10px;
            font-weight: 600;
        }

        .intro {
            max-width: 800px;
            margin: 30px auto;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            background-color: #1a1e33;
        }

        .intro p {
            color: #d0d1d8;
            font-size: 1.1em;
            line-height: 1.6;
        }

        .container-items {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            margin: 50px auto;
            max-width: 1200px;
        }

        .item {
            text-align: center;
            max-width: 250px;
        }

        .circle {
            width: 40px;
            height: 40px;
            background-color: #3b4661;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 10px auto;
            font-size: 1.5em;
            color: white;
        }

        h3 {
            margin: 10px 0;
            font-size: 1.2em;
            color: #2b2b2b;
        }

        p {
            font-size: 0.9em;
            color: #2b2b2b;
        }
    </style>
</head>
<body>
    <!-- Header Start -->
    <div id="header"></div>
    <!-- Header End -->

    <!-- Main Content Start -->
    <main>
        <section class="about-us">
            <div class="container">
                <div class="page-title">
                    <h1>About Us</h1>
                </div>
                <div class="intro">
                    <p>
                        This site aims to reduce the phenomenon of desertification and encourage the community to develop a culture of agriculture and afforestation, by encouraging them to plant to preserve the environment.
                    </p>
                </div>
                <div class="container-items">
                    <div class="item">
                        <div class="circle">1</div>
                        <h3>Reduce Desertification</h3>
                        <p>
                            Implementing strategies to prevent and reverse desertification by promoting sustainable land management practices.
                        </p>
                    </div>
                    <div class="item">
                        <div class="circle">2</div>
                        <h3>Encourage Agriculture</h3>
                        <p>
                            Foster a culture of agriculture by providing resources and education on sustainable farming and afforestation.
                        </p>
                    </div>
                    <div class="item">
                        <div class="circle">3</div>
                        <h3>Community Engagement</h3>
                        <p>
                            Engage the community in environmental preservation efforts through tree planting and environmental awareness campaigns.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Main Content End -->

    <!-- Footer Start -->
    <div id="footer"></div>
    <!-- Footer End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="header_footer.js"></script>
</body>
</html>
