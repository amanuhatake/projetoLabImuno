const pool = require('./db');

async function getPacientes(){
    const {rows} = await pool.query("SELECT * FROM paciente ORDER BY registro");
    const pacientes = rows;

    return pacientes;
}

async function insertPaciente(nome, telefone, Sexo, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia){
    if(nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia){
        const result = await pool.query(`
            INSERT INTO pacientes(nome, telefone, Sexo, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia)
            values($1, $2, $3, $4, $5, $6, $7, $8,$9, $10, $11, $12)
            RETURNING nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia`,
            [nome, telefone,Sexo, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia]
        );  
       console.log("Resultado do insert:", result.rows[0]);
       if(result.rows.length > 0){
         return true;
       }
       return false;
    }
    console.error("Falha ao inserir um paciente, faltou algum dado");
    return false;
}    

async function editPaciente(registro ,nome, telefone, Sexo, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia){
    if(registro, nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia){
        console.log("Dados: ", registro, nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia);
        const result = await pool.query(`
            UPDATE pacientes
            SET nome = $1, telefone = $2, data = $3, periodo = $4, nomeMae = $5, examesSolicitados = $6, Email = $7, Data_Nascimento = $8, medicamento = $9, medicamentoNome = $10, patologia = $11, Sexo = $12
            WHERE registro = $13;
            RETURNING  nome, telefone, Sexo, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia`,
            [nome, telefone, Sexo, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento, medicamento, medicamentoNome, patologia]
        );
        console.log("Resultado do edit: " + result.rows[0]);

        if(result.rows.length === 0) return false;
             return true;
    }
    console.error("Falha ao editar paciente, falhou algum dado");
    return false;
}

async function deletePaciente(registro){
    if(registro){
        const result = await pool.query(`
            DELETE FROM pacientes
            WHERE registro = $1
            RETURNING  registro`,
            [registro]
        ); 
        if(result.rows.length === 0) return false;
        return true;
    }
    console.error("Falha ao remover paciente, nao foi passado o registro");
    return false;
}


module.exports = { getPacientes, insertPaciente, editPaciente, deletePaciente };