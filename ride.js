// function updateDateTimeLimits() {
//     const now = new Date();  // Get the current date and time
    
//     // Format Date (YYYY-MM-DD)
//     const minDate = now.toISOString().split("T")[0];  
//     document.getElementById("datePicker").min = minDate;

//     // Format Time (HH:MM) - Only applies if today is selected
//     const datePicker = document.getElementById("datePicker");
//     const timePicker = document.getElementById("timePicker");

//     datePicker.addEventListener("change", function() {
//         if (this.value === minDate) { // If today is selected
//             const minTime = now.toTimeString().slice(0, 5); // Get HH:MM format
//             timePicker.min = minTime; // Restrict past times
//         } else {
//             timePicker.min = "00:00"; // Reset min time for future dates
//         }
//     });
// }

// function updateTime() {
//     const now = new Date();
//     const options = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
//     document.getElementById('current-time').innerText = now.toLocaleTimeString([], options);
// }

// document.getElementById('btn').addEventListener('click', function() {
//     const bookingDate = document.getElementById('datePicker').value;
//     const bookingTime = document.getElementById('timePicker').value;
    
//     if (bookingDate && bookingTime) {
//         const bookingDateTime = new Date(`${bookingDate}T${bookingTime}`);
//         document.getElementById('confirmation-message').innerText = `Cab booked for ${bookingDateTime.toLocaleString()}`;
//     } else {
//         document.getElementById('confirmation-message').innerText = 'Please select a booking date and time.';
//     }
// });

// // Initialize the date and time limits
// updateDateTimeLimits();
// setInterval(updateDateTimeLimits, 60000); // Update every minute

// // Update time every second
// setInterval(updateTime, 1000);
// updateTime(); // Initial call to display time immediately
    
function updateDateTimeLimits() {
    const now = new Date();  // Get the current date and time
    
    // Format Date (YYYY-MM-DD)
    const minDate = now.toISOString().split("T")[0];  
    document.getElementById("datePicker").min = minDate;

    // Format Time (HH:MM) - Only applies if today is selected
    const datePicker = document.getElementById("datePicker");
    const timePicker = document.getElementById("timePicker");

    datePicker.addEventListener("change", function() {
        if (this.value === minDate) { // If today is selected
            const minTime = now.toTimeString().slice(0, 5); // Get HH:MM format
            timePicker.min = minTime; // Restrict past times
        } else {
            timePicker.min = "00:00"; // Reset min time for future dates
        }
    });
}

function updateTime() {
    const now = new Date();
    const options = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
    document.getElementById('current-time').innerText = now.toLocaleTimeString([], options);
}

document.getElementById('btn').addEventListener('click', function() {
    const bookingDate = document.getElementById('datePicker').value;
    const bookingTime = document.getElementById('timePicker').value;
    
    if (bookingDate && bookingTime) {
        const bookingDateTime = new Date(`${bookingDate}T${bookingTime}`);
        document.getElementById('confirmation-message').innerText = `Cab booked for ${bookingDateTime.toLocaleString()}`;
    } else {
        document.getElementById('confirmation-message').innerText = 'Please select a booking date and time.';
    }
});

// Initialize the date and time limits
updateDateTimeLimits();
setInterval(updateDateTimeLimits, 60000); // Update every minute

// Update time every second
setInterval(updateTime, 1000);
updateTime(); // Initial call to display time immediately





