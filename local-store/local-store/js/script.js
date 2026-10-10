// Client-side Form Validation for Registration and Contact Forms
document.addEventListener("DOMContentLoaded", function() {
    
    // Register Form Validation
    const regForm = document.querySelector(".form-container form");
    if (regForm && regForm.action.includes("register.php")) {
        regForm.addEventListener("submit", function(e) {
            const username = regForm.querySelector("input[name='username']").value.trim();
            const email = regForm.querySelector("input[name='email']").value.trim();
            const password = regForm.querySelector("input[name='password']").value;

            if (username.length < 3) {
                alert("Username must be at least 3 characters long.");
                e.preventDefault();
                return;
            }

            if (!email.includes("@") || !email.includes(".")) {
                alert("Please enter a valid email address.");
                e.preventDefault();
                return;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                e.preventDefault();
                return;
            }
        });
    }
});