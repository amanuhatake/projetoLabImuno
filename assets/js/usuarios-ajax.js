// Variáveis globais
let usuarioAtual = null;
let paginaAtual = 1;
const itensPorPagina = 10;

// Inicialização quando o documento estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    carregarEstatisticas();
    carregarUsuarios();
    
    // Event listeners - verificar se elementos existem
    const formFiltros = document.querySelector('.row.g-3');
    if (formFiltros) {
        formFiltros.addEventListener('submit', function(e) {
            e.preventDefault();
            carregarUsuarios();
        });
    }

    const formUsuario = document.querySelector('#formularioUsuario form');
    if (formUsuario) {
        formUsuario.addEventListener('submit', function(e) {
            e.preventDefault();
            salvarUsuario();
        });
    }

    // Validação em tempo real
    document.getElementById('email').addEventListener('blur', function() {
        verificarEmailExistente(this.value);
    });

    document.getElementById('cpf').addEventListener('blur', function() {
        verificarCpfExistente(this.value);
    });

    // Máscara para CPF
    document.getElementById('cpf').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = value;
        }
    });

    // Máscara para telefone
    document.getElementById('telefone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            e.target.value = value;
        }
    });
});

// Carregar estatísticas
function carregarEstatisticas() {
    fetch('UsuarioController.php?acao=estatisticas')
        .then(response => response.json())
        .then(data => {
            if (data.sucesso) {
                document.getElementById('totalUsuarios').textContent = data.dados.total;
                document.getElementById('usuariosAtivos').textContent = data.dados.ativos;
                document.getElementById('usuariosInativos').textContent = data.dados.inativos;
                document.getElementById('tiposUsuario').textContent = data.dados.tipos;
            }
        })
        .catch(error => console.error('Erro ao carregar estatísticas:', error));
}

// Carregar lista de usuários
function carregarUsuarios() {
    const busca = document.getElementById('busca').value;
    const tipoUsuario = document.getElementById('filtroTipoUsuario').value;
    const status = document.getElementById('filtroStatus').value;

    const params = new URLSearchParams({
        acao: 'listar',
        busca: busca,
        tipo_usuario: tipoUsuario,
        status: status
    });

    fetch(`UsuarioController.php?${params}`)
        .then(response => response.json())
        .then(data => {
            if (data.sucesso) {
                exibirUsuarios(data.dados);
            }
        })
        .catch(error => {
            console.error('Erro ao carregar usuários:', error);
            mostrarAlerta('Erro ao carregar usuários', 'danger');
        });
}

// Exibir usuários na tabela
function exibirUsuarios(usuarios) {
    const tbody = document.querySelector('#tabelaUsuarios tbody');
    tbody.innerHTML = '';

    if (usuarios.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center">Nenhum usuário encontrado</td></tr>';
        return;
    }

    usuarios.forEach(usuario => {
        const tr = document.createElement('tr');
        
        const tipoUsuarioBadge = getTipoUsuarioBadge(usuario.tipo_usuario);
        const statusBadge = usuario.status === 'ativo' 
            ? '<span class="badge bg-success">Ativo</span>' 
            : '<span class="badge bg-danger">Inativo</span>';

        const botaoAtivarDesativar = usuario.status === 'ativo'
            ? `<button class="btn btn-sm btn-danger" onclick="deletarUsuario(${usuario.id})" title="Desativar">
                <i class="bi bi-trash"></i>
               </button>`
            : `<button class="btn btn-sm btn-success" onclick="ativarUsuario(${usuario.id})" title="Ativar">
                <i class="bi bi-check-circle"></i>
               </button>`;

        tr.innerHTML = `
            <td>${usuario.id}</td>
            <td>
                <strong>${usuario.nome}</strong>
                ${usuario.registro_profissional ? `<br><small class="text-muted">${usuario.registro_profissional}</small>` : ''}
            </td>
            <td>${usuario.email}</td>
            <td>${tipoUsuarioBadge}</td>
            <td>${statusBadge}</td>
            <td>${usuario.ultimo_login}</td>
            <td>
                <button class="btn btn-sm btn-warning" onclick="editarUsuario(${usuario.id})" title="Editar">
                    <i class="bi bi-pencil"></i>
                </button>
                ${botaoAtivarDesativar}
            </td>
        `;

        tbody.appendChild(tr);
    });
}

