<?php //include './layouts/header.php';
require_once './admin/src/database.php';

//search
if (isset($_POST['search'])) {
    $searchvalue = $_POST['search'];
    $searchvalue = trim($searchvalue);
    $sql = "SELECT * FROM papers WHERE status = '0' AND(paper_code LIKE '%$searchvalue%' OR paper_name LIKE
    '%$searchvalue%' OR year LIKE '%$searchvalue%' OR degree LIKE '%$searchvalue%')";

    $res = $db->query($sql);

    while ($row = $res->fetch_object()) {
        $papers[] = $row;
    }
} else {

    $sql = "SELECT * FROM papers WHERE status = '0' ORDER BY id desc";
    $res = $db->query($sql);
    $papers = [];
    while ($row = $res->fetch_object()) {
        $papers[] = $row;
    }
}

//print_r($papers);die;

if (!empty($_GET['file'])) {

    $filename = basename($_GET['file']);
    $filepath = './admin/uploads/papers/' . $filename;
    if (!empty($filename) && file_exists($filepath)) {
        header('Content-Type: application/pdf');
        header('Content-type: application/octet-stream');
        header("Cache-control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");

        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        readfile($filepath);
        exit;
    } else {
        echo '  File doesnot exist';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Question Bank Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./res/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="./res/css/font-awesome.css">
    <link rel="stylesheet" href="./res/css/style.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>-->
    <script src="./res/js/jquery.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark" style="color:blue">
        <a class="navbar-brand" href="#" style="color:white;background-color:blue">Question Bank Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link t" href="./index.php" style="color:white; background-color:blue">Home <span class="sr-only">(current)</span></a>
                </li>


            </ul>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit" style="background-color:blue">
                    Search
                </button>
            </form>
        </div>
    </nav>

    <!-- Products -->

    <div class="container">
        <div class="row mt-5">
            <?php foreach ($papers as $paper) : ?>
                <div class="col-lg-4 my-2">
                    <div class="card">
                        <img src="./res/img/image1.jpeg" class="card-img-top" alt="..." />
                        <div class="card-body">
                            <h5 class="card-title">Papercode :<?php echo $paper->paper_code ?></h5>
                            <p class="card-text">Papername : <?php echo $paper->paper_name ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo $_SERVER['PHP_SELF'] ?>?file=<?php echo $paper->paper_image ?>" class="btn btn-sm btn-success float-right mx-2">
                                <i class="fa fa-download"></i> Download
                            </a>
                            <a href="./admin/uploads/papers/<?php echo $paper->paper_image ?>" class="btn btn-sm btn-success float-right" target="blank">
                                <i class="fa fa-download"></i> View
                            </a>
                            <div class="price-wrap h6">
                                <span class="price-new">Year :<?php echo $paper->year ?></span>
                                <span class="price-old mt-2">Degree
                                    :<?php echo $paper->degree ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
    <footer style="background-color:blue; ">
        <div class="row">
            <div class="col-lg-4 offset-lg-3">
                <ul class="py-5" style="list-style: none; float:right">
                    <li>
                        <a href="#" class="text-white">
                            <i class="fa fa-arrow-right"></i> About us
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white">
                            <i class="fa fa-arrow-right"></i> Privacy policy
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white">
                            <i class="fa fa-arrow-right"></i> Terms and condition
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-white" style="list-style: none;">
                            <i class="fa fa-arrow-right"></i> Faq
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 my-5">
                <a href="#"> <i class="fa fa-facebook-square"></i></a>
            </div>
        </div>
    </footer>
</body>

</html>