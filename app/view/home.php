<div id="financeiro">
    <div class="item-finan">Saldo: <br>
      <b style="color: <?= $total_saldo >= 0 ? 'green' : 'red' ?>;">R$ <?= $total_saldo ?></b>
    </div>
    <div class="item-finan">Receitas:  <br><b>R$ <?= $total_receitas ?></b></div>
    <div class="item-finan">Despesas:  <br><b style="color: red;">R$ <?= $total_despesas ?></b></div>
    <div class="item-finan">Contas:   <br><b>R$ <?= $total_contas ?></b></div>
</div>
<div id="graficos">
    <div class="graf g1">
        <canvas id="myChart"></canvas>
    </div>
    <div class="graf g2"><canvas id="myChart2"></canvas></div>
    <div class="graf g3"><canvas id="myChart3"></canvas></div>
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
'Mercado',
'February',
'March',
'April',
'May',
'June',
'Jul',
'dwdw',
'dsdwd',
'dsdad',
'afwf'
];

const cor = contaItems(labels.length);
const data = {
labels:<?= $listaCategoriaReceita ?>,
datasets: [{
label: 'My First dataset',
backgroundColor: cor,
borderColor: cor,
data: <?= $ListaValoresReceita ?>
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
};
var myChart = new Chart(
document.getElementById('myChart'),
{
type: 'pie',
config,
data,
options: {
  maintainAspectRatio: false,
      plugins: {
      title: {
        display: true,
        text: 'Total de receita por categoria',
      }
    }
}
}
);

/* ------------------------ Gráfico de Linha ---------------------*/

const dataGrafico2 = {
  labels: <?= $lista_categoria ?>,
  datasets: [{
  label: 'Total de despesa por categoria',
  backgroundColor: ['black'],
  borderColor: '#E8E8E8',
  data: <?= $listaValores ?>,
  }]
};


var myChart2 = new Chart(
  document.getElementById('myChart2'),
  {
  type: 'line',
  config,
  data: dataGrafico2,
  options: {
    maintainAspectRatio: false
  }
  }
);




/* ------------------------ Gráfico de Barras ---------------------*/
const labelCategorias = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];

const dataCategorias = {
  labels:labelCategorias,
  datasets: [{
    label: 'Despesas',
    backgroundColor: ['#F64E60'],
    borderColor: '#F64E60',
    data: <?= $listaValoresDespesaMes ?>,
  },
  {
    label: 'Receitas',
    backgroundColor: ['#0BB783'],
    borderColor: '#B4FE98',
    data: <?= $listaValoresReceitaMes ?>,
  }]
};

var myChart3 = new Chart(
  document.getElementById('myChart3'),
  {
      responsive: true,
      type: 'bar',
      data: dataCategorias,
      options: {
        maintainAspectRatio: false //Deixa o gráfico responsivo,
      }
  }
);
</script>