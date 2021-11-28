<h1 id="titulo-relatorios">Relatórios</h1>
            <hr><br><br>
            <form action="./?c=relatorios" method="post" id="form-relatorios">
                <div id="filtros-relatorios">
                  <label for="filtros">Filtros:</label>
                  <select name="tipos">
                      <option value="1">Despesas por categorias</option>
                      <option value="2">Receitas por categorias</option>
                      <option value="3">Receitas e Despesas</option>
                      <option value="4">Saldo por mês</option>
                  </select>&nbsp;&nbsp;
                  <label for="data">Data:</label>
                  <select name="mes-ano">

                    <?php if(!empty($lista_data)): ?>
                      <?php foreach($lista_data as $data): ?>
                      <option value="<?= $data->mes.'/'.$data->ano ?>" <?= date('m/Y') == $data->mes.'/'.$data->ano ? 'Selected' : null ?>>
                        <?= $mesesRelatorios[$data->mes-1].'/'.$data->ano ?>
                      </option>
                    <?php endforeach; endif; ?>

                  </select>&nbsp;&nbsp;
                  <input type="submit" value="Filtrar">
                </div>
            </form>
            <div id="graficos">
              <div class="graf g3"><canvas id="myChart3"></canvas></div>
          </div>  
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
        <script>
          function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function contaItems(count) {
    var data =[];
    for (var i = 0; i < count; i++) {
        data.push(getRandomColor());
    }
    return data;
}

    const labels = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
      'Jul'
    ];
    
const cor = contaItems(labels.length);
    const data = {
      labels: labels,
      datasets: [{
        label: 'Gráfico',
        backgroundColor: cor,
        borderColor: '#E8E8E8',
        data: [1, 10, 5, 2, 20, 30, 45],
      }]
    };
    
    const config = {
      type: 'bar',
      data,
      options: {
        plugins: {
          legend: {
            position: 'topo'
          }
        }
      }
    }
        var myChart3 = new Chart(
        document.getElementById('myChart3'),
        {
            responsive: true,
            type: 'bar',
            data,
            options: {
              maintainAspectRatio: false //Deixa o gráfico responsivo
            }
        }
      );
    </script>