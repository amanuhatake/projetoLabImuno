const pool = require('./db');

async function getExames(){
    const {rows} = await pool.query("SELECT * FROM exames ORDER BY id_exame");
    const exames = rows;

    return exames;
}

async function getExamesSolicitados(){
    const {rows} = await pool.query(`
        SELECT es.id_exame_solicitado, es.id_paciente, es.id_exame, es.data_registro, 
               e.nome_exame, p.nome as nome_paciente
        FROM exames_solicitados es
        JOIN exames e ON es.id_exame = e.id_exame
        JOIN paciente p ON es.id_paciente = p.id_paciente
        ORDER BY es.data_registro DESC
    `);
    const examesSolicitados = rows;

    return examesSolicitados;
}

async function getExamesSolicitadosByPaciente(id_paciente){
    const {rows} = await pool.query(`
        SELECT es.id_exame_solicitado, es.id_exame, es.data_registro, e.nome_exame
        FROM exames_solicitados es
        JOIN exames e ON es.id_exame = e.id_exame
        WHERE es.id_paciente = $1
        ORDER BY es.data_registro DESC
    `, [id_paciente]);
    const examesSolicitados = rows;

    return examesSolicitados;
}

async function insertExame(nome_exame){
    if(nome_exame){
        const result = await pool.query(`
            INSERT INTO exames(nome_exame)
            VALUES($1)
            RETURNING id_exame, nome_exame`,
            [nome_exame]
        );  
       console.log("Resultado do insert exame:", result.rows[0]);
       if(result.rows.length > 0){
         return result.rows[0];
       }
       return false;
    }
    console.error("Falha ao inserir um exame, faltou o nome do exame");
    return false;
}

async function insertExameSolicitado(id_paciente, id_exame, data_registro){
    if(id_paciente && id_exame && data_registro){
        const result = await pool.query(`
            INSERT INTO exames_solicitados(id_paciente, id_exame, data_registro)
            VALUES($1, $2, $3)
            RETURNING id_exame_solicitado, id_paciente, id_exame, data_registro`,
            [id_paciente, id_exame, data_registro]
        );  
       console.log("Resultado do insert exame solicitado:", result.rows[0]);
       if(result.rows.length > 0){
         return result.rows[0];
       }
       return false;
    }
    console.error("Falha ao inserir um exame solicitado, faltaram dados");
    return false;
}

async function editExame(id_exame, nome_exame){
    if(id_exame && nome_exame){
        console.log("Dados: ", id_exame, nome_exame);
        const result = await pool.query(`
            UPDATE exames
            SET nome_exame = $1
            WHERE id_exame = $2
            RETURNING id_exame, nome_exame`,
            [nome_exame, id_exame]
        );
        console.log("Resultado do edit exame: ", result.rows[0]);

        if(result.rows.length === 0) return false;
             return result.rows[0];
    }
    console.error("Falha ao editar exame, faltaram dados");
    return false;
}

async function deleteExame(id_exame){
    if(id_exame){
        const result = await pool.query(`
            DELETE FROM exames
            WHERE id_exame = $1
            RETURNING id_exame`,
            [id_exame]
        ); 
        if(result.rows.length === 0) return false;
        return true;
    }
    console.error("Falha ao remover exame, não foi passado o id do exame");
    return false;
}

async function deleteExameSolicitado(id_exame_solicitado){
    if(id_exame_solicitado){
        const result = await pool.query(`
            DELETE FROM exames_solicitados
            WHERE id_exame_solicitado = $1
            RETURNING id_exame_solicitado`,
            [id_exame_solicitado]
        ); 
        if(result.rows.length === 0) return false;
        return true;
    }
    console.error("Falha ao remover exame solicitado, não foi passado o id");
    return false;
}

module.exports = { 
    getExames, 
    getExamesSolicitados, 
    getExamesSolicitadosByPaciente,
    insertExame, 
    insertExameSolicitado,
    editExame, 
    deleteExame,
    deleteExameSolicitado 
};

