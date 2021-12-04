<div id="form-editar-conta">
    <a href="./?c=contas" class="voltar">&#9204;Voltar</a>
    <h1 id="titulo-conta">Editar Conta</h1> 
    <form action="./?c=contas&m=editar&id=<?= $_GET['id'] ?>" method="POST">
        <label for="fname">Valor (R$):</label>
        <input type="number" step="0.01" name="valor" min="0.01" placeholder="0,00" value="<?=$contaItem->valor?>">

        <label for="instFinanceira">Intituição Financeira:</label>
        <input type="text" id="fname" name="instFinanceira" placeholder="Intituição Financeira..." value="<?=$contaItem->instFinanca?>">

        <label for="fname">Descrição:</label>
        <input type="text" id="fname" name="descricao" placeholder="Descrição..." value="<?=$contaItem->descricao?>">


        <label for="tipo_conta">Tipo de conta: </label>
        <select name="tipo_conta">
            <option value="corrente" <?= $contaItem->tipo_conta == 'corrente' ? 'Selected': '' ?>>Corrente</option>
            <option value="poupança" <?= $contaItem->tipo_conta == 'poupança' ? 'Selected': '' ?>>Poupança</option>
            <option value="Outro" <?=$contaItem->tipo_conta == 'outro' ? 'Selected': '' ?>>Outro...</option>
        </select>
        <input type="submit" value="Alterar">
    </form>
    <div>
        <?= $msg ?>
    </div>
</div>