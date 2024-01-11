document.addEventListener('DOMContentLoaded', function() {
    var userDropdown = document.getElementById('userDropdown');
    var dropdownContent = document.getElementById('dropdownContent');

    // Toggle the visibility of the dropdown content
    userDropdown.addEventListener('click', function() {
        dropdownContent.classList.toggle('show');
    });

       // Close the dropdown if the user clicks outside of it
       window.addEventListener('click', function(event) {
        if (!event.target.matches('.dropbtn')) {
            if (dropdownContent.classList.contains('show')) {
                dropdownContent.classList.remove('show');
            }
        }
    });
});