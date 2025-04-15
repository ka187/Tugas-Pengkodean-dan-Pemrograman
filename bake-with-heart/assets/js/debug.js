// Fungsi debugging dengan console.log
function debugFormSubmission(formId, phpFile) {
    const form = document.getElementById(formId);
    form.addEventListener('submit', (e) => {
        const formData = new FormData(form);
        console.log(`Mengirim data ke ${phpFile}:`, [...formData]);
        fetch(phpFile, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(`Respons dari ${phpFile}:`, data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
}

// Aktifkan debugging untuk kedua form
debugFormSubmission('inventoryForm', 'includes/inventory.php');
debugFormSubmission('salesForm', 'includes/sales.php');