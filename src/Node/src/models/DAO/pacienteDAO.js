

function getPacientes(){
    const pac = [
        {nome: Joana, telefone: 43997354874, registro: 1223, data: "13/02/2013", periodo: "noturno", nomeMae: "Ameira", examesSolicitados: "nao", Email: "joana123@gmail.com", Data_Nascimento: "21/03/2003", medicamento: "nao", medicamentoNome:"nenehum", patologia: "nao"},
        {nome: Ana, telefone: 43998457105, registro: 1224, data: "13/02/2025", periodo: "manha", nomeMae: "Lucia", examesSolicitados: "nao", Email: "ana@gmail.com", Data_Nascimento: "18/04/2007", medicamento: "nao", medicamentoNome:"nenehum", patologia: "nao"},
    ]
    return pac;
}

module.exports = {getPacientes};