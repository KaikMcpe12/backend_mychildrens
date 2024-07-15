<?php
    require_once './controller/read_reddit_controller.php';
    require_once './controller/seach_tag_controller.php';
    require_once './controller/comment_reddit_controller.php';

    session_start();
    $_SESSION['id_user'] = 648;

    ###############PÁGINA#################
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $tag = isset($_GET['tag']) ? $_GET['tag'] : '';
    }else{
        $page = 1;
        header("Location: index.php?page=$page&tag=$tag");
    };

    #######Redireciona com tag#######
    if(isset($_GET['btn_tag'])) {
        $tag = $_GET['tag'];
        header("Location: index.php?page=$page&tag=$tag");
    };
    
    ###########PESQUISA TAG OU GERAL#######
    if(isset($_GET['tag'])){
        $result = seach_tag_controller($tag,  $page);
        $total_page = get_all_page($tag);
    }else{
        $result = refresh($page);
        $total_page = get_all_page();
    };
    
    ##############PRÓXIMO E ANTERIOR##########
    if(isset($_POST['next']) and $page < $total_page){
        $page += 1;
        header("Location: index.php?page=$page&tag=$tag");
    }else if(isset($_POST['previous']) and $page > 1){
        $page -= 1;
        header("Location: index.php?page=$page&tag=$tag");
    };

    ##############LISTA DE TAGS#########################
    $list_tag = list_tag();

    ################COMENTÁRIOS#########################
    if(isset($_POST['btn_comment'])){
        $_SESSION['id_reddit'] = $_POST['btn_comment'];
        header("Location: comment.php");
    };
    ################CURTIDAS#########################
    if(isset($_POST['btn_like'])){
        $_SESSION['like'] = $_POST['btn_like'];
    };
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .desactived{
            color: black;
            background-color: gray;
        }
        .actived{
            color: white;
            background-color: red;
        }
    </style>
    <title>Forum</title>
</head>
<body>
    <h1>Tag</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
        <datalist id="list_tags">
            <?php foreach ($list_tag as $t){
                echo  "<option value='$t'>$t</option>";
            }; ?>
        </datalist>
        <input type="text" name="tag" list="list_tags">
        <button name="btn_tag">Enviar</button>
    </form>
    <hr>
    
        <?php
            foreach($result as $res){
                $id_forum = $res['id_forum'];
                $user_like = $res['user_like']? 'actived' : 'desactived';
                echo $res['name'];
                echo '<br>';
                echo $res['title'];
                echo '<br>';
                echo $res['content'];
                echo '<br>';
                echo $res['tags'];
                echo '<br>';
                echo $res['author'];
                echo '<br>';
                echo $res['user_like'];
                echo '<br>';
                echo "<button id='forum_$id_forum' class='$user_like' onclick='liked(this, {$_SESSION['id_user']})' name='btn_like' value='$id_forum'>Curtir</button>";
                echo "<span id='count_{$res['id_forum']}' class='count-like'>{$res['cont_like']}</span>";
                echo "<form action='".$_SERVER['PHP_SELF']."' method='POST'><button name='btn_comment' value=".$res['id_forum'].">Responder</button></form>";
                echo '<br>';
                echo '=======================================================================<br>';
            };
        ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <button name="previous">Previous</button>
        <button name="next">Next</button>
    </form>
    <script src="./liked.js"></script>
</body>
</html>