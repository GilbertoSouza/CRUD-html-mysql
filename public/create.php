<?php

error_reporting(0);

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "nome"         => $_POST['nome'],
      "telefone"     => $_POST['telefone'],
      "cidade"       => $_POST['cidade'],
      "estado"       => $_POST['estado'],
      "email"        => $_POST['email'],
      "complemento"  => $_POST['complemento'],
      "tipo"         => $_POST['tipo'],
      "cpf_cnpj"     => $_POST['cpf_cnpj']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "users",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );
    
    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['nome']); ?> Cadastrado com sucesso!</blockquote>
  <?php endif; ?>

  <h2>Adicionar usuário</h2>

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">

    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome"><br><br>

    <label for="tipo">Tipo Cliente</label>
    <input type="radio" name="tipo" id="tipo" value="PF"> Pessoa Física
    <input type="radio" name="tipo" id="tipo" value="PJ"> Pessoa Jurídica<br><br>

    <label for="cpf_cnpj">CPF / CNPJ</label>
    <input type="text" name="cpf_cnpj" id="cpf_cnpj" >

    <label for="telefone">Telefone</label>
    <input type="text" name="telefone" id="telefone">

    <label for="cidade">Cidade</label>
    <input type="text" name="cidade" id="cidade">

    <label for="estado">Estado</label>
    <select name="estado" name="estado" id="estado">
      <option value="AC">Acre</option>
      <option value="AL">Alagoas</option>
      <option value="AP">Amapá</option>
      <option value="AM">Amazonas</option>
      <option value="BA">Bahia</option>
      <option value="CE">Ceará</option>
      <option value="DF">Distrito Federal</option>
      <option value="ES">Espírito Santo</option>
      <option value="GO">Goiás</option>
      <option value="MA">Maranhão</option>
      <option value="MT">Mato Grosso</option>
      <option value="MS">Mato Grosso do Sul</option>
      <option value="MG">Minas Gerais</option>
      <option value="PA">Pará</option>
      <option value="PB">Paraíba</option>
      <option value="PR">Paraná</option>
      <option value="PE">Pernambuco</option>
      <option value="PI">Piauí</option>
      <option value="RJ">Rio de Janeiro</option>
      <option value="RN">Rio Grande do Norte</option>
      <option value="RS">Rio Grande do Sul</option>
      <option value="RO">Rondônia</option>
      <option value="RR">Roraima</option>
      <option value="SC">Santa Catarina</option>
      <option value="SP">São Paulo</option>
      <option value="SE">Sergipe</option>
      <option value="TO">Tocantins</option>
    </select>

    <label for="email">Email</label>
    <input type="text" name="email" id="email">

    <label for="complemento">Informações Adicionais</label>
    <textarea rows="4" cols="25" name="complemento" id="complemento"></textarea>

    <br><br>
    <input type="submit" name="submit" value="Salvar">
  </form>
  <br>
  <a href="index.php">Voltar</a>

<?php require "templates/footer.php"; ?>
