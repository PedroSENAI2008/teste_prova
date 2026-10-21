<?php
if (!isset($produtos)) {
    header('Location: ../Usuario/dashboard.php');
    exit();
}
?>
<?php if (empty($produtos)): ?>
    <p>Nenhum produto cadastrado.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Estoque</th>
                <th>Ajustar estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($produto['descricao'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td>R$ <?= number_format((float) $produto['valor'], 2, ',', '.') ?></td>
                    <td><?= (int) $produto['quantidade'] ?></td>
                    <td>
                        <form method="post" action="dashboard.php">
                            <input type="hidden" name="produto_id" value="<?= (int) $produto['id'] ?>">
                            <label>
                                Quantidade:
                                <input type="number" name="quantidade" min="1" step="1" required>
                            </label>
                            <button type="submit" name="tipo" value="entrada">Aumentar</button>
                            <button type="submit" name="tipo" value="saida">Subtrair</button>
                        </form>
                    </td>
                    <td>
                        <a href="../Produtos/editar.php?id=<?= (int) $produto['id'] ?>">Editar</a>
                        <form method="post" action="../Produtos/deletar.php" onsubmit="return confirm('Excluir este produto?');">
                            <input type="hidden" name="id" value="<?= (int) $produto['id'] ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
