// Function to show the popup with a custom message
function showPopup(popupId, message) {
    const popup = document.getElementById(popupId);
    
    // Find the correct message element based on the popup type
    if (popupId === 'success-popup') {
        document.getElementById('success-message').innerText = message; // Update success message
    } else if (popupId === 'error-popup') {
        document.getElementById('error-message').innerText = message; // Update error message
    }

    // Show the popup
    popup.style.display = "block";

    // Automatically hide after 3 seconds
    setTimeout(() => {
        closePopup(popupId);
    }, 3000);
}

// Function to close the popup
function closePopup(popupId) {
    const popup = document.getElementById(popupId);
    popup.style.display = "none";
}
