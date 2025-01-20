<?php
/**
 * @var array $users
 * @var bool $is_admin
 */
?>

<table class="table">
    <thead>
    <tr>
        <?php if ($is_admin): ?>
            <th>ID</th>
        <?php endif; ?>
        <th>Username</th>
        <?php if ($is_admin): ?>
            <th>Actions</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <?php if ($is_admin): ?>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                <?php endif; ?>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <?php if ($is_admin): ?>
                    <td>
                        <form method="post" action="index.php?component=users">
                            <input type="hidden" name="delete_id" value="<?= htmlspecialchars($user['id']) ?>">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="index.php?component=users&action=edit&id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="<?= $is_admin ? 3 : 2 ?>">No users available</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
