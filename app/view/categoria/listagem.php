<h1 id="titulo-categoria">Listagem de Categorias</h1>
<a href="./?c=categorias&m=inserir" id="btn-catInserir"><b>+ Categoria</b></a>
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
    <td><?= $categoria->statusCat ? 'Ativo' : 'Arquivado' ?></td>
    <td><a href="./?c=categorias&m=editar&id=<?= $categoria->id ?>">Editar</a></td>
    <td><a href="./?c=categorias&m=arquivar&id=<?= $categoria->id ?>">Arquivar</a></td>
  </tr>
  <?php endforeach;?>
  <?php else:?>
    <tr>
    <td colspan="4" style="text-align: center;">Vazio</td>
    </tr>
  <?php endif;?>
</table>