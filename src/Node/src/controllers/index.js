const express = require("express");

const app = express();


app.set("use engine", "ejs");
app.set("views", "./src/views");

app.get('/', (req, res) => {
    res.send("Bem vindo ao sistema xpto");
});


//Dados pacientes
//Recebendo os dados de Pacientes
app.get("/listarPaciente", (req, res) =>    {

    res.render("listarpaciente");
})

app.listen(3000, 'localhost', () => {
    console.log("servidor rodando na porta 3000!");
});