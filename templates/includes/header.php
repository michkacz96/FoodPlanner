<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Michał Kaczmarczyk - michkacz96@gmail.com">
    <title><?php echo $title; ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/united.min.css">
    <link rel="stylesheet" href="assets/frontpage.css">


    <!-- Favicons -->


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body>

    <nav class="site-header sticky-top py-1">
        <div class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2" href="index.php" aria-label="Product">
                Food Planner
            </a>
            <a class="py-2 d-none d-md-inline-block" href="index.php">Home</a>
            <!--<a class="py-2 d-none d-md-inline-block" href="#">Product</a>
            -->
            <?php
                if(isset($_SESSION['loggedin'])){
                    if($_SESSION['loggedin'] == True){
                        echo '<a class="py-2 d-none d-md-inline-block" href="user-info.php">'.$user->username.' - my info</a>';
                        //echo '<a class="py-2 d-none d-md-inline-block" href="user-meals.php">my meals</a>';
                        echo '<a class="py-2 d-none d-md-inline-block" href="plan-meals.php">plan meals</a>';
                        echo '<a class="py-2 d-none d-md-inline-block" href="logout.php">Logout</a>';
                    }
                } else{
                    echo '<a class="py-2 d-none d-md-inline-block" href="signup.php">Sign up</a>';
                    echo '<a class="py-2 d-none d-md-inline-block" href="signin.php">Sign in</a>';
                }
            ?>
        </div>
    </nav>