<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="row justify-content-center w-100">
        <div class="col-3">
            <h2>Create New Account</h2>
            <div id="errors"></div>
            <form method="POST" autocomplete="off" id="create-account-form">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" required autocomplete="off">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="submit-create-account">Create Account</button>
                    <button type="button" class="btn btn-secondary ms-2" id="back-to-login">Back to Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="./assets/js/services/user.js" type="module"></script>
<script type="module">
    import { createAccount } from "./assets/js/services/user.js";

    document.addEventListener('DOMContentLoaded', () => {
        const createAccountForm = document.querySelector('#create-account-form')
        const submitBtn = document.querySelector('#submit-create-account')
        const backBtn = document.querySelector('#back-to-login')
        const errorElement = document.querySelector('#errors')

        submitBtn.addEventListener('click', async () => {
            if (!createAccountForm.checkValidity()) {
                createAccountForm.reportValidity()
                return false
            }

            const password = createAccountForm.elements['password'].value
            const confirmPassword = createAccountForm.elements['confirm-password'].value

            if (password !== confirmPassword) {
                errorElement.innerHTML = '<div class="alert alert-danger" role="alert">Passwords do not match!</div>'
                return false
            }

            const createResult = await createAccount(
                createAccountForm.elements['username'].value,
                password
            )

            if (createResult.hasOwnProperty('success')) {
                document.location.href = 'index.php?component=login'
            } else if (createResult.hasOwnProperty('errors')) {
                const errors = []
                for (let i = 0; i < createResult.errors.length; i++) {
                    errors.push(`<div class="alert alert-danger" role="alert">${createResult.errors[i]}</div>`)
                }
                errorElement.innerHTML = errors.join('')
            }
        })

        backBtn.addEventListener('click', () => {
            document.location.href = 'index.php?component=login'
        })

    })
</script>