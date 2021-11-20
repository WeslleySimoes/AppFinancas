<?= $msg ?>
<h1 id="titulo-categoria">Listagem de Categorias</h1>
<a href="./?c=categorias&m=inserir" id="btn-catInserir"><b>+ Categoria</b></a>
<a href="./?c=categorias&f=arquivados"><b>Arquivados</b></a>
<table id="customers">
  <tr>
    <th>Categoria</th>
    <th>Tipo</th>
    <th>Status</th>
    <th colspan="2">Ações</th>
  </tr>
  <?php 
    if(isset($catItens) && count($catItens) > 0):
      foreach ($catItens as $categoria):
  ?>
  <tr>
    <td><?= $categoria->nome ?></td>
    <td><?= $categoria->tipo?></td>
    <td><?= $categoria->statusCat ? '<div class ="status_categoria_ativo">Ativo</div>' :'<div class ="status_categoria_arquivado">Arquivado</div>' ?></td>
    <?php if(isset($_GET['f'])&& $_GET['f'] =='arquivados'): ?>
      <td><a href="./?c=categorias&m=ativar&id=<?= $categoria->id ?>">Reativar</a></td>
    <?php else: ?>
      <td><a href="./?c=categorias&m=editar&id=<?= $categoria->id ?>">Editar</a></td>
      <td><a href="./?c=categorias&m=arquivar&id=<?= $categoria->id ?>">Arquivar</a></td>
    <?php endif; ?>
  </tr>
  <?php endforeach;?>
  <?php else:?>
    <tr>
    <td colspan="4" style="text-align: center;">Vazio!</td>
    </tr>
  <?php endif;?>
</table>