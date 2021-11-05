<div id="form-inserir-categoria">
  <a href="./?c=categorias">Voltar</a>
  <h1 id="titulo-categoria">Editar Categoria</h1>
  
  <form action="./?c=categorias&m=editar&id=<?= $_GET['id'] ?>" method="POST">
    <label for="categoria">Nome:</label>
    <input type="text" id="fname" name="categoria" placeholder="Nome da categoria..." value="<?= $categoria->nome ?>">

    <label for="tipos">Tipo: </label>
    <select name="tipos">
      <option value="receita" <?= $categoria->tipo == 'receita' ? 'Selected' : null ?>>Receita</option>
      <option value="despesa" <?= $categoria->tipo == 'despesa' ? 'Selected' : null ?>>Despesa</option>
    </select>
    <input type="submit" value="Editar">
  </form>
  
  <div>
    <?= $msg ?>
  </div>
</div>