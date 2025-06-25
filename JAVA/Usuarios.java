public class Usuario extends pessoa implements Cadastro {
    private int id;
    private String login;
    private String senha;
    private String tipoUsuario; 
    private boolean ativo;
    
    public Usuario() {
        super();
    }
    
    public Usuario(int id, String nomeCompleto, String dataNascimento, String telefone, 
                   String email, String login, String senha, String tipoUsuario) {
        super(nomeCompleto, dataNascimento, telefone, email);
        this.id = id;
        this.login = login;
        this.senha = senha;
        this.tipoUsuario = tipoUsuario;
        this.ativo = true;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getLogin() {
        return login;
    }

    public void setLogin(String login) {
        this.login = login;
    }

    public String getSenha() {
        return senha;
    }

    public void setSenha(String senha) {
        this.senha = senha;
    }

    public String getTipoUsuario() {
        return tipoUsuario;
    }

    public void setTipoUsuario(String tipoUsuario) {
        this.tipoUsuario = tipoUsuario;
    }

    public boolean isAtivo() {
        return ativo;
    }

    public void setAtivo(boolean ativo) {
        this.ativo = ativo;
    }

    @Override
    public void cadastrar() {
        System.out.println("Usuário cadastrado com sucesso!");
    }

    @Override
    public void editar() {
        System.out.println("Usuário editado com sucesso!");
    }

    @Override
    public void exibir() {
        System.out.println(this.toString());
    }
    
    public boolean autenticar(String login, String senha) {
        return this.login.equals(login) && this.senha.equals(senha) && this.ativo;
    }
    
    public void desativar() {
        this.ativo = false;
        System.out.println("Usuário desativado!");
    }
    
    public void ativar() {
        this.ativo = true;
        System.out.println("Usuário ativado!");
    }

    @Override
    public String toString() {
        return super.toString() + " Usuario: ID=" + id + ", Login=" + login + 
               ", Tipo=" + tipoUsuario + ", Ativo=" + ativo + "\n";
    }
}