<?php

error_reporting(0);

require "../config.php";
require "../common.php";

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM users";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>Editar usuários</h2>

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
            <td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Editar</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br><br>
<a href="index.php">Voltar</a>

<?php require "templates/footer.php"; ?>