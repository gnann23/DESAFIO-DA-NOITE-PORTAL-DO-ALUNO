# Registro de Testes — Portal do Aluno

Ambiente: PHP 8.3 (servidor embutido `php -S`), testes feitos com requisições HTTP reais (curl, com cookie de sessão).
Sintaxe: `php -l` sem erros em todos os arquivos.

| Nº | Ação de teste | Resultado esperado | Resultado obtido |
| --- | --- | --- | --- |
| 1 | Abrir `index.php` | Título, links e rodapé visíveis | **OK** — título, 3 links e rodapé presentes |
| 2 | Nome vazio | Erro de nome obrigatório | **OK** — "O nome é obrigatório." |
| 3 | E-mail `teste` | Erro de e-mail inválido | **OK** — "Informe um e-mail válido." |
| 4 | Idade `0` | Erro de idade inválida | **OK** — "A idade deve ser um número inteiro maior que zero." (idade ausente também cai nesta mensagem) |
| 5 | `Ana Souza`, `ana@senac.br`, `22` | Cadastro exibido no resultado | **OK** — nome, e-mail, idade e mensagem de sucesso |
| 6 | Atualizar `resultado.php` | Dados ficam, mensagem some | **OK** — dados mantidos, sem mensagem |
| 7 | Encerrar sessão e abrir resultado | Sem cadastro | **OK** — "Nenhum aluno cadastrado nesta sessão." |
| 8 | Nome `<h1>Ana</h1>` | Texto literal, sem título HTML | **OK** — saída `&lt;h1&gt;Ana&lt;/h1&gt;` |
| 9 | Dados inválidos após preencher outros campos | Valores preservados | **OK** — nome, e-mail e idade voltam preenchidos |

Testes extras:
- Acesso direto a `processar_cadastro.php` (GET) redireciona para `cadastro.php`: **OK**.
- Recarregar `cadastro.php` após um erro: a mensagem não reaparece: **OK**.

## Perguntas finais

1. **Por que executar certas operações antes do HTML?** `session_start()` e `header()` alteram os cabeçalhos HTTP, que só podem ser enviados antes do corpo da resposta. Qualquer saída antes causa "headers already sent".
2. **Vantagem dos componentes compartilhados?** Evita duplicação, padroniza o visual e permite alterar cabeçalho/rodapé em um só lugar.
3. **Por que os dados persistem após o redirecionamento?** Ficam em `$_SESSION`, no servidor, ligados ao cookie de sessão do navegador, e não à requisição.
4. **Como a mensagem aparece só uma vez?** É lida e removida com `unset($_SESSION["mensagem"])` na mesma execução (flash message); os dados do aluno ficam em outra chave.
5. **`unset` de uma chave vs. encerrar a sessão?** `unset` remove apenas aquela informação e a sessão continua ativa. `session_unset()` + `session_destroy()` apagam tudo e destroem a sessão no servidor.
6. **Por que não confiar no formulário?** O cliente pode enviar qualquer coisa (campos vazios, tipos errados, HTML/JS malicioso). Por isso validamos no servidor e escapamos na exibição com `htmlspecialchars`.
7. **Por que `require_once` em funções?** Evita carregar o arquivo duas vezes, o que causaria erro de função já declarada.
8. **E se faltar `exit` após `header()`?** O script continuaria executando (gravando na sessão, enviando saída) mesmo após o redirecionamento.
