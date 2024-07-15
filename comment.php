<?php
    session_start();
    include_once './controller/comment_reddit_controller.php';
    include_once './disqus.php';

    seach_reddit($_SESSION['id_user']);
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <style>
        section{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #disqus_thread{
            padding: 5%;
        }
    </style>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script>
        disqus_config = function () {
            this.page.url = 'http://localhost/mychildrens/comment.php?id_reddit=<?php echo $_SESSION['id_reddit']; ?>';
            this.page.identifier = '<?php echo $_SESSION['id_reddit']; ?>';
        };
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</head>
<body>
    <?php 
        require_once './header.php';
        $user_like = $_SESSION['reddit']['user_like']? 'clicked' : 'desaclicked';
    ?>
    <section>
        <div class="reddit">
            <div class="reddit__header">
                <img
                src="./assets/img/pessoa.jpg"
                alt="imgUser"
                class="r-header__img"
                />
                <p class="r-header__user"><?php echo $_SESSION['reddit']['name']; ?></p>
            </div>

            <div class="reddit__content">
                <h3><?php echo $_SESSION['reddit']['title']; ?></h3>
                <p class="r-content__p">
                <?php echo $_SESSION['reddit']['content']; ?>
                </p>

                <div class="r-content__tags">
                <?php foreach(explode(',', $_SESSION['reddit']['tags']) as $tag) { ?>
                    <p class="r-content__tags__p"><?php echo $tag;?></p>
                <?php }; ?>
                </div>
            </div>
            
            <div class="reddit__reaction">
                <button class="like-button <?php echo $user_like;?>" id="<?php echo 'forum_'.$_SESSION['reddit']['id_forum'];?>" onclick='liked(this, <?php echo $_SESSION["reddit"]["id_user"]?>)' name="btn_like" value="<?php echo $_SESSION['reddit']['id_forum'];?>">
                <div class="heart"></div>
                <p class="r-reaction__heart__p" id="count_<?php echo $_SESSION['reddit']['id_forum']?>"><?php echo $_SESSION['reddit']['cont_like']?> Gostei</p>
                </button>
            </div>
        </div>
    </section>
    <div id="disqus_thread"></div>
</body>
<script src="./assets/js/liked.js" defer></script>
</html>