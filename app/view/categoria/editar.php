<div id="form-inserir-categoria">
  <a href="./?c=categorias" class="voltar">&#9204;Voltar</a>
  <h1 id="titulo-categoria">Editar Categoria</h1>
  
  <form action="./?c=categorias&m=editar&id=<?= $_GET['id'] ?>" method="POST">
    <label for="categoria">Nome:</label>
    <input type="text" id="fname" name="categoria" placeholder="Nome da categoria..." value="<?= $categoria->nome ?>">

    <label for="tipos">Tipo: </label>
    <select name="tipos">
      <option value="Receita" <?= $categoria->tipo == 'Receita' ? 'Selected' : null ?>>Receita</option>
      <option value="Despesa" <?= $categoria->tipo == 'Despesa' ? 'Selected' : null ?>>Despesa</option>
    </select>
    <input type="submit" value="Editar">
  </form>
  
  <div>
    <?= $msg ?>
  </div>
</div>