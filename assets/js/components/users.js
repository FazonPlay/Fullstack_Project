import {createAccount, getUsers, updateUser} from "../services/user.js";
import { showToast } from "./shared/toast.js";

export const refreshList = async (page) => {
    const spinner = document.querySelector('#spinner');
    const listElement = document.querySelector('#list-users');

    spinner.classList.remove('d-none');

    const data = await getUsers(page);

    const listContent = [];

    for (let i = 0; i < data.results.length; i++) {
        listContent.push(`<tr>
                        <td>${data.results[i].id}</td>
                        <td>${data.results[i].username}</td>
                        <td>${data.results[i].role === 1 ? 'User' : 'Admin'}</td>
                        <td>
                            <a href="index.php?component=user&id=${data.results[i].id}">
                                <i class="fa fa-edit text-success"></i>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?component=users&action=delete&id=${data.results[i].id}">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>`);
    }


    listElement.querySelector('tbody').innerHTML = listContent.join('');

    document.querySelector('#pagination').innerHTML = getPagination(data.count.total);

    handlePaginationNavigation(page);

    spinner.classList.add('d-none');
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

export const handleUserForm = () => {
    const validBtn = document.querySelector('#valid-form-user');
    let result, message;

    validBtn.addEventListener('click', async (e) => {
        const form = document.querySelector('#user-form');

        if (!form.checkValidity()) {
            form.reportValidity();
            return false;
        }

        if (e.target.name === 'create_button') {
            result = await createAccount(form);
            message = 'The user has been created successfully';
        } else {
            result = await updateUser(form, e.target.getAttribute('data-id'));
            message = 'The user has been updated successfully';
        }

        if (result.hasOwnProperty('success')) {
            showToast(message, 'bg-success');
            if (e.target.name === 'create_button') form.reset();
        } else if (result.hasOwnProperty('error')) {
            showToast(`An error occurred: ${result.error}`, 'bg-danger');
        }
    });
};


