<?php
/**
 * @var array $times
 * @var bool $is_admin
 */
?>

<table class="table">
    <thead>
    <tr>
        <?php if ($is_admin): ?>
            <th>ID</th>
        <?php endif; ?>
        <th>User</th>
        <th>Time Played</th>
        <?php if ($is_admin): ?>
            <th>Actions</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($times)): ?>
        <?php foreach ($times as $time): ?>
            <tr>
                <?php if ($is_admin): ?>
                    <td><?= htmlspecialchars($time['game_id']) ?></td>
                <?php endif; ?>
                <td><?= htmlspecialchars($time['username']) ?></td>
                <td><?= htmlspecialchars($time['duration']) ?></td>
                <?php if ($is_admin): ?>
                    <td>
                        <form method="post" action="index.php?component=times">
                            <input type="hidden" name="delete_id" value="<?= htmlspecialchars($time['game_id']) ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="<?= $is_admin ? 4 : 3 ?>">No times available</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
