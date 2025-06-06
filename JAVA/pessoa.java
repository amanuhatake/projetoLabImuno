public abstract class pessoa {
	  private String nomeCompleto;
	  private String dataNascimento;
	  private String telefone;
	  private String email;
	  
	  public pessoa() {
		  
	  }
	  
	  public pessoa(String nomeCompleto, String dataNascimento, String telefone, String email) {
		  this.nomeCompleto = nomeCompleto;
		  this.dataNascimento = dataNascimento;
		  this.telefone = telefone;
		  this.email = email;
	  }

	public String getNomeCompleto() {
		return nomeCompleto;
	}

	public void setNomeCompleto(String nomeCompleto) {
		this.nomeCompleto = nomeCompleto;
	}

	public String getDataNascimento() {
		return dataNascimento;
	}

	public void setDataNascimento(String dataNascimento) {
		this.dataNascimento = dataNascimento;
	}

	public String getTelefone() {
		return telefone;
	}

	public void setTelefone(String telefone) {
		this.telefone = telefone;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	@Override
	public String toString() {
		return "Pessoa [nomeCompleto=" + nomeCompleto + ", dataNascimento=" + dataNascimento + ", telefone=" + telefone
				+ ", email=" + email + "]";
	}
	  

}
