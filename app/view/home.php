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
const labels = [
'Mercado',
'February',
'March',
'April',
'May',
'June',
'Jul'
];
const data = {
labels: labels,
datasets: [{
label: 'My First dataset',
backgroundColor: ['green','red','blue','yellow'],
borderColor: '#E8E8E8',
data: [300, 10, 5, 2, 20, 30, 4500],
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
  maintainAspectRatio: false
}
}
);

var myChart2 = new Chart(
document.getElementById('myChart2'),
{
type: 'line',
config,
data,
options: {
  maintainAspectRatio: false
}
}
);

var myChart3 = new Chart(
  document.getElementById('myChart3'),
  {
      responsive: true,
      type: 'bar',
      data,
      options: {
        maintainAspectRatio: false //Deixa o gráfico responsivo,
      }
  }
);
</script>