export const removeTime = async (id) => {
    const response = await fetch(`index.php?component=users&action=delete&id=${id}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        method: 'GET'
    })
    return await response.json()
}

export const getTimes = async (currentPage = 1) => {
    const response = await fetch(`index.php?component=times&page=${currentPage}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    return await response.json()
}