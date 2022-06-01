<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if (!isset($_GET['view']) || strlen($_GET['view']) < 1 || !ctype_digit($_GET['view'])) {
    header('Location:./papers-index.php');
    exit();
}

if (isset($_GET['view'])) {
    $id = $db->real_escape_string($_GET['view']);
    $sql = "SELECT * FROM papers WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        $error = 'No data found';
    } else {
        $paper = $res->fetch_object();
    }
}

?>

<div class="col col-lg-12 col-md-12">
    <div class="col col-lg-10">
        <h2>Paper details</h2>
        <hr>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td> Paper code: </td>
                    <td><?php echo $paper->paper_code ?>,</td>
                </tr>
                <tr>
                    <td>Paper name: </td>
                    <td><?php echo $paper->paper_name ?></td>
                </tr>

                <tr>
                    <td>Year: </td>
                    <td><?php echo $paper->year ?></td>
                </tr>

                <tr>
                    <td>Degree: </td>
                    <td><?php echo $paper->degree ?></td>
                </tr>


            </tbody>
        </table>
        <h4>Attachment:</h4>

        <a href="./uploads/papers/<?php echo $paper->paper_image ?>" target="blank">Attachment</a>
    </div>
    <br>

</div>


<?php require_once './footer.php';?>