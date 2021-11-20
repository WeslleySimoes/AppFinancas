<?= $msg ?>
<h1 id="titulo-receita">Listagem de Receitas do Mês</h1>
<a href="./?c=receita&m=inserir" id="btn-recInserir"><b>+ Receita</b></a>
<table id="customers-receita">
    <tr>
      <th>Descrição</th>
      <th>Valor</th>
      <th>Categoria</th>
      <th>Data</th>
      <th colspan="2"> Ações</th>
    </tr>
    <?php if(!empty($receita) && isset($receita)): foreach($receita as $resc): ?>
    <tr>
        <td><?= $resc->descricao ?></td>
        <td>R$ <?= $resc->valor ?></td>
        <td><?= $resc->categoria ?></td>
        <td><?= $resc->desp_data ?></td>
        <td><a href="./?c=receita&m=editar&id=<?= $resc->id?>">Editar</a></td>
        <td><a href="./?c=receita&m=remover&id=<?= $resc->id?>" onclick="return confirm('Tem certeza que deseja Remover?');">Remover</a></td>
    </tr>
    <?php endforeach; else: ?>
    <tr>
       <td colspan="5" style="text-align: center;"> Vazio! <td>
    </tr>
    <?php endif; ?>
</table>
