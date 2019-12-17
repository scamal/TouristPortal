<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bootstrap Scrollspy 1</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">

</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#section1">Section 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#section2">Section 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#section3">Section 3</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Section 4
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#section41">Link 1</a>
                    <a class="dropdown-item" href="#section42">Link 2</a>
                </div>
            </li>
        </ul>
    </div>
    <?php
    session_start();
    if (!isset($_SESSION['logged'])){
        echo "<div>
        <a href='logIn.php' class='btn btn-primary'>Log in</a>
        
        <a href='signUp.php' class='btn btn-primary'>Sign Up</a>
        
        </div> ";
    }

    ?>
</nav>
<div class="container-fluid">

    <div class="row align-items-center">

        <div class="col-12 title align-middle">
            <h1 class="title-font white-text" style="position: absolute;
right: 0;
bottom: 30%;">BEOGRAD</h1>

        </div>
        <div class="content col-12 row">
        <div class="col-4 p-3 ">
            <div class="w-100 div-style uniform-height p-3 ">
                <p>
                    Ovo je sajt o Beogradu, glavnom i najvećem gradu u Republici Srbiji.
                </p>

                <p>
                    Ovo je sajt o Beogradu, glavnom i najvećem gradu u Republici Srbiji.
                </p>
                <img src="https://scontent.fbeg4-1.fna.fbcdn.net/v/t1.15752-9/79538934_762649307480880_8681411318026076160_n.jpg?_nc_cat=110&_nc_ohc=sEVwMUdjA2QAQmVR-oapfahsUh4Rvrr7GDH5L6NVAwoRIp-0sVlRBEfmw&_nc_ht=scontent.fbeg4-1.fna&oh=0b3dea308ec1a6abb9838261f1c5e345&oe=5E73A4DE"
                     class="img-fluid" >
            </div>
        </div>
            <div class="col-4 p-3 ">
                <div class="w-100 div-style uniform-height p-3 ">

                    <img src="https://scontent.fbeg4-1.fna.fbcdn.net/v/t1.15752-9/79538934_762649307480880_8681411318026076160_n.jpg?_nc_cat=110&_nc_ohc=sEVwMUdjA2QAQmVR-oapfahsUh4Rvrr7GDH5L6NVAwoRIp-0sVlRBEfmw&_nc_ht=scontent.fbeg4-1.fna&oh=0b3dea308ec1a6abb9838261f1c5e345&oe=5E73A4DE"
                         class="img-fluid">
                </div>
            </div>
            <div class="col-4 p-3 ">
                <div class="w-100 div-style uniform-height p-3 ">
                    <p>
                        Ovo je sajt o Beogradu, glavnom i najvećem gradu u Republici Srbiji.
                    </p>
                    <img src="https://scontent.fbeg4-1.fna.fbcdn.net/v/t1.15752-9/79538934_762649307480880_8681411318026076160_n.jpg?_nc_cat=110&_nc_ohc=sEVwMUdjA2QAQmVR-oapfahsUh4Rvrr7GDH5L6NVAwoRIp-0sVlRBEfmw&_nc_ht=scontent.fbeg4-1.fna&oh=0b3dea308ec1a6abb9838261f1c5e345&oe=5E73A4DE"
                         class="img-fluid">
                </div>
            </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>
