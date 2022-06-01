<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if (isset($_GET['edit'])) {
    $id = $db->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM papers WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        header('Location: ./papers-index');exit;
    } else {
        $paper = $res->fetch_object();
    }
    //print_r($paper);die;
}

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['paper-code']) < 1) {
        $error = "please enter paper code";
    } else if (strlen($_POST['paper-name']) < 1) {
        $error = "please enter paper name";
    } else if (strlen($_POST['year']) < 1) {
        $error = "please enter year";
    } else if (strlen($_POST['degree']) < 1) {
        $error = "please enter degree";
    } else {
        $papercode = $db->real_escape_string($_POST['paper-code']);
        $papername = $db->real_escape_string($_POST['paper-name']);
        $year = $db->real_escape_string($_POST['year']);
        $degree = $db->real_escape_string($_POST['degree']);
        $id = $db->real_escape_string($_POST['id']);

        $maxFileSize = 100 * 1024; // 100KB
        $minFileSize = 10 * 1024; // 20KB

        //$username = $_SESSION['user'];

        $allwoedExts = ['jpg', 'jpeg', 'png', 'doc', 'docx', 'pdf'];
        if ($_FILES['image-file']['error'] == 4) {
            $error = 'Plaese select scanned paper image file';
        } else if (!in_array(strtolower(pathinfo($_FILES['image-file']['name'], PATHINFO_EXTENSION)), $allwoedExts)) {
            $error = 'Inavlid file format, (jpg, jpeg, png or doc, pdf are allowed only ';
        } else if ($_FILES['image-file']['size'] > $maxFileSize) {
            $error = 'Image size is too large';
        } else if ($_FILES['image-file']['size'] < $minFileSize) {
            $error = 'Image size is too small';
        } else {
            $fileName = md5(time());
            $fileExt = pathinfo($_FILES['image-file']['name'], PATHINFO_EXTENSION);
            $fullFileName = $fileName . '.' . $fileExt;
            $dir = './uploads/papers/';
            $fullFilePath = $dir . $fullFileName;
            $sql = "UPDATE papers
            SET paper_code = '$papercode', paper_name = '$papername', year = '$year' , degree =  '$degree', paper_image = '$fullFileName'

            WHERE id = '$id'";
            if ($db->query($sql) === true && move_uploaded_file($_FILES['image-file']['tmp_name'], $fullFilePath)) {
                $msg = "Paper updated successfully";
            } else {
                $error = "Failed to add paper, Please check your details and try again";
            }
        }
    }
}

?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Edit Paper</strong></a>
    <hr>


</div>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-left: 100px">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($error) && strlen($error) > 1): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                    <?php endif?>

                    <?php if (isset($msg) && strlen($msg) > 1): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $msg; ?>
                    </div>
                    <?php endif?>

                    <?php if (isset($_SESSION['error']) && strlen($_SESSION['error']) > 1): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['error'];
unset($_SESSION['error']) ?>
                    </div>
                    <?php endif?>

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $paper->id ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Paper code</label>
                            <input type="text" name="paper-code" class="form-control" id="exampleInputEmail1"
                                value="<?php echo $paper->paper_code ?>" aria-describedby="emailHelp"
                                placeholder="Enter papercode">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Paper name</label>
                            <input type="text" name="paper-name" value="<?php echo $paper->paper_name ?>"
                                class="form-control" id="exampleInputPassword1" placeholder="enter paper name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Year</label>
                            <input type="text" name="year" value="<?php echo $paper->year ?>" class="form-control"
                                id="exampleInputPassword1" placeholder="enter year">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Degree</label>
                            <input type="text" name="degree" value="<?php echo $paper->degree ?>" class="form-control"
                                id="exampleInputPassword1" placeholder="enter Address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Scanned paper</label>
                            <input type="file" name="image-file" class="form-control" id="exampleInputPassword1"
                                placeholder="enter Address">
                        </div>

                        <div class="form-group" style="float: right">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a href="./page.php"><button type="button" class="btn btn-primary">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once './footer.php';?>