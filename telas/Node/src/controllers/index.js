const express = require("express");
const bodyParser = require("body-parser");

const app = express();


app.set("view engine", "ejs");
app.set("view", "./src/views");

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));

const { getPacientes, insertPaciente } = require("../models/DAO/pacienteDAO.js");




app.get('/', (req, res) => {
    res.send("Bem vindo ao sistema xpto");
});


//Dados pacientes
//Recebendo os dados de Pacientes
app.get("/listarPaciente", (req, res) =>    {
    const pacientes = getPacientes();
    console.log("Pacientes: ", pacientes);

    res.render("listarpaciente", {pacientesDoController: pacientes});
})

//Inserindo paciente (create)
app.post("/paciente", (req, res) => {
    const { nome, telefone, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia}  = req.body;

        const result = insertPaciente(nome, telefone, data, periodo, nomeMae, examesSolicitados,
             Email, Data_Nascimento, medicamento, medicamentoNome, patologia);
             
        if(result){
            return res.send("Paciente inserido");
        }     

       return  res.send("Paciente não inserido");
})

//Atualizando Cliente (update)
app.get("/editcliente/:registropaciente", (req, res) => {
    const registro = req.params.registropaciente;

    const pacientes = getPacientes();
    const paciente = pacientes(registro - 1);

    res.render("cadastropaciente", {paciente});
})




app.get("/newpaciente", (req, res) => {
    res.render("cadastroPaciente");
})

app.listen(3000, 'localhost', () => {
    console.log("servidor rodando na porta 3000!");
});