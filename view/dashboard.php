<table>
    <thead>
    <tr>
        <th>Game</th>
        <th>Duration</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($topTen as $game) : ?>
        <tr>
            <td><?= $game["id"] ?></td>
            <td><?= $game["duration"] ?></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>