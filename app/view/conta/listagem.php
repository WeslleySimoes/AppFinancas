<div id="form-listagem-conta" >
    <?= $msg ?>
    <h1 id="titulo-conta_listagem">Contas</h1>
    <div>
        <a href="./?c=contas&m=inserir" id="btn-adicionar-conta">Adicionar Conta</a><br>
    </div>

    <?php 
        if(isset($contasListagem) && !empty($contasListagem)):
            foreach($contasListagem as $conta_item):
    ?>
    <div class="conta_info">
        <b>Inst.Financeira:</b> <?= $conta_item->instFinanca ?><br>
        <b>Tipo de Conta:</b><?=  $conta_item->tipo_conta ?><br>
        <b>Valor:</b> R$ <?= $conta_item->valor ?><br>
        <div style="margin-top: 20px;">
            <a href="./?c=contas&m=editar&id=<?=$conta_item->id?>" class='btn_editar_conta'>Editar</a>
            <a href="./?c=contas&m=excluir&id=<?=$conta_item->id?>" class='btn_excluir_conta' onclick="return confirm('Tem certeza que deseja Remover?');">Remover</a>
        </div>
    </div>
    <?php 
            endforeach;
        else:
    ?>
    <p style="text-align: center; color:tomato;margin-top:5vh;">
        <b>Nenhuma Conta Cadastrada!</b>
    </p>
    <?php endif; ?>

</div>