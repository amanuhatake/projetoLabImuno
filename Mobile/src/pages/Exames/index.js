import React, { useState } from 'react';
import {
  StyleSheet,
  Text,
  View,
  TextInput,
  SafeAreaView,
  ActivityIndicator,
  TouchableOpacity,
  Keyboard,
  Alert,
  StatusBar,
} from 'react-native';

// --- SIMULAÇÃO DE UMA API E BANCO DE DADOS ---
// Em um app real, esta lógica estaria no seu backend.
const DADOS_FALSOS_DO_BANCO = [
  {
    id: 1,
    nomePaciente: 'Carlos Silva',
    laboratorio: 'Laboratório Central',
    tipoExame: 'Hemograma Completo',
    dataRequisicao: '2025-09-01',
    dataMarcada: '2025-09-10',
    resultado: 'Valores dentro da normalidade.',
  },
  {
    id: 2,
    nomePaciente: 'Ana Pereira',
    laboratorio: 'Clínica Diagnose',
    tipoExame: 'Glicemia de Jejum',
    dataRequisicao: '2025-08-20',
    dataMarcada: '2025-08-22',
    resultado: 'Glicemia elevada. Recomenda-se acompanhamento médico.',
  },
  {
    id: 3,
    nomePaciente: 'João Costa',
    laboratorio: 'Laboratório Vida',
    tipoExame: 'Colesterol Total e Frações',
    dataRequisicao: '2025-09-05',
    dataMarcada: '2025-09-08',
    resultado: 'LDL acima do recomendado.',
  },
];

// Esta função simula a chamada à API no backend.
const mockApiBuscaExame = (nome) => {
  console.log(`Buscando exame para o paciente: ${nome}`);
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      // Procura no "banco de dados" por um nome correspondente (ignorando maiúsculas/minúsculas)
      const nomeFormatado = nome.trim().toLowerCase();
      const resultado = DADOS_FALSOS_DO_BANCO.find(
        (exame) => exame.nomePaciente.toLowerCase() === nomeFormatado
      );

      if (resultado) {
        resolve(resultado); // Encontrou, retorna o objeto do exame
      } else {
        resolve(null); // Não encontrou, retorna nulo
      }
      // Para simular um erro de rede, você poderia usar reject() aqui.
    }, 1500); // Atraso de 1.5 segundos para simular a rede
  });
};
// --- FIM DA SIMULAÇÃO ---


