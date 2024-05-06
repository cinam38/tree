
function setRole(role) {
            // Log to the console which role was clicked
            console.log("Role selected:", role);

            // Set the value of the hidden input field
            document.getElementById('role').value = role;

            // Optional: Display an alert or update some text on the page to show the role selected
            document.getElementById('roleDisplay').textContent = 'Selected role: ' + role;
        }

// script.js
function showInfo(teamMember) {
    const info = teamMember.querySelector('.team-info');
    info.style.display = (info.style.display === 'block') ? 'none' : 'block';
}
