const express = require("express");
const bodyParser = require("body-parser");

const app = express();

app.set("view engine", "ejs");
app.set("views", "./src/views");

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));

const { 
    getExames, 
    getExamesSolicitados, 
    getExamesSolicitadosByPaciente,
    insertExame, 
    insertExameSolicitado,
    editExame, 
    deleteExame,
    deleteExameSolicitado 
} = require("../models/DAO/exameDAO.js");

app.get('/', (req, res) => {
    res.status(200).send("Bem vindo ao sistema de exames");
});

// Enviando os dados de exames (Read)
app.get("/listarExames", async (req, res) => {
    const exames = await getExames();
    console.log("Exames: ", exames);

    res.status(200).render("listarexames", {examesDoController: exames});
})

// API para enviar os dados de exames
app.get("/api/exames", async (req, res) => {
    const exames = await getExames();

    res.status(200).json({success: true, exames});
})

// enviar os dados de exames solicitados
app.get("/api/exames-solicitados", async (req, res) => {
    const examesSolicitados = await getExamesSolicitados();

    res.status(200).json({success: true, examesSolicitados});
})

// enviar os exames solicitados de um paciente específico
app.get("/api/exames-solicitados/:id_paciente", async (req, res) => {
    const id_paciente = req.params.id_paciente;
    const examesSolicitados = await getExamesSolicitadosByPaciente(id_paciente);

    res.status(200).json({success: true, examesSolicitados});
})

// Inserindo exames
app.get("/newexame", (req, res) => {
    res.status(200).render("cadastroExame", {exame: {}});
})

app.post("/exames", async (req, res) => {
    const {id_exame, nome_exame} = req.body;

    if(id_exame){
        const result = await editExame(id_exame, nome_exame);
        if(result){
             return res.redirect("/listarExames");
        }
        return res.status(404).send("Não foi possível editar o exame");
    }else{
        const result = await insertExame(nome_exame);
        if(result){
          return res.redirect("/listarExames");
        }
        return res.status(404).send("Não foi possível inserir o exame");
    }
});

// Inserindo exame via API
app.post("/api/exames", async (req, res) => {
    const { nome_exame } = req.body;

    const result = await insertExame(nome_exame);

    if(result){
        return res.status(201).json({success: true, exame: result});
    }
    return res.status(400).json({success: false});
})

// Inserindo exame solicitado via API
app.post("/api/exames-solicitados", async (req, res) => {
    const { id_paciente, id_exame, data_registro } = req.body;

    const result = await insertExameSolicitado(id_paciente, id_exame, data_registro);

    if(result){
        return res.status(201).json({success: true, exameSolicitado: result});
    }
    return res.status(400).json({success: false});
})

// Atualizando Exame (update)
app.get("/editexame/:id_exame", async (req, res) => {
    const id_exame = req.params.id_exame;

    const exames = await getExames();
    const exame = exames.find(e => e.id_exame == id_exame);

    res.status(200).render("cadastroExame", {exame});
})

app.put("/exames", async (req, res) => {
    const { id_exame, nome_exame } = req.body;

    const result = await editExame(id_exame, nome_exame);

    if(result){
       return res.status(200).send("Exame editado com sucesso"); 
    }

    return res.status(404).send("Não foi possível editar exame");
})

// API para editar um exame
app.put("/api/exames", async (req, res) => {
     const { id_exame, nome_exame } = req.body;
      
      const result = await editExame(id_exame, nome_exame);
        
     if(result){
        return res.status(200).json({success: true, exame: result}); 
     }
     return res.status(404).json({success: false});
})

// Removendo um exame (delete)
app.get("/removerexame/:id_exame", async (req, res) => {
    const id_exame = req.params.id_exame;
    const result = await deleteExame(id_exame);
    if(result){
        return res.redirect("/listarExames");
    }
    return res.status(404).send("Não foi possível remover o exame!");
})  

app.delete("/exames", async (req, res) => {
    const {id_exame} = req.body;
    const result = await deleteExame(id_exame);
    if(result){
        return res.status(200).send("Exame removido com sucesso");
    }
    return res.status(404).send("Não foi possível remover o exame!");
})

// API para remover exame
app.delete("/api/exames", async (req, res) => {
    const {id_exame} = req.body;
    const result = await deleteExame(id_exame);
    if(result){
        return res.status(200).json({success: true});
    }
    return res.status(400).json({success: false});
})

// API para remover exame solicitado
app.delete("/api/exames-solicitados", async (req, res) => {
    const {id_exame_solicitado} = req.body;
    const result = await deleteExameSolicitado(id_exame_solicitado);
    if(result){
        return res.status(200).json({success: true});
    }
    return res.status(400).json({success: false});
})

app.listen(3001, '0.0.0.0', () => {
    console.log("Servidor de exames rodando na porta 3001!");
});

