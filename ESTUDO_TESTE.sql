CREATE TABLE conta(
    id INT NOT NULL,
    valor double(10,2) NOT NULL,
    instFinanca varchar(60) NOT NULL,
    descricao varchar(60) NOT NULL,
    tipo_conta varchar(8) NOT NULL,
    id_usuario int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

select SUM(valor) as total FROM despesa WHERE id_usuario = 3;

SELECT d.id, d.valor, d.descricao, d.desp_data ,c.nome as categoria FROM despesa as d INNER JOIN categoria as c ON d.id_categoria = c.id WHERE d.id_usuario = 3 AND MONTH(d.desp_data) = MONTH(CURRENT_DATE()) AND YEAR(d.desp_data) = YEAR(CURRENT_DATE())



/*RETORNA QUANTO FOI GASTO POR CATEGORIAS DE DESPESA*/
SELECT c.nome as categoria, SUM(d.valor) as total FROM despesa as d INNER JOIN categoria as c ON d.id_categoria = c.id WHERE d.id_usuario = 3 GROUP BY categoria