<div id="form-inserir-conta">
    <a href="./?c=contas" class="voltar">&#9204;Voltar</a>
    <h1 id="titulo-conta">Inserir Conta</h1>
    <form action="./?c=contas&m=inserir" method="POST">
        <label for="fname">Valor (R$):</label>
        <input type="number" step="0.01" name="valor" min="0.01" placeholder="0,00" required>

        <label for="instFinanceira">Intituição Financeira:</label>
        <input type="text" id="fname" name="instFinanceira" placeholder="Intituição Financeira..." required>

        <label for="fname">Descrição:</label>
        <input type="text" id="conta_desc" name="descricao" placeholder="Descrição..." required> 


        <label for="tipo_conta">Tipo de conta: </label>
        <select name="tipo_conta">
            <option value="corrente">Corrente</option>
            <option value="poupança">Poupança</option>
            <option value="Outro">Outro...</option>
        </select>
        <input type="submit" value="Inserir">
    </form>
    <div>
    <?= $msg ?>
  </div>
</div>