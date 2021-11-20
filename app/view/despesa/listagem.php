<?= $msg ?>
<h1 id="titulo-despesa">Listagem de Despesas do Mês</h1>
<a href="./?c=despesa&m=inserir" id="btn-despInserir"><b>+ Despesa</b></a>
<table id="customers-despesa">
    <tr>
      <th>Descrição</th>
      <th>Valor</th>
      <th>Categoria</th>
      <th>Data</th>
      <th colspan="2"> Ações</th>
    </tr>
    <?php if(!empty($despesa) && isset($despesa)): foreach($despesa as $desp): ?>
    <tr>
        <td><?= $desp->descricao ?></td>
        <td>R$ <?= $desp->valor ?></td>
        <td><?= $desp->categoria ?></td>
        <td><?= $desp->desp_data ?></td>
        <td><a href="./?c=despesa&m=editar&id=<?= $desp->id?>">Editar</a></td>
        <td><a href="./?c=despesa&m=remover&id=<?= $desp->id?>" onclick="return confirm('Tem certeza que deseja Remover?');">Remover</a></td>
    </tr>
    <?php endforeach; else: ?>
    <tr>
       <td colspan="5" style="text-align: center;"> Vazio! <td>
    </tr>
    <?php endif; ?>
</table>
