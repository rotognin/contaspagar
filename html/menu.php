    <div class="w3-container">
        <h3><b>Painel Administrativo</b> - <?php echo $_SESSION['usuNome']; ?> - <a class="w3-button w3-small w3-light-grey" href="principal.php?action=logout">Sair</a></h3>
        <p>
            <h4>Cadastros</h4>
            <a class="w3-button w3-blue" href="principal.php?action=formasPagamento">Formas de Pagamento</a>
            <a class="w3-button w3-blue" href="principal.php?action=tiposFornecedor">Tipos de Fornecedores</a>
            <a class="w3-button w3-blue" href="principal.php?action=fornecedores">Fornecedores</a>
            <a class="w3-button w3-blue" href="principal.php?action=contas">Contas</a>
        </p>
        <p>
            <h4>Movimentações</h4>
            <a class="w3-button w3-blue" href="principal.php?action=pagamentos">Pagamentos</a>
            <a class="w3-button w3-blue" href="principal.php?action=fecharMes">Fechamento Mensal</a>
            <a class="w3-button w3-blue" href="principal.php?action=abrirMes">Abertura Mensal</a>
        </p>
        <p>
            <h4>Relatórios</h4>
            <a class="w3-button w3-blue" href="principal.php?action=relatorioMensal">Mensal</a>
            <a class="w3-button w3-blue" href="principal.php?action=relatorioFornecedor">Por Fornecedor</a>
            <a class="w3-button w3-blue" href="principal.php?action=relatorioPeriodo">Por Período</a>
        </p>
        <br><br>
    </div>