const PaginaExames = () => {
  const [textoBusca, setTextoBusca] = useState('');
  const [resultadoExame, setResultadoExame] = useState(null);
  const [carregando, setCarregando] = useState(false);
  const [buscaRealizada, setBuscaRealizada] = useState(false);
  const [erro, setErro] = useState(null);

  // Função para formatar a data para o padrão brasileiro
  const formatarData = (dataString) => {
    const [ano, mes, dia] = dataString.split('-');
    return `${dia}/${mes}/${ano}`;
  };

  const handleBusca = async () => {
    Keyboard.dismiss();
    if (!textoBusca.trim()) {
      Alert.alert('Atenção', 'Por favor, digite um nome para buscar.');
      return;
    }

    setCarregando(true);
    setBuscaRealizada(true);
    setResultadoExame(null);
    setErro(null);

    try {
      // Chama a nossa API simulada
      const resultado = await mockApiBuscaExame(textoBusca);
      setResultadoExame(resultado); // Armazena o resultado no estado
    } catch (e) {
      setErro('Ocorreu um erro ao buscar o exame. Tente novamente.');
      console.error(e);
    } finally {
      setCarregando(false);
    }
  };
  
  // Função para organizar a renderização da área de resultados
  const renderizarResultado = () => {
    if (carregando) {
      return <ActivityIndicator size="large" color="#007bff" style={{ marginTop: 40 }} />;
    }

    if (erro) {
      return <Text style={styles.textoErro}>{erro}</Text>;
    }
    
    if (!buscaRealizada) {
      return <Text style={styles.textoInstrucao}>Digite o nome completo do paciente para ver os resultados do exame.</Text>;
    }

    if (resultadoExame) {
      return (
        <View style={styles.cardResultado}>
          <Text style={styles.cardTitulo}>Resultado do Exame</Text>
          
          <View style={styles.linhaInfo}>
            <Text style={styles.label}>Laboratório:</Text>
            <Text style={styles.valor}>{resultadoExame.laboratorio}</Text>
          </View>

          <View style={styles.linhaInfo}>
            <Text style={styles.label}>Tipo do Exame:</Text>
            <Text style={styles.valor}>{resultadoExame.tipoExame}</Text>
          </View>

          <View style={styles.linhaInfo}>
            <Text style={styles.label}>Data da Requisição:</Text>
            <Text style={styles.valor}>{formatarData(resultadoExame.dataRequisicao)}</Text>
          </View>
          
          <View style={styles.linhaInfo}>
            <Text style={styles.label}>Data Marcada:</Text>
            <Text style={styles.valor}>{formatarData(resultadoExame.dataMarcada)}</Text>
          </View>
          
          <View style={styles.linhaResultado}>
            <Text style={styles.label}>Resultado:</Text>
            <Text style={styles.valorResultado}>{resultadoExame.resultado}</Text>
          </View>
        </View>
      );
    }

    return <Text style={styles.textoNaoEncontrado}>Nenhum exame encontrado para este paciente.</Text>;
  };

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="dark-content" />
      <View style={styles.secaoBusca}>
        <Text style={styles.titulo}>Consulta de Exames</Text>
        <TextInput
          style={styles.input}
          placeholder="Digite o nome do paciente"
          placeholderTextColor="#888"
          value={textoBusca}
          onChangeText={setTextoBusca}
        />
        <TouchableOpacity
          style={styles.botao}
          onPress={handleBusca}
          disabled={carregando}
        >
          <Text style={styles.textoBotao}>
            {carregando ? 'Buscando...' : 'Buscar Exame'}
          </Text>
        </TouchableOpacity>
      </View>
      
      <View style={styles.secaoResultado}>
        {renderizarResultado()}
      </View>

    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f4f6f8',
  },
  secaoBusca: {
    padding: 20,
    backgroundColor: '#fff',
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
  },
  titulo: {
    fontSize: 24,
    fontWeight: 'bold',
    textAlign: 'center',
    marginBottom: 20,
    color: '#333',
  },
  input: {
    height: 50,
    backgroundColor: '#fff',
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 8,
    paddingHorizontal: 15,
    fontSize: 16,
    marginBottom: 15,
  },
  botao: {
    backgroundColor: '#007bff',
    paddingVertical: 15,
    borderRadius: 8,
    alignItems: 'center',
    justifyContent: 'center',
  },
  textoBotao: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
  },
  secaoResultado: {
    flex: 1,
    padding: 20,
  },
  textoInstrucao: {
    fontSize: 16,
    textAlign: 'center',
    color: '#666',
    marginTop: 30,
  },
  textoNaoEncontrado: {
    fontSize: 18,
    textAlign: 'center',
    color: '#d9534f',
    marginTop: 30,
    fontWeight: 'bold',
  },
  textoErro: {
    fontSize: 18,
    textAlign: 'center',
    color: '#c9302c',
    marginTop: 30,
  },
  cardResultado: {
    backgroundColor: '#fff',
    borderRadius: 8,
    padding: 20,
    borderWidth: 1,
    borderColor: '#e0e0e0',
  },
  cardTitulo: {
    fontSize: 20,
    fontWeight: 'bold',
    color: '#007bff',
    borderBottomWidth: 1,
    borderBottomColor: '#eee',
    paddingBottom: 10,
    marginBottom: 15,
  },
  linhaInfo: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 12,
  },
  linhaResultado: {
    marginTop: 10,
  },
  label: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#555',
  },
  valor: {
    fontSize: 16,
    color: '#333',
    flex: 1,
    textAlign: 'right',
  },
  valorResultado: {
    fontSize: 16,
    color: '#333',
    marginTop: 5,
    lineHeight: 24,
  },
});

export default PaginaExames;