import java.util.Scanner;
import controller.PacienteController;
import model.Paciente;

public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        PacienteController controller = new PacienteController();

        int opcao;

        do {
            System.out.println("1 - Cadastrar paciente");
            System.out.println("2 - Listar todos os pacientes");
            System.out.println("3 - Buscar paciente por registro");
            System.out.println("0 - Sair");

            System.out.print("Escolha: ");
            opcao = scanner.nextInt();
            scanner.nextLine(); 

            switch (opcao) {
                case 1:
                    System.out.print("Informe o nome");
                    String nome = scanner.nextLine();

                    System.out.print("Informe a data de nascimento: ");
                    String dataNascimento = scanner.nextLine();

                    System.out.print("Informe o telefone: ");
                    String telefone = scanner.nextLine();

                    System.out.print("Informe o Email: ");
                    String email = scanner.nextLine();

                    System.out.print("Informe qual foi a data da consulta: ");
                    String dataConsulta = scanner.nextLine();

                    System.out.print("Informe o período: ");
                    String periodo = scanner.nextLine();

                    System.out.print("Informe nome da mãe: ");
                    String nomeMae = scanner.nextLine();

                    System.out.print("Exames solicitados: ");
                    String exames = scanner.nextLine();

                    controller.cadastrarPaciente(
                        nome, dataNascimento, telefone, email,
                        dataConsulta, periodo, nomeMae, exames
                    );
                    break;

                case 2:
                    controller.listarPacientes();
                    break;

                case 3:
                    System.out.print("Digite o número de registro: ");
                    int registro = scanner.nextInt();
                    scanner.nextLine(); 
                    Paciente p = controller.buscarPorRegistro(registro);
                    if (p != null) {
                        p.exibir();
                    } else {
                        System.out.println("Paciente não encontrado.");
                    }
                    break;

                case 0:
                    System.out.println("Encerrando o programa...");
                    break;

                default:
                    System.out.println("Opção inválida.");
            }

        } while (opcao != 0);

        scanner.close();
    }
}
