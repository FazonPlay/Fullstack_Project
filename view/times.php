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
    <?php foreach ($times as $time): ?>
        <tr>
            <td><?= $time['id'] ?></td>
            <td><?= htmlspecialchars($time['username']) ?></td>
            <td><?= $time['time_played'] ?></td>
            <td>
                <form method="post" action="index.php?component=times">
                    <input type="hidden" name="delete_id" value="<?= $time['id'] ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
