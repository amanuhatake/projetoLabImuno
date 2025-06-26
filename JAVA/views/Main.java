import java.util.Scanner;


public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int opcao;

        do {
            System.out.print("Escolha: ");
            System.out.println("1 - Cadastrar paciente");
            System.out.println("0 - Sair");
            opcao = scanner.nextInt();
            scanner.nextLine(); 

            switch (opcao) {
                case 1:
                    System.out.print("Informe o número de registro: ");
                    int registro = scanner.nextInt();
                    scanner.nextLine(); // limpa o buffer

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

                    Paciente paciente = new Paciente(registro, nome, dataNascimento, telefone, email, dataConsulta, periodo, nomeMae, exames);
                    paciente.salvar();
                    System.out.println("Paciente cadastrado!");
                    break;

                case 0:
                    System.out.println("Saindo do menu");
                    break;

                default:
                    System.out.println("Opção inválida");
            }

        } while (opcao != 0);

        scanner.close();
    }
}
