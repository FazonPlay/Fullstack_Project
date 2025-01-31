<?php
/**
 * @var array $times
 * @var bool $is_admin
 */
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">
            All Times
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="spinner-border text-primary d-none" role="status" id="spinner">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <table class="table" id="list-times">
            <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Time Played</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center" id="pagination">

        </ul>
    </nav>
</div>

<script src="./assets/js/services/time.js" type="module"></script>
<script type="module">
    import { refreshList } from './assets/js/components/times.js';
    import { removeTime } from './assets/js/services/time.js';

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
    });
</script>













