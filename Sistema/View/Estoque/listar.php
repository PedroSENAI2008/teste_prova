<?php

if (empty($estoques)) {
    echo "<p>Nenhuma movimentação encontrada!</p>";
    echo "<a href='View/Estoque/cadastrar.php'>Cadastrar</a>";
    return;
}

echo "<label for='pesquisa'>Pesquisar:</label>";
echo "<input type='search' id='pesquisa' oninput='filtrarTabela()' placeholder='Digite para pesquisar...'>";
echo "<table id='tabelaEstoque' border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><td><a href='View/Estoque/cadastrar.php'>Cadastrar</a></td></tr>";
echo "<tr><th>ID</th><th>Produto</th><th>Usuário</th><th>Ações</th></tr>";

foreach ($estoques as $estoque) {
    $id = $estoque['id'];
    echo "<tr class='linha-estoque'>";
    echo "<td>{$id}</td>";
    echo "<td>" . htmlspecialchars($estoque['produto_nome'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($estoque['usuario_nome'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>
                <a href='View/Estoque/editar.php?id={$id}'>Editar</a> |
                <a href='View/Estoque/deletar.php?id={$id}' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?')\">Deletar</a>
            </td>";
    echo "</tr>";
}
echo "</table>";
?>
<script>
function filtrarTabela() {
    const termo = document.getElementById('pesquisa').value
        .trim()
        .toLocaleLowerCase('pt-BR');

    document.querySelectorAll('#tabelaEstoque .linha-estoque').forEach((linha) => {
        const texto = linha.textContent.toLocaleLowerCase('pt-BR');
        linha.hidden = !texto.includes(termo);
    });
}
</script>
