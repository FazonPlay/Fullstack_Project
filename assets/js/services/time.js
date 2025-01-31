

export const getTimes = async (currentPage = 1) => {
    const response = await fetch(`index.php?component=times&page=${currentPage}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    return await response.json()
}



export const removeTime = async (id) => {
    const response = await fetch("index.php?component=times", {
        method: "POST",
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        },
        body: new URLSearchParams({ action: "delete", id })
    });

    return await response.json();
};