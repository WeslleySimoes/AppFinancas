<div id="form-inserir-despesa">
<a href="./?c=despesa" class="voltar">&#9204;Voltar</a>
<h1 id="titulo-despesa">Inserir Despesa</h1>
<form action="./?c=despesa&m=inserir" method="POST">
    <label for="valor">Valor (R$):</label>
    <input type="number" step="0.01" name="valor" min="0.01" placeholder="0,00" required>
    <label for="descricao">Descrição:</label>
    <input type="text" id="fname" name="descricao" placeholder="Descrição..." required> 
    <label for="categoria">Categoria: </label>
    <select name="categoria">
      <?php 
        if(!empty($categorias)):
          foreach($categorias as $categoria):
      ?>
      <option value="<?= $categoria->id ?>"> <?= $categoria->nome ?> </option>
      <?php 
          endforeach;
        else:
      ?>
       <option value="vazio">Não há categoria cadastrada!</option>
     <?php endif; ?>
    </select>
    <label for="data">Data:</label><br>
    <input type="date" id="input-date" name="data" value="<?= date("Y-m-d") ?>" min="<?= date("Y-m").'-01' ?>" max="<?= date("Y-m").'-'.date("t", mktime(0,0,0,date('m'),'01',date('Y'))) ?>"><br><br>
    <input type="submit" value="Inserir">
  </form>
  <div>
    <?= $msg ?>
  </div>
</div>


<?php 
  if(empty($categorias)):
?>
<!-- The Modal -->
<div id="myModal" class="modal" style="display: block"> 

  <!-- Modal content -->
  <div class="modal-content">
    <p><?= $msg ?></p>
    <a href="./?c=categorias" id="btn-modal">OK</a>
  </div>

</div>
<?php endif; ?>