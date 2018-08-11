<?php

error_reporting(0);

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    $location = $_POST['location'];

    $sql = "SELECT * 
            FROM users
            WHERE nome like '%$location%'";
    
    $statement = $connection->prepare($sql);
    //$statement->bindParam(':location', $location, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>
        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Resultados</h2>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>Telefone</th>
          <th>Cidade</th>
          <th>Estado</th>
          <th>Email</th>
          <th>Informações Adicionais</th>
          <th>Tipo Cliente</th>
          <th>CPF / CNPJ</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["id"]); ?></td>
          <td><?php echo escape($row["nome"]); ?></td>
          <td><?php echo escape($row["telefone"]); ?></td>
          <td><?php echo escape($row["cidade"]); ?></td>
          <td><?php echo escape($row["estado"]); ?></td>
          <td><?php echo escape($row["email"]); ?></td>
          <td><?php echo escape($row["complemento"]); ?></td>
          <td><?php echo escape($row["tipo"]); ?> </td>
          <td><?php echo escape($row["cpf_cnpj"]); ?> </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>Nenhum resultado encontrado para <?php echo escape($_POST['nome']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Buscar usuários</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <label for="location">Nome:</label>
  <input type="text" id="location" name="location">
  <input type="submit" name="submit" value="Localizar...">
</form>

<br>
<a href="index.php">Voltar</a>

<?php require "templates/footer.php"; ?>