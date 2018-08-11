<?php

error_reporting(0);

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $id           = $_POST['id'];
    $nome         = $_POST['nome'];
    $telefone     = $_POST['telefone'];
    $cidade       = $_POST['cidade'];
    $estado       = $_POST['estado'];
    $email        = $_POST['email'];
    $complemento  = $_POST['complemento'];
    $tipo         = $_POST['tipo'];
    $cpf_cnpj     = $_POST['cpf_cnpj'];

    $user =[
      "id"           => $_POST['id'],
      "nome"         => $_POST['nome'],
      "telefone"     => $_POST['telefone'],
      "cidade"       => $_POST['cidade'],
      "estado"       => $_POST['estado'],
      "email"        => $_POST['email'],
      "complemento"  => $_POST['complemento'],
      "tipo"         => $_POST['tipo'],
      "cpf_cnpj"     => $_POST['cpf_cnpj']
    ];

    $sql = "UPDATE users 
            SET id = $id, 
            nome = '$nome', 
            telefone = '$telefone', 
            cidade = '$cidade', 
            estado = '$estado', 
            email = '$email', 
            complemento = '$complemento',
            tipo = '$tipo',
            cpf_cnpj = '$cpf_cnpj' 
            WHERE id = $id";
  
  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    
    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Ops! ocorreu algum erro.";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['firstname']); ?> Atualizado com Sucesso!.</blockquote>
<?php endif; ?>

<h2>Editar usuário</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <br><br>
    <input type="submit" name="submit" value="Salvar">
</form>
<br>
<a href="index.php">Voltar</a>

<?php require "templates/footer.php"; ?>
