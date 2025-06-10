//Importando a biblioteca Express
const express = require("express");
const app = express();
//Configurando para receber os dados do cliente em formato JSON
app.use(express.json());

//Configurando o Express para usar o EJS para as Views
app.set('view engine', 'ejs');

app.get("/", (req, res) => {
    //res.send("Bem vindo ao sistema!");
    res.render("index");
});

app.get("/paciente", (req, res) => {
    res.send("Listagem de paciente!!");
});

//ATENCAO
app.get("/carrinho", (req, res) => {
    //Enviando um código HTML para o cliente
    res.end("<html><head><title>Carrinho de compras</title></head><h4>Carrinho de Compras!</h4></html>");
});

app.get("/fornecedor/:nome", (req, res) => {
    //Recuperando o parâmetro "nome" passado na URL
    const nome = req.params.nome;
    console.log("Nome do fornecedor: ", nome);
    res.send(`Olá ${nome}`);
});

app.get("/editarpaciente/:pacienteregistro", (req, res) => {
    const id = req.params.pacienteregistro;
    console.log("Registro do paciente: ", registro);
    res.send("Editando o paciente com o registro: " + registro);
});

app.get("/inserpaciente", (req, res) => {
    res.render("formpaciente");
})
//Arrumar
app.post("/paciente", (req, res) => {
    console.log(req.body);
    const {nome, periodo, dataNascimento, telefone, email,nomeMae, medicamento, medicamentoNome, patologia, exame} = req.body;
    console.log(`Nome: ${nome} Data de nascimento: ${dataNascimento} Telefone: ${telefone} email: ${email} Nome Mae: ${nomeMae} Medicamento: ${medicamento}
         Nome do medicamento: ${medicamentoNome} Patologia: ${patologia} Exame: ${exame} `);
    res.send("Paciente inserido com sucesso!");
});

app.listen(3000, () => {
    console.log("Servidor rodando na porta 3000");
})