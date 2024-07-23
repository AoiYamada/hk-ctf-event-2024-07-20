<?php
    require_once dirname(__FILE__).'/include/user.php';
    require_once dirname(__FILE__).'/include/Slimdown.php';



    if(!hasLogin()){
        echo 'Please login';
        header("Location: login.php");
        exit();
    }

    if( isset($_POST['action']) && $_POST['action'] == 'POST' ){
        changeNote($USERNAME, $_POST['note']);
        header("Location: edit.php");
        exit();
    }else{
        $note = getNote($USERNAME);
        $markedNote = Slimdown::render ($note);
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>MarkNote</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <script src="statics/jquery.min.js"></script>
    <script src="statics/marked.min.js"></script>
    <script src="statics/ace.js"></script>
    <!-- <script src="//cdn.bootcss.com/prism/0.0.1/prism.min.js"></script> -->
    <!-- <script src="//cdn.bootcss.com/mathjax/2.5.3/MathJax.js"></script> -->
    <script src="statics/MathJax.js"></script>
    <script src="statics/Sortable.min.js"></script>
    <script src="include/js/edit.js"></script>
    <script src="include/js/prism.js"></script>
    <script language="javascript">
        function edit() {
            var note_area = document.getElementById("note-area");
            note_area.style.display = "none";
            var button = document.getElementById("notebutton");
            button.style.display = "none";
            var edit_area = document.getElementById("edit-area");
            edit_area.style.display = "block";
        }
    </script>

    <link href="statics/font-awesome.css" rel="stylesheet">
    <link href="statics/octicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="include/css/edit.css">
    <link rel="stylesheet" type="text/css" href="include/css/prism.css">
    <style>
        #note-area {
            border-style: double;
        }
    </style>

</head>

<body>

    <div id="header">
        <h1 id="header-title">MarkNote</h1>
        <div id="header-user">
            <div id="header-user-head">
                <i class="fa fa-user fa-2x" aria-hiddem="true" style="margin: 7px 0px 0px 5px;"></i>
            </div>
            <span id="header-user-name"><?php echo $USERNAME; ?>| <a style="cursor: pointer;"
                    onclick="$('#header-user-logoutform').submit();">logout</a></span>
            <form id="header-user-logoutform" method="post" action="login.php">
                <input type="hidden" name="type" value="logout">
            </form>

        </div>
    </div>


    <div id="content">
        <h2>this is your note</h2>
        <button type="submit" id='notebutton' class="btn btn-default" onclick="edit()">edit</button>
        <div id="note-area">

            <?php echo $markedNote; ?>
        </div>
        <div id="edit-area" style="display:none">
            <form method="POST" action="edit.php" id="usrform">
                <input type="hidden" name="action" value="POST">
                <button type="submit" class="btn btn-default">save</button>
            </form>
            <br>
            <textarea rows="10" cols="20" name="note" form="usrform"><?php echo $note; ?></textarea>
        </div>

    </div>
</body>

</html>