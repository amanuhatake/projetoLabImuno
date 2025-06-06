import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        Paciente paciente = new Paciente(); 

        int opcao;

        do {
            System.out.println("\n=== Escolha uma das opções: ===");
            System.out.println("1 - Cadastrar paciente");
            System.out.println("2 - Editar paciente");
            System.out.println("3 - Exibir paciente");
            System.out.println("0 - Sair");
            
            opcao = scanner.nextInt();
            scanner.nextLine(); 

            switch (opcao) {
                case 1:
                    paciente.cadastrar();
                    break;
                case 2:
                    paciente.editar();
                    break;
                case 3:
                    paciente.exibir();
                    break;
                case 0:
                    System.out.println("Saindo das opções");
                    break;
                default:
                    System.out.println("Opção inválida
                    ");
            }

        } while (opcao != 0);

        scanner.close();
    }
}
