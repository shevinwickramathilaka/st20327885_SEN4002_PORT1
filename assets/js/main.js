
// Explore LK – Main JS



document.addEventListener('DOMContentLoaded', function() {

    // Simple confirmation for admin actions
    const confirmLinks = document.querySelectorAll('.confirm-action');
    confirmLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if(!confirm('Are you sure you want to perform this action?')) {
                e.preventDefault();
            }
        });
    });

    // Example: Simple form validation
    const bookingForm = document.getElementById('bookingForm');
    if(bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            const travelers = document.getElementById('travelers').value;
            if(travelers < 1) {
                alert('Number of travelers must be at least 1.');
                e.preventDefault();
            }
        });
    }

});
