

function getPacientes(){
    const pac = [
        {nome: "Joana", telefone: "43997354874", registro: 1223, data: "13/02/2013", periodo: "noturno", nomeMae: "Ameira", examesSolicitados: "nao", Email: "joana123@gmail.com", Data_Nascimento: "21/03/2003", medicamento: "nao", medicamentoNome:"nenehum", patologia: "nao"},
        {nome: "Ana", telefone: "43998457105", registro: 1224, data: "13/02/2025", periodo: "manha", nomeMae: "Lucia", examesSolicitados: "nao", Email: "ana@gmail.com", Data_Nascimento: "18/04/2007", medicamento: "nao", medicamentoNome:"nenehum", patologia: "nao"},
    ]
    return pac;
}

function insertPaciente(nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia){
    if(nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia){
        console.log(`Paciente inserido! Nome: ${nome}, - telefone: ${telefone}, - data: ${data}, - periodo: ${periodo}, - nomeMae: ${nomeMae}, - examesSolicitados: ${examesSolicitados},
             - Email: ${Email}, - Data_Nascimento: ${Data_Nascimento}, - medicamento: ${medicamento}, - medicamentoNome: ${medicamentoNome}, - patologia${patologia}`);
             return true;
    }
    console.log("Falha ao inserir paciente, faltou algum dado");
    return false;
}

function editPaciente(nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia){
    if(nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia){
        console.log(`Editando paciente com id: ${registro} -> Nome: ${nome}, - telefone: ${telefone}, - data: ${data}, - periodo: ${periodo}, - nomeMae: ${nomeMae}, - examesSolicitados: ${examesSolicitados},
             - Email: ${Email}, - Data_Nascimento: ${Data_Nascimento}, - medicamento: ${medicamento}, - medicamentoNome: ${medicamentoNome}, - patologia${patologia}`);
             return true;
    }
    console.error("Falha ao editar paciente, falhou algum dado");
    return false;
}

function deletePaciente(registro){
    if(registro){
        console.log(`Removendo o paciente por ID: ${registro}`);
        return true;
    }
    console.error("FAlha ao remover paciente, nao foi passado o registro");
    return false;
}




module.exports = { getPacientes, insertPaciente, editPaciente, deletePaciente };