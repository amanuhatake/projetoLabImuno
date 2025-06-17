const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');
const path = require('path');

const app = express();
const DATA_FILE = path.join(__dirname, 'paciente.json');

app.use(bodyParser.json());

function lerPacientes() {
  if (!fs.existsSync(DATA_FILE)) return [];
  const data = fs.readFileSync(DATA_FILE, 'utf-8');
  return JSON.parse(data);
}

function salvarPaciente(data) {
  fs.writeFileSync(DATA_FILE, JSON.stringify(data, null, 2));
}

function getNextRegistro(pacientes) {
  return pacientes.length > 0 ? Math.max(...pacientes.map(p => p.registro)) + 1 : 1;
}

// Listar todos os pacientes
app.get('/pacientes', (req, res) => {
  const pacientes = lerPacientes();
  res.json(pacientes);
});

// Buscar paciente por ID
app.get('/pacientes/:registro', (req, res) => {
  const registro = parseInt(req.params.registro);
  const pacientes = lerPacientes();
  const paciente = pacientes.find(p => p.registro === registro);
  if (!paciente) return res.status(404).json({ message: 'Paciente não encontrado' });
  res.json(paciente);
});

// Inserir novo paciente
app.post('/pacientes', (req, res) => {
  const { nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento } = req.body;
  const pacientes = lerPacientes();
  const novoPaciente = { 
  registro: getNextRegistro(pacientes), // gera o número automaticamente
  nome, 
  telefone, 
  data, 
  periodo, 
  nomeMae, 
  examesSolicitados,
  Data_Nascimento,
  Email
};

  pacientes.push(novoPaciente);
  salvarPaciente(pacientes);
  res.status(201).json(novoPaciente);
});

// Editar paciente existente
app.put('/pacientes/:registro', (req, res) => {
  const registro = parseInt(req.params.registro);
  const pacientes = lerPacientes();
  const paciente = pacientes.find(p => p.registro === registro);
  if (!paciente) return res.status(404).json({ message: 'Paciente não encontrado' });

  const { nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento } = req.body;
  paciente.nome = nome ?? paciente.nome;
  paciente.telefone = telefone ?? paciente.telefone;
  paciente.data = data ?? paciente.data;
  paciente.periodo = periodo ?? paciente.periodo;
  paciente.nomeMae = nomeMae ?? paciente.nomeMae;
  paciente.examesSolicitados = examesSolicitados ?? paciente.examesSolicitados;
  paciente.Email = Email ?? paciente.Email;
  paciente.Data_Nascimento = Data_Nascimento ?? paciente.Data_Nascimento;

  salvarPaciente(pacientes);
  res.json(paciente);
});

// Excluir paciente
app.delete('/pacientes/:registro', (req, res) => {
  const registro = parseInt(req.params.registro);
  let pacientes = lerPacientes();
  const index = pacientes.findIndex(p => p.registro === registro);
  if (index === -1) return res.status(404).json({ message: 'Paciente não encontrado' });

  pacientes.splice(index, 1);
  salvarPaciente(pacientes);
  res.status(204).send();
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`API rodando na porta ${PORT}`);
});
