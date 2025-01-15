export const createAccount = async (username, password) => {
    const formData = new URLSearchParams();
    formData.append('username', username);
    formData.append('password', password);
    formData.append('action', 'create');

    const response = await fetch('index.php?component=user', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        method: 'POST',
        body: formData
    });
    return await response.json();
};

