<?php
  require_once './controller/user_image_controller.php';
?>
<header>
  <a href="./index.php" class="header__title">MyChildrens</a>
  <nav class="header__nav">
    <a class="h-nav__a" href="./index.php">Início</a>
    <a class="h-nav__a" href="#">Sobre</a>
    <a class="h-nav__a" href="#">Conteúdo</a>
    <a class="h-nav__a" href="#">Postagens</a>
    <a class="h-nav__a" href="#">Contato</a>
    <!-- Dropdown -->
    <div class="dropdown">
      <img
        src="<?php echo seach_image_user();?>"
        alt="Imagem"
        width="50"
        height="50"
      />
      <!-- Substitua "imagem.png" pelo caminho da sua imagem -->
      <div class="dropdown-content">
        <a href="./entry.php">Sair</a>
        <button id="criarReddit">Criar um Reddit</button>
      </div>
    </div>
  </nav>

  <!-- FALTA COLOCAR A OPÇÃO ONDE APARECE A FOTO DE USUÁRIO -->
</header>