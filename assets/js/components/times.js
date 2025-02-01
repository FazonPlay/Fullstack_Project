import {getTimes, removeTime} from "../services/time.js";
import { showToast } from "./shared/toast.js";

export const refreshList = async (page) => {
    const spinner = document.querySelector('#spinner');
    const listElement = document.querySelector('#list-times');

    spinner.classList.remove('d-none');

    const data = await getTimes(page);

    const listContent = data.results.map(time => `
        <tr>
            <td>${time.game_id}</td>
            <td>${time.username}</td>
            <td>${time.duration} seconds</td>
            <td>
                <a href="#" class="delete-time" data-id="${time.game_id}">
                    <i class="fa fa-trash text-danger"></i>
                </a>
            </td>
        </tr>
    `).join('');

    listElement.querySelector('tbody').innerHTML = listContent;

    document.querySelector('#pagination').innerHTML = getPagination(data.total);

    handlePaginationNavigation(page);

    spinner.classList.add('d-none');

    setupDeleteButtons();
};



const setupDeleteButtons = () => {
    document.querySelectorAll(".delete-time").forEach(button => {
        button.addEventListener("click", async (e) => {
            e.preventDefault();
            const timeId = e.target.closest("a").dataset.id;

            if (!confirm("Are you sure you want to delete this time?")) return;

            const result = await removeTime(timeId);
            if (result.success) {
                showToast("Time deleted successfully!");
                await refreshList(1);
            } else {
                showToast("Failed to delete time.");
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
    if (page === 1) {
        previousLink.classList.add('disabled');
    } else {
        previousLink.classList.remove('disabled');
    }

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



