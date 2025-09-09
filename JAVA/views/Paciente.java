import java.io.FileWriter;
import java.io.IOException;

public class Paciente extends Pessoa {
    private int registro;
    private String data;
    private String periodo;
    private String nomeMae;
    private String examesSolicitados;

    public Paciente() {
        super();
    }

    public Paciente(int registro, String nomeCompleto, String dataNascimento, String telefone, String email,
                    String data, String periodo, String nomeMae, String examesSolicitados) {
        super(nomeCompleto, dataNascimento, telefone, email);
        this.registro = registro;
        this.data = data;
        this.periodo = periodo;
        this.nomeMae = nomeMae;
        this.examesSolicitados = examesSolicitados;
    }

    public int getRegistro() {
        return registro;
    }

    public void setRegistro(int registro) {
        this.registro = registro;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public String getPeriodo() {
        return periodo;
    }

    public void setPeriodo(String periodo) {
        this.periodo = periodo;
    }

    public String getNomeMae() {
        return nomeMae;
    }

    public void setNomeMae(String nomeMae) {
        this.nomeMae = nomeMae;
    }

    public String getExamesSolicitados() {
        return examesSolicitados;
    }

    public void setExamesSolicitados(String examesSolicitados) {
        this.examesSolicitados = examesSolicitados;
    }

    @Override
    public String toString() {
        return super.toString() + "Paciente: Registro: " + registro + " Data: " + data + " Periodo: " + periodo +
               " Nome mãe: " + nomeMae + " Exames Solicitados: " + examesSolicitados + "\n";
    }

    public void salvar() {
        String insert = String.format(
            "INSERT INTO pacientes (registro, nomeCompleto, dataNascimento, telefone, email, data, periodo, nomeMae, examesSolicitados) " +
            "VALUES ('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
            registro, getNomeCompleto(), getDataNascimento(), getTelefone(), getEmail(), data, periodo, nomeMae, examesSolicitados
        );

        try (FileWriter writer = new FileWriter("pacientes_inserts.sql", true)) {
            writer.write(insert + "\n");
        } catch (IOException e) {
            System.out.println("Não foi possível salvar o arquivo de paciente: " + e.getMessage());
        }
    }
}
