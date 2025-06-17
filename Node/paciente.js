const express = require('express');
const router = express.Router();
const Paciente = require('../models/Paciente');

let pacientes = [];
let nextRegistro = 1;

// Listar todos
router.get('/', (req, res) => {
  res.json(pacientes);
});

// Buscar por registro
router.get('/:registro', (req, res) => {
  const registro = parseInt(req.params.registro);
  const paciente = pacientes.find( p => p.registro === registro);
  if (!paciente) return res.status(404).json({ message: 'paciente não encontrado' });
  res.json(paciente);
});

// Inserir
router.post('/', (req, res) => {
  const {nome, telefone, registro, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento} = req.body;
  const paciente = new Paciente(nextRegistro++, nome, telefone, registro, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento);
  pacientes.push(paciente);
  res.status(201).json(paciente);
});

// Editar
router.put('/:registro', (req, res) => {
  const registro = parseInt(req.params.registro);
  const paciente = pacientes.find(p => p.registro === registro);
  if (!paciente) return res.status(404).json({ message: 'paciente não encontrado' });

  const {nome, telefone, registro: novoRegistro, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento} = req.body;
  paciente.nome = nome ?? paciente.nome;
  paciente.telefone =  telefone ?? paciente.telefone;
  paciente.registro = novoRegistro ?? paciente.registro;
  paciente.data = data ?? paciente.data;
  paciente.periodo = periodo ?? paciente.periodo;
  paciente.nomeMae = nomeMae ?? paciente.nomeMae;
  paciente.examesSolicitados = examesSolicitados ?? paciente.examesSolicitados;
  paciente.Email = Email ?? paciente.Email;
  paciente.Data_Nascimento = Data_Nascimento ?? paciente.Data_Nascimento;


  res.json(paciente);
});

// Excluir
router.delete('/:registro', (req, res) => {
  const registro = parseInt(req.params.registro);
  const index = pacientes.findIndex(p => p.registro === registro);
  if (index === -1) return res.status(404).json({ message: 'paciente não encontrado' });

  pacientes.splice(index, 1);
  res.status(204).send();
});

module.exports = router;
