<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo SITENAME;?></title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <!-- <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script> -->
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        
        <!-- <link href="./css/styles.css" rel="stylesheet" /> -->
</head>
    <style><?php include_once("./css/blog_styles.css")?></style>
    <body>
    
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="<?php echo URLROOT;?>/public/"><?php echo SITENAME;?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo URLROOT;?>/public/">Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo URLROOT;?>/public/pages/about">About</a></li>
                        <!-- <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="post.php">Sample Post</a></li> -->
                        <?php
                        if (isset($_SESSION['user'])) {
                                echo '<li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="'.URLROOT.'/public/BlogController/newPost/">New Post</a></li>';
                        } else {
                                echo '<li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="'.URLROOT.'/public/pages/login/">Login/Signup</a></li>';
                        }
                        ?>
                        
                    </ul>
                </div>
            </div>
        </nav>