// Obter badge do tipo de usuário
function getTipoUsuarioBadge(tipo) {
    const badges = {
        'administrador': '<span class="badge bg-primary">Administrador</span>',
        'biomedico': '<span class="badge bg-success">Biomédico</span>',
        'tecnico': '<span class="badge bg-info">Técnico</span>',
        'recepcao': '<span class="badge bg-secondary">Recepção</span>'
    };
    return badges[tipo] || '<span class="badge bg-secondary">Desconhecido</span>';
}

// Mostrar formulário de cadastro
function mostrarFormularioCadastro() {
    usuarioAtual = null;
    document.getElementById('tituloFormulario').textContent = 'Cadastrar Novo Usuário';
    document.getElementById('formUsuario').reset();
    document.getElementById('senhaContainer').style.display = 'block';
    document.getElementById('senha').required = true;
    document.getElementById('confirmarSenha').required = true;
    
    document.getElementById('tabelaUsuarios').style.display = 'none';
    document.getElementById('acessoRapido').style.display = 'none';
    document.getElementById('formularioUsuario').style.display = 'block';
}

// Editar usuário
function editarUsuario(id) {
    fetch(`UsuarioController.php?acao=buscar&id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.sucesso) {
                usuarioAtual = data.dados;
                preencherFormulario(data.dados);
                
                document.getElementById('tituloFormulario').textContent = `Editar Usuário #${id}`;
                document.getElementById('senhaContainer').style.display = 'block';
                document.getElementById('senha').required = false;
                document.getElementById('confirmarSenha').required = false;
                
                document.getElementById('tabelaUsuarios').style.display = 'none';
                document.getElementById('acessoRapido').style.display = 'none';
                document.getElementById('formularioUsuario').style.display = 'block';
            } else {
                mostrarAlerta('Erro ao carregar usuário', 'danger');
            }
        })
        .catch(error => {
            console.error('Erro ao buscar usuário:', error);
            mostrarAlerta('Erro ao buscar usuário', 'danger');
        });
}

// Preencher formulário com dados do usuário
function preencherFormulario(usuario) {
    document.getElementById('nome').value = usuario.nome || '';
    document.getElementById('nomeSocial').value = usuario.nome_social || '';
    document.getElementById('cpf').value = usuario.cpf || '';
    document.getElementById('dataNascimento').value = usuario.data_nascimento || '';
    document.getElementById('telefone').value = usuario.telefone || '';
    document.getElementById('email').value = usuario.email || '';
    document.getElementById('tipoUsuario').value = usuario.tipo_usuario || '';
    document.getElementById('registroProfissional').value = usuario.registro_profissional || '';
    document.getElementById('permissaoAdmin').checked = usuario.permissao_admin;
}

// Salvar usuário
function salvarUsuario() {
    const formData = new FormData(document.getElementById('formUsuario'));
    
    if (usuarioAtual && usuarioAtual.id) {
        formData.append('id', usuarioAtual.id);
    }
    
    formData.append('acao', 'salvar');

    // Adicionar campos do formulário
    formData.append('nome', document.getElementById('nome').value);
    formData.append('nome_social', document.getElementById('nomeSocial').value);
    formData.append('cpf', document.getElementById('cpf').value);
    formData.append('data_nascimento', document.getElementById('dataNascimento').value);
    formData.append('telefone', document.getElementById('telefone').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('tipo_usuario', document.getElementById('tipoUsuario').value);
    formData.append('registro_profissional', document.getElementById('registroProfissional').value);
    formData.append('senha', document.getElementById('senha').value);
    formData.append('confirmar_senha', document.getElementById('confirmarSenha').value);
    formData.append('permissao_admin', document.getElementById('permissaoAdmin').checked ? '1' : '0');

    fetch('UsuarioController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            mostrarAlerta(data.mensagem, 'success');
            voltarParaTabela();
            carregarUsuarios();
            carregarEstatisticas();
        } else {
            mostrarAlerta(data.mensagem, 'danger');
        }
    })
    .catch(error => {
        console.error('Erro ao salvar usuário:', error);
        mostrarAlerta('Erro ao salvar usuário', 'danger');
    });
}

// Deletar usuário (desativar)
function deletarUsuario(id) {
    if (!confirm('Tem certeza que deseja desativar este usuário?')) {
        return;
    }

    const formData = new FormData();
    formData.append('acao', 'deletar');
    formData.append('id', id);

    fetch('UsuarioController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            mostrarAlerta(data.mensagem, 'success');
            carregarUsuarios();
            carregarEstatisticas();
        } else {
            mostrarAlerta(data.mensagem, 'danger');
        }
    })
    .catch(error => {
        console.error('Erro ao deletar usuário:', error);
        mostrarAlerta('Erro ao deletar usuário', 'danger');
    });
}

// Ativar usuário
function ativarUsuario(id) {
    if (!confirm('Tem certeza que deseja ativar este usuário?')) {
        return;
    }

    const formData = new FormData();
    formData.append('acao', 'ativar');
    formData.append('id', id);

    fetch('UsuarioController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            mostrarAlerta(data.mensagem, 'success');
            carregarUsuarios();
            carregarEstatisticas();
        } else {
            mostrarAlerta(data.mensagem, 'danger');
        }
    })
    .catch(error => {
        console.error('Erro ao ativar usuário:', error);
        mostrarAlerta('Erro ao ativar usuário', 'danger');
    });
}

// Verificar se email já existe
function verificarEmailExistente(email) {
    if (!email) return;

    const id = usuarioAtual ? usuarioAtual.id : null;
    const params = new URLSearchParams({
        acao: 'verificarEmail',
        email: email,
        id: id
    });

    fetch(`UsuarioController.php?${params}`)
        .then(response => response.json())
        .then(data => {
            const emailInput = document.getElementById('email');
            const emailFeedback = document.getElementById('emailFeedback');
            
            if (data.existe) {
                emailInput.classList.add('is-invalid');
                if (!emailFeedback) {
                    const feedback = document.createElement('div');
                    feedback.id = 'emailFeedback';
                    feedback.className = 'invalid-feedback';
                    feedback.textContent = 'Este email já está cadastrado';
                    emailInput.parentNode.appendChild(feedback);
                }
            } else {
                emailInput.classList.remove('is-invalid');
                if (emailFeedback) {
                    emailFeedback.remove();
                }
            }
        })
        .catch(error => console.error('Erro ao verificar email:', error));
}

// Verificar se CPF já existe
function verificarCpfExistente(cpf) {
    if (!cpf) return;

    const id = usuarioAtual ? usuarioAtual.id : null;
    const params = new URLSearchParams({
        acao: 'verificarCpf',
        cpf: cpf,
        id: id
    });

    fetch(`UsuarioController.php?${params}`)
        .then(response => response.json())
        .then(data => {
            const cpfInput = document.getElementById('cpf');
            const cpfFeedback = document.getElementById('cpfFeedback');
            
            if (data.existe) {
                cpfInput.classList.add('is-invalid');
                if (!cpfFeedback) {
                    const feedback = document.createElement('div');
                    feedback.id = 'cpfFeedback';
                    feedback.className = 'invalid-feedback';
                    feedback.textContent = 'Este CPF já está cadastrado';
                    cpfInput.parentNode.appendChild(feedback);
                }
            } else {
                cpfInput.classList.remove('is-invalid');
                if (cpfFeedback) {
                    cpfFeedback.remove();
                }
            }
        })
        .catch(error => console.error('Erro ao verificar CPF:', error));
}

// Voltar para tabela
function voltarParaTabela() {
    document.getElementById('formularioUsuario').style.display = 'none';
    document.getElementById('tabelaUsuarios').style.display = 'block';
    document.getElementById('acessoRapido').style.display = 'flex';
}

// Mostrar alerta
function mostrarAlerta(mensagem, tipo) {
    const alertaDiv = document.createElement('div');
    alertaDiv.className = `alert alert-${tipo} alert-dismissible fade show`;
    alertaDiv.innerHTML = `
        ${mensagem}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.querySelector('.container-fluid').insertBefore(alertaDiv, document.querySelector('.container-fluid').firstChild);
    
    // Auto remover após 5 segundos
    setTimeout(() => {
        alertaDiv.remove();
    }, 5000);
}