package dao;

import java.util.ArrayList;
import java.util.List;

import model.Paciente;

public class PacienteDao {

    public void salvarPaciente(Paciente paciente) {
        if (paciente.getRegistro() == 0) {
            paciente.setRegistro(FileHandler2.getNextId("Paciente")); 
        }

        String insertSQL = String.format(
            "INSERT INTO Paciente (registro, nomeCompleto, dataNascimento, telefone, email, data, periodo, nomeMae, examesSolicitados) " +
            "VALUES (%d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
            paciente.getRegistro(),
            paciente.getNome(),
            paciente.getDataNascimento(),
            paciente.getTelefone(),
            paciente.getEmail(),
            paciente.getData(),
            paciente.getPeriodo(),
            paciente.getNomeMae(),
            paciente.getExamesSolicitados()
        );

        FileHandler2.writeInsertStatement(insertSQL); 
    }

    public Paciente buscarPorId(int registro) {
        List<String> linhas = FileHandler2.readLines();
        for (String linha : linhas) {
            if (linha.startsWith("INSERT INTO Paciente")) {
                String regStr = FileHandler2.getValueFromInsert(linha, "registro");
                if (regStr != null && Integer.parseInt(regStr) == registro) {
                    Paciente p = new Paciente();
                    p.setRegistro(registro);
                    p.setNome(FileHandler2.getValueFromInsert(linha, "nomeCompleto"));
                    p.setDataNascimento(FileHandler2.getValueFromInsert(linha, "dataNascimento"));
                    p.setTelefone(FileHandler2.getValueFromInsert(linha, "telefone"));
                    p.setEmail(FileHandler2.getValueFromInsert(linha, "email"));
                    p.setData(FileHandler2.getValueFromInsert(linha, "data"));
                    p.setPeriodo(FileHandler2.getValueFromInsert(linha, "periodo"));
                    p.setNomeMae(FileHandler2.getValueFromInsert(linha, "nomeMae"));
                    p.setExamesSolicitados(FileHandler2.getValueFromInsert(linha, "examesSolicitados"));
                    return p;
                }
            }
        }
        return null;
    }

    public List<Paciente> listarTodos() {
        List<String> linhas = FileHandler2.readLines();
        List<Paciente> pacientes = new ArrayList<>();

        for (String linha : linhas) {
            if (linha.startsWith("INSERT INTO Paciente")) {
                Paciente p = new Paciente();

                p.setRegistro(Integer.parseInt(FileHandler2.getValueFromInsert(linha, "registro")));
                p.setNome(FileHandler2.getValueFromInsert(linha, "nomeCompleto"));
                p.setDataNascimento(FileHandler2.getValueFromInsert(linha, "dataNascimento"));
                p.setTelefone(FileHandler2.getValueFromInsert(linha, "telefone"));
                p.setEmail(FileHandler2.getValueFromInsert(linha, "email"));
                p.setData(FileHandler2.getValueFromInsert(linha, "data"));
                p.setPeriodo(FileHandler2.getValueFromInsert(linha, "periodo"));
                p.setNomeMae(FileHandler2.getValueFromInsert(linha, "nomeMae"));
                p.setExamesSolicitados(FileHandler2.getValueFromInsert(linha, "examesSolicitados"));

                pacientes.add(p);
            }
        }

        return pacientes;
    }
}
