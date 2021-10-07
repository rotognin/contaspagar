# Contas a pagar - pessoal

Versão | Data | Andamento 
:-------: | :-------: | :------:
0.1    | 06/10/2021 | Início do desenvolvimento

Sistema para cadastro de pagamento de contas, pessoal.

Organizado por mês, cadastro de contas recorrentes (todos os meses), ou contas únicas (uma ou duas vezes no ano, por exemplo). As contas são cadastradas e, na abertura de um novo mês, são selecionadas aquelas que farão parte do mês (água, luz, telefone, etc...), além de poder incluir outras contas não planejadas.

Fechamento de mês, onde o total gasto irá aparecer no Dashboard. Contas a vencer, vencidas, pagas no dia ou em atraso.

Relatório com diferenças de valores previstos e pagos, evolução nos valores ao longo dos meses, etc.

O projeto ainda está no início. O código está em PHP, banco de dados MySQL.

Para rodar o sistema localmente, rode o script que está na pasta scripts\tabelas.sql, configure o acesso ao banco no arquivo App\Model\Conexao.php e crie um usuário no banco. A senha deverá estar criptografada com a função sha1().