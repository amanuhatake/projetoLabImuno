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
//Enviando os dados de paciente (Read)
app.get("/listarPaciente", async (req, res) =>    {
    const pacientes = await getPacientes();
    console.log("Pacientes: ", pacientes);

    res.status(200).render("listarpaciente", {pacientesDoController: pacientes});
})

//API para enviar os dados de pacientes
app.get("/api/pacientes", async (req, res) => {
    const pacientes = await getPacientes();

    res.status(200).json({sucess: true, pacientes});
})


//Inserindo paciente (create)
app.get("/newpaciente", (req, res) => {
    res.status(200).render("cadastroPaciente", {paciente: {}});
})

app.post("/pacientes", async (req, res) => {
    const {registro,nome, telefone,Sexo, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia} = req.body;

        if(registro){
            const result = await editPaciente(registro, nome, telefone,Sexo, data, periodo, nomeMae, examesSolicitados, 
            Email, Data_Nascimento, medicamento, medicamentoNome, patologia);
            if(result){
                 return res.redirect("/pacientes");
            }
            return res.status(404).send("Não foi possivel editar o paciente");
        }else{
            const result = await insertPaciente(nome, telefone, Sexo,data, periodo, nomeMae, examesSolicitados, 
            Email, Data_Nascimento, medicamento, medicamentoNome, patologia);
            if(result){
              return res.redirect("/pacientes");
            }
            return res.status(404).send("Não foi possivel editar o paciente");
        }

});

/*app.post("/paciente", async (req, res) => {
    const { nome, telefone, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia}  = req.body;

        const result = await insertPaciente(nome, telefone, data, periodo, nomeMae, examesSolicitados,
             Email, Data_Nascimento, medicamento, medicamentoNome, patologia);
             
        if(result){
            return res.status(201).send("Paciente inserido");
        }     

       return  res.status(404).send("Paciente não inserido");
})*/



//Inserindo paciente via API
app.post("/api/pacientes", async (req, res) => {
    const { nome, telefone,Sexo ,data, periodo, nomeMae, examesSolicitados, 
    Email, Data_Nascimento, medicamento, medicamentoNome, patologia}  = req.body;

    const result = await insertPaciente(nome, telefone,Sexo, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia);

        if(result){
            return res.status(202).json({sucess: true});
        }
        return res.status(400).json({sucess: false});

})

//Atualizando Cliente (update)
app.get("/editcliente/:registropaciente", async (req, res) => {
    const registro = req.params.registropaciente;

    const pacientes = await getPacientes();
    const paciente = pacientes(registro - 1);

    res.status(200).render("cadastropaciente", {paciente});
})


app.put("/pacientes", async (req, res) => {
    const { nome, telefone,Sexo, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia}  = req.body;

    const result = await editPaciente( nome, telefone,Sexo, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia);

        if(result){
           return  res.status(200).send("Paciente editado com sucesso"); 
        }

    return res.status(404).send("Não foi possivel editar paciente");
})

//API para editar um paciente
app.put("api/pacientes", async (req, res) => {
     const { nome, telefone, Sexo, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia}  = req.body;
      
      const result = await editPaciente( nome, telefone,Sexo, data, periodo, nomeMae, examesSolicitados, 
        Email, Data_Nascimento, medicamento, medicamentoNome, patologia);
        
     if(result){
        return res.status(200).json({sucess: true}); 
     }
     return res.status(404).json({sucess: false});
})

//Removendo um paciente (delete)
app.get("/removerpaciente/:registro", async (req, res) => {
    const registro = req.params.registro;
    const result = await deletePaciente(registro);
    if(result){
        return res.status(404).redirect("/CadastroPaciente");
    }
    return res.status(404).send("não foi possível remover o paciente!");
})  

app.delete("/pacientes", async (req, res) => {
    const {registro} = req.body;
    const result = await deletePaciente(registro);
    if(result){
        return res.status(200).send("Paciente removido com sucesso");
    }
    return res.status(404).send("Não foi possivel remover o paciente!");
})

//API para remover paciente
app.delete("/api/pacientes", async (req, res) => {
    const registro = req.body;
    const result = await deletePaciente(registro);
    if(result){
        return res.status(200).json({sucess: true});
    }
    return res.status(400).json({sucess: false});

})

app.listen(3000, 'localhost', () => {
    console.log("servidor rodando na porta 3000!");
});