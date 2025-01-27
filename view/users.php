<?php
/**
 * @var array $persons
 */
require("_partials/errors.php")
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">
            All users
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="spinner-border text-primary d-none" role="status" id="spinner">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 d-flex justify-content-end">
                <a href="index.php?component=user" type="button" class="btn btn-primary" ><i class="fa fa-plus me-2"></i>Add User</a>
            </div>
        </div>
        <table class="table" id="list-users">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <!-- Example of user rows dynamically added via JavaScript -->
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center" id="pagination">
            <!-- Pagination links dynamically created via JavaScript -->
        </ul>
    </nav>
</div>

<script src="./assets/js/services/user.js" type="module"></script>
<script src="./assets/js/components/users.js" type="module"></script>
<script type="module">
    import { refreshList } from './assets/js/components/users.js';
    import { removeUser } from './assets/js/services/user.js';

    document.addEventListener('DOMContentLoaded', async () => {
        const previousLink = document.querySelector('#previous-link');
        const nextLink = document.querySelector('#next-link');
        let currentPage = 1;

        refreshList(currentPage);

        previousLink.addEventListener('click', async () => {
            if (currentPage > 1) {
                currentPage--;
                await refreshList(currentPage);
            }
        });

        nextLink.addEventListener('click', async () => {
            currentPage++;
            await refreshList(currentPage);
        });

        // Event listener for remove user button click
        document.querySelector('#list-users').addEventListener('click', async (e) => {
            if (e.target && e.target.classList.contains('remove-user')) {
                const userId = e.target.getAttribute('data-id');
                const confirmation = confirm('Are you sure you want to delete this user?');
                if (confirmation) {
                    await removeUser(userId);
                    refreshList(currentPage); // Re-fetch and display the list after deletion
                }
            }
        });
    });
</script>
