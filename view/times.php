<?php
/**
 * @var array $times
 */
?>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Time Played</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
<!--    --><?php
//        if(isset($_SESSION['is_admin === 1'])) ?>
    <?php if (!empty($times)): ?>
        <?php foreach ($times as $time): ?>
            <tr>
                <td><?= htmlspecialchars($time['game_id']) ?></td>
                <td><?= htmlspecialchars($time['username']) ?></td>
                <td><?= htmlspecialchars($time['duration']) ?></td>
                <td>
                    <form method="post" action="index.php?component=times">
                        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($time['game_id']) ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">No times available</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>