class Paciente {
  constructor(nome, telefone, registro, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento) {
    this.nome = nome;
    this.telefone = telefone;
    this.registro = registro;
    this.data = data;
    this.periodo = periodo;
    this.nomeMae = nomeMae;
    this.examesSolicitados = examesSolicitados;
    this.Email = Email;
    this.Data_Nascimento = Data_Nascimento;
    this.medicamento = medicamento;
    this.medicamentoNome = medicamentoNome;
    this.patologia = patologia;
  }
}

module.exports = Paciente;
