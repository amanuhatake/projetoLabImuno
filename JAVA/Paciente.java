
public class Paciente {
	 private int registro;
	 private String data;
	 private String periodo;
	 private String nomeMae;
	 private String examesSolicitados;
	 
	 public Paciente() {
		 
	 }
	 
	 public Paciente(String data, String periodo, String nomeMae, String examesSolicitadps ) {
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
		return "Paciente: Registro:" + registro + "Data:" + data + "Periodo:" + periodo + "Nome mãe:" + nomeMae
				+ "Exames Solicitados:" + examesSolicitados + "\n";
	}
	 
	 

}
