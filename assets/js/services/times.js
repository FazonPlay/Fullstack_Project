export async function loadTimes() {
    try {
        const response = await fetch('index.php?action=getTimes', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        const times = await response.json();

        const tbody = document.querySelector('#times-table');
        tbody.innerHTML = times.map(time => `
            <tr>
                <td>${time.duration.toFixed(2)}</td>
                <td>${new Date(time.created_at).toLocaleString()}</td>
                <td>
                    <button class="btn btn-danger btn-sm delete-time" data-time-id="${time.id}">
                        Delete
                    </button>
                </td>
            </tr>
        `).join('');
    } catch (error) {
        console.error('Error loading times:', error);
    }
}

export async function deleteTime(timeId) {
    try {
        const response = await fetch('index.php?action=deleteTime', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ timeId })
        });
        return await response.json();
    } catch (error) {
        console.error('Error deleting time:', error);
    }
}
