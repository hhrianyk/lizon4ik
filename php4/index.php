    <form method='post' enctype="multipart/form-data">
        <input type='text' name='v1' value='111111111111111'><br>
        <input type='text' name='v2' value='2222222'><br>
        <input type='text' name='v3' value='333333'><br>
        <input type='file' name="userfile" type="file"><br>
        <input type="submit" value="Відправити"><br>
    </form>

    <?php
    // ini_set('upload_tmp_dir', __DIR__);
    include_once("funcs.php");
    $db = connectToDB($host, $username, $password, $dbname);

    if (!empty($_POST)) {
        $title = mysqli_real_escape_string($db, "Test");
        $sql = "insert into tab1 (title) values ('" . $title . "')";
        query($db, $sql);
        $id = mysqli_insert_id($db);
        foreach ($_POST as $name => $value) {
            $name = mysqli_real_escape_string($db, $name);
            $value = mysqli_real_escape_string($db, $value);
            $sql = "insert into data1 (opros_id, name, value) values ('" . (int)$id . "','" . $name . "','" . $value . "')";
            query($db, $sql);
        }
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $blob =  mysqli_real_escape_string($db, file_get_contents($_FILES['userfile']['tmp_name']));
            $sql = "update tab1 set picture = \"" . $blob . "\" where id ='" . $id . "'";
            query($db, $sql);
        }
    }

    $sql = "select * from tab1 order by id desc";
    $result = $db->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo ($row['title']) . " " . $row['dt'] . "<hr>";
            $sql2 = "select * from data1 where opros_id='" . $row['id'] . "'";
            $result2 = $db->query($sql2);
            if ($result2) {
                while ($row2 = $result2->fetch_assoc()) {
                    echo "<pre>" . print_r($row2, true) . "</pre>";
                }
            }
            echo "<img src='pic.php?id=" . $row['id'] . "'>";
            echo "<hr>";
        }
    }
