package dao;

import java.io.*;
import java.util.ArrayList;
import java.util.List;

public class FileHandler2 {

    private static final String FILE_PATH = "pacientes.txt";

    public static void writeInsertStatement(String insertSQL) {
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(FILE_PATH, true))) {
            writer.write(insertSQL);
            writer.newLine();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public static List<String> readLines() {
        List<String> linhas = new ArrayList<>();
        try (BufferedReader reader = new BufferedReader(new FileReader(FILE_PATH))) {
            String linha;
            while ((linha = reader.readLine()) != null) {
                linhas.add(linha);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        return linhas;
    }

    public static int getNextId(String tabela) {
        int maxId = 0;
        for (String linha : readLines()) {
            if (linha.startsWith("INSERT INTO " + tabela)) {
                String regStr = getValueFromInsert(linha, "registro");
                if (regStr != null) {
                    int id = Integer.parseInt(regStr);
                    if (id > maxId) maxId = id;
                }
            }
        }
        return maxId + 1;
    }

    public static String getValueFromInsert(String insertSQL, String nomeCampo) {
        try {
            String campos = insertSQL.substring(insertSQL.indexOf("(") + 1, insertSQL.indexOf(")"));
            String valores = insertSQL.substring(insertSQL.indexOf("VALUES (") + 8, insertSQL.lastIndexOf(")"));

            String[] camposArray = campos.split(",\\s*");
            String[] valoresArray = valores.split(",\\s*");

            for (int i = 0; i < camposArray.length; i++) {
                if (camposArray[i].equalsIgnoreCase(nomeCampo)) {
                    String valor = valoresArray[i].trim();
                    if (valor.startsWith("'") && valor.endsWith("'")) {
                        valor = valor.substring(1, valor.length() - 1);
                    }
                    return valor;
                }
            }
        } catch (Exception e) {
            System.err.println("Erro ao extrair valor de campo: " + nomeCampo);
        }
        return null;
    }
}
