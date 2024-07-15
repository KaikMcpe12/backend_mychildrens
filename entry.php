<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/ent_reg.css">
  <title>Cadastrar</title>
</head>
<body>
  <div class="container">
    <h1>Entre em sua conta</h1>
    <form action="./controller/entry_user_controller.php" method="post">
      <input type="email" id="email" name="email" placeholder="Email" required>
      <input type="password" id="password" name="password" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>
    <p>Você não tem uma conta? <a href="./register.php">Cadastrar-se</a></p>
  </div>
</body>
</html>