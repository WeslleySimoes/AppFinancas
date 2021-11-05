<div id="form-inserir-categoria">
  <a href="./?c=categorias">Voltar</a>
  <h1 id="titulo-categoria">Inserir Categoria</h1>
  <form action="./?c=categorias&m=inserir" method="POST">
    <label for="categoria">Nome:</label>
    <input type="text" id="fname" name="categoria" placeholder="Nome da categoria..." required>

    <label for="tipos">Tipo: </label>
    <select name="tipos">
    <option value="receita">Receita</option>
    <option value="despesa">Despesa</option>
    </select>
    <input type="submit" value="Inserir">
  </form>
  <div>
    <?= $msg ?>
  </div>
</div>