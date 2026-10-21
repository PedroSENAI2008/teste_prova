<?php

if (empty($estoques)) {
    echo "<p>Nenhuma movimentação encontrada!</p>";
    echo "<a href='View/Estoque/cadastrar.php'>Cadastrar</a>";
    return;
}

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><td><a href='View/Estoque/cadastrar.php'>Cadastrar</a></td></tr>";
echo "<tr><th>ID</th><th>Produto</th><th>Usuário</th><th>Ações</th></tr>";

foreach ($estoques as $estoque) {
    $id = $estoque['id'];
    echo "<tr>";
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
