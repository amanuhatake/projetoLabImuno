const express = require("express");
const bodyParser = require("body-parser");

const app = express();


app.set("view engine", "ejs");
app.set("view", "./src/views");

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));

const { getPacientes, insertPaciente, editPaciente, deletePaciente } = require("../models/DAO/pacienteDAO.js");

app.get('/', (req, res) => {
    res.status(200).send("Bem vindo ao sistema xpto");
});


//Dados pacientes
//Recebendo os dados de Pacientes
app.get("/listarPaciente", (req, res) =>    {
    const pacientes = getPacientes();
    console.log("Pacientes: ", pacientes);

    res.status(200).render("listarpaciente", {pacientesDoController: pacientes});
})

//API para enviar os dados de pacientes
app.get("/api/pacientes", (req, res) => {
    const pacientes = getPacientes();

    res.status(200).json({sucess: true, pacientes});
})


//Inserindo paciente (create)
app.get("/newpaciente", (req, res) => {
    res.status(200).render("cadastroPaciente", {paciente: {}});
})

app.post("/newpaciente", (req, res) => {
    const { nome, telefone, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia}  = req.body;

        const result = insertPaciente(nome, telefone, data, periodo, nomeMae, examesSolicitados,
             Email, Data_Nascimento, medicamento, medicamentoNome, patologia);
             
        if(result){
            return res.status(201).send("Paciente inserido");
        }     

       return  res.status(404).send("Paciente não inserido");
})

//Inserindo paciente via API
app.post("/api/pacientes", (req, res) => {
    const { nome, telefone, data, periodo, nomeMae, examesSolicitados, 
    Email, Data_Nascimento, medicamento, medicamentoNome, patologia}  = req.body;

    const result = insertPaciente(nome, telefone, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia);

        if(result){
            return res.status(202).json({sucess: true});
        }
        return res.status(400).json({sucess: false});

})

//Atualizando Cliente (update)
app.get("/editcliente/:registropaciente", (req, res) => {
    const registro = req.params.registropaciente;

    const pacientes = getPacientes();
    const paciente = pacientes(registro - 1);

    res.status(200).render("cadastropaciente", {paciente});
})


app.put("/pacientes", (req, res) => {
    const { nome, telefone, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia}  = req.body;

    const result = editPaciente( nome, telefone, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia);

        if(result){
           return  res.status(200).send("Paciente editado com sucesso"); 
        }

    return res.status(404).send("Não foi possivel editar paciente");
})

//API para editar um paciente
app.put("api/pacientes", (req, res) => {
     const { nome, telefone, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia}  = req.body;
      
      const result = editPaciente( nome, telefone, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia);
        
     if(result){
        return res.status(200).json({sucess: true}); 
     }
     return res.status(404).json({sucess: false});
})

//Removendo um paciente (delete)
app.delete("/pacientes", (req, res) => {
    const {registro} = req.body;
    const result = deletePaciente(registro);
    if(result){
        return res.status(200).send("Paciente removido com sucesso");
    }
    return res.status(404).send("Não foi possivel remover o paciente!");
})

//API para remover paciente
app.delete("/api/pacientes", (req, res) => {
    const {registro} = req.body;
    const result = deletePaciente(registro);
    if(result){
        return res.status(200).json({sucess: true});
    }
    return res.status(400).json({sucess: false});

})

app.listen(3000, 'localhost', () => {
    console.log("servidor rodando na porta 3000!");
});