export const saveGameTime = async (timeSpent) => {
    const response = await fetch(`index.php?component=game&action=saveTime&time=${timeSpent}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        method: 'GET',
    });
    return response.json();
};