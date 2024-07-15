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
    <h1>Crie sua conta</h1>
    <form action="./controller/register_user_controller.php" method="post">
      <input type="text" id="name" name="name" placeholder="Nome" required>
      <input type="email" id="email" name="email" placeholder="Email" required>
      <input type="password" id="password" name="password" placeholder="Senha" required>
      <button type="submit">Cadastrar</button>
    </form>
    <p>Você já tem uma conta? <a href="./entry.php">Logar</a></p>
  </div>
</body>
</html>