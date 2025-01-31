import {getTimes, removeTime} from "../services/time.js";
import { showToast } from "./shared/toast.js";

export const refreshList = async (page) => {
    const spinner = document.querySelector('#spinner');
    const listElement = document.querySelector('#list-users');

    spinner.classList.remove('d-none');

    const data = await getTimes(page);

    const listContent = [];

    for (let i = 0; i < data.results.length; i++) {
        listContent.push(`<tr>
                        <td>${data.results[i].id}</td>
                        <td>${data.results[i].username}</td>
                        <td>${data.results[i].is_admin === 0 ? 'User' : 'Admin'}</td>
                        <td>
                            <a href="index.php?component=times&id=${data.results[i].id}">
                                <i class="fa fa-edit text-success"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="delete-time" data-id="${data.results[i].id}">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>`);
    }


    listElement.querySelector('tbody').innerHTML = listContent.join('');

    document.querySelector('#pagination').innerHTML = getPagination(data.count.total);

    handlePaginationNavigation(page);

    spinner.classList.add('d-none');

    setupDeleteButtons();
};


const setupDeleteButtons = () => {
    document.querySelectorAll(".delete-user").forEach(button => {
        button.addEventListener("click", async (e) => {
            e.preventDefault();
            const userId = e.target.closest("a").dataset.id;

            if (!confirm("Are you sure you want to delete this user?")) return;

            const result = await removeTime(userId);
            if (result.success) {
                showToast("User deleted successfully!");
                await refreshList(1);
            } else {
                showToast("Failed to delete user.");
            }
        });
    });
};
const getPagination = (total) => {
    const countPages = Math.ceil(total / 20);
    let paginationButton = [];
    paginationButton.push(` <li class="page-item"><a class="page-link" href="#" id="previous-link">Previous</a></li>`);

    for (let i = 1; i <= countPages; i++) {
        paginationButton.push(`<li class="page-item"><a data-page="${i}" class="page-link pagination-btn" href="#">${i}</a></li>`);
    }

    paginationButton.push(` <li class="page-item"><a class="page-link" href="#" id="next-link">Next</a></li>`);

    return paginationButton.join('');
};

const handlePaginationNavigation = (page) => {
    const previousLink = document.querySelector('#previous-link');
    const nextLink = document.querySelector('#next-link');
    const paginationBtns = document.querySelectorAll('.pagination-btn');

    previousLink.addEventListener('click', async () => {
        if (page > 1) {
            page--;
            await refreshList(page);

        }
    });

    for (let i = 0; i < paginationBtns.length; i++) {
        paginationBtns[i].addEventListener('click', async (e) => {
            const pageNumber = e.target.getAttribute('data-page');
            await refreshList(pageNumber);
        });
    }

    nextLink.addEventListener('click', async () => {
        page++;
        await refreshList(page);
    });
};



