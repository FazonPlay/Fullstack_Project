<?php
/**
 * @var string $action
 * @var array $user
 */
require("_partials/errors.php")
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Create / Edit User</div>
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" <?php echo ('create' === $action) ? 'required' : ''; ?>>
            </div>
            <div class="mb-3">
                <label for="confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmation" name="confirmation" <?php echo ('create' === $action) ? 'required' : ''; ?>>
            </div>
            <div class="mb-3">
                <label for="is_admin" class="form-label">User Type</label>
                <select name="is_admin" id="is_admin" class="form-control" required>
                    <option value="0" <?php echo isset($user['is_admin']) && $user['is_admin'] == 0 ? 'selected' : ''; ?>>User</option>
                    <option value="1" <?php echo isset($user['is_admin']) && $user['is_admin'] == 1 ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            id="enabled"
                            name="enabled"
                        <?php echo (!empty($user['enabled'])) ? 'checked' : ''; ?>
                    >
                    <label class="form-check-label" for="enabled">Active Account</label>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" name="<?php echo $action; ?>_button">Save</button>
            </div>
        </form>
    </div>
</div>
