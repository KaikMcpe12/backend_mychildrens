<?php
    session_start();
    require_once './controller/read_reddit_controller.php';
    require_once './controller/seach_tag_controller.php';
    require_once './controller/comment_reddit_controller.php';

    $_SESSION['id_user'] = isset($_SESSION['id_user'])? $_SESSION['id_user'] : 648;
    if(!$_SESSION['id_user']){
      header("Location: ./entry.php");
    };

    ###############PÁGINA#################
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $tag = isset($_GET['tag']) ? $_GET['tag'] : '';
        $seach = isset($_GET['seach']) ? $_GET['seach'] : '';
    }else{
        $page = 1;
        header("Location: index.php?page=$page&tag=$tag&seach=$seach");
    };

    #######Redireciona com tag#######
    if(isset($_GET['seach_btn'])) {
        $tag = $_GET['tag'];
        $seach = $_GET['seach'];
        header("Location: index.php?page=$page&tag=$tag&seach=$seach");
    };
    
    ###########PESQUISA TAG OU GERAL#######
    if(isset($_GET['tag']) or isset($_GET['seach'])){
        $result = seach_tag_controller($tag, $seach,  $page);
        $total_page = get_all_page($tag, $seach);
    }else{
        $result = refresh($page);
        $total_page = get_all_page();
    };
    
    ##############PRÓXIMO E ANTERIOR##########
    if(isset($_POST['next']) and $page < $total_page){
        $page += 1;
        header("Location: index.php?page=$page&tag=$tag&seach=$seach");
    }else if(isset($_POST['previous']) and $page > 1){
        $page -= 1;
        header("Location: index.php?page=$page&tag=$tag&seach=$seach");
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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="MyChildrens" />
    <meta name="description" content="" />
    <title>Reddit - MyChildrens</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/index.css"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <?php require_once './header.php';?>

    <main>
      <section id="start">
        <h2 class="start__h2">Your Reddit</h2>
        <p class="start__p">
          Aqui você pública suas ideias ou informação que queira compartilhar 🩷
        </p>
          <!-- FALTA COLOCAR O ICONE DE PESQUISAR (SEM INTERNET) -->

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET" class="start__search">
          <input
            class="s-search__input"
            type="text"
            name="seach"
            id="pesquisar"
            placeholder="Pesquisar"
          />

          <datalist id="list_tags">
            <option class="categoria__opcao" value="" disabled>
              Escolha uma Categoria
            </option>
            <?php foreach ($list_tag as $t){
              echo  "<option class='categoria__opcao' value=$t>$t</option>";
            }; ?>
          </datalist>
          <input class="s-search__categoria" id="categoria" name="tag" list='list_tags' placeholder="Digite aqui uma tag">

          <button class="magnifying_glass" name="seach_btn"><img src="./assets/svg/magnifying-glass.svg" alt="magnifying_glass" class="magnifying_glass_image"></button>
        </form>
      </section>

      <section id="all-content">
        <?php
          foreach($result as $res){
              $id_forum = $res['id_forum'];
              $user_like = $res['user_like']? 'clicked' : 'desaclicked';
        ?>
          <div class="reddit">
            <div class="reddit__header">
              <img
                src="./assets/svg/users/user-<?php echo $res['url_image'];?>.svg"
                alt="imgUser"
                class="r-header__img"
              />
              <p class="r-header__user"><?php echo $res['name']; ?></p>
            </div>

            <div class="reddit__content">
              <h3><?php echo $res['title']; ?></h3>
              <p class="r-content__p">
                <?php echo $res['content']; ?>
              </p>

              <div class="r-content__tags">
                <?php foreach(explode(', ', $res['tags']) as $tag) { ?>
                  <p class="r-content__tags__p">#<?php echo $tag;?></p>
                <?php }; ?>
              </div>
            </div>
            
            <div class="reddit__reaction">
              <button class="like-button <?php echo $user_like;?>" id="<?php echo 'forum_'.$id_forum;?>" onclick='liked(this, <?php echo $_SESSION["id_user"]?>)' name="btn_like" value="<?php echo $id_forum;?>">
                <div class="heart"></div>
                <p class="r-reaction__heart__p" id="count_<?php echo $res['id_forum']?>"><?php echo $res['cont_like']?> Gostei</p>
              </button>

              <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="r-reaction__comment">
                <button class="comment-button" name="btn_comment" value="<?php echo $res['id_forum']?>">
                  <i class="fa-solid fa-comment fa-2xl" style="color: #74c0fc"></i>
                  <p class="r-reaction__comment__p">Comentar</p>
                </button>
              </form>
            </div>
          </div>
        <?php
            }
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="buttons_page">
          <button name="previous" class="previous"><img src="./assets/svg/previous.svg" alt="previous"></button>
          <h3><?php echo "$page/$total_page";?></h3>
          <button name="next" class="next"><img src="./assets/svg/next.svg" alt="next"></button>
        </form>
      </section>
      <div class="modal" id="modal">
        <form action="./controller/create_reddit_controller.php" method="post" class="modal_form">
          <div class="modal__header">
            <label for="redditTitle">Título do Novo Reddit</label>
            <input type="text" name="title" id="redditInput" />
          </div>
  
          <div class="modal__content">
            <label for="redditContent">Conteúdo do Reddit</label>
            <input type="text" name="content" id="redditContent" />
          </div>
  
          <div class="modal__tags">
            <div id="tagContainer"></div>
            <input type="hidden" id="hiddenInput" name="tags"> <!--Hidden -->
            <label for="redditTags">Insira as Tags</label>
            <input
              type="text"
              name="redditTag"
              id="redditTag"
              placeholder="Ex: Motivação"
              onkeyup="checkForSpace(event)"
            />
          </div>
          <div class="buttons_modal">
            <a id="cancelReddit">Cancelar</a>
            <input type="submit" name="submit"  value="Criar Reddit" id="create_reddit"/>
          </div>
        </form>
      </div>
      
    </main>
    <script src="./assets/js/liked.js" defer></script>
    <script src="./assets/js/main.js" ></script>
  </body>
</html>
