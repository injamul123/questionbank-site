<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

/* Delete paper */
if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM papers WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM papers";
$res = $db->query($sql);
$papers = [];
while ($row = $res->fetch_object()) {
    $papers[] = $row;
}

if (isset($_GET['disable'])) {
    $id = $_GET['disable'];
    $sql = "UPDATE papers SET status = '1' WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res) {
        echo 'disabled';
    }
}

if (isset($_GET['enable'])) {
    $id = $_GET['enable'];
    $sql = "UPDATE papers SET status = '0' WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res) {
        echo 'enabled';
    }
}
?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Papers</strong></a>
    <hr>
    <a href="add-paper.php"><button class="btn btn-primary" type="button">Add New Paper</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>Paper Code</th>
            <th>Paper name</th>
            <th>Created-at</th>

            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 0;foreach ($papers as $paper): ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $paper->paper_code ?></td>
                <td><?php echo $paper->paper_name ?></td>
                <td><?php echo $paper->created_at ?></td>

                <td>
                    <a href="./paper-view.php?view=<?php echo $paper->id ?>" class="btn btn-success">View</a>

                    <a href="./paper-edit.php?edit=<?php echo $paper->id ?>" class="btn btn-info">Edit</a>
                    <a onclick='return confirm("Are you sure?")'
                        href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $paper->id ?>"
                        class="btn btn-danger">Delete</a>

                    <?php if ($paper->status == 0): ?>
                    <a onclick="return confirm('Are you sure to disable the Paper ?')" class="fa fa-check"
                        href="?disable=<?php echo $paper->id ?>">Enable</a>
                    <?php else: ?>
                    <a onclick="return confirm('Are you sure to enable the Paper ?')" class="fa fa-ban"
                        href="?enable=<?php echo $paper->id; ?>">Disable</a>
                    <?php endif;?>

                </td>
            </tr>
            <?php $i++;endforeach?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php';?>