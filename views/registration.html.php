        <form class="auth" action="">
            <fieldset>
                <legend>Registration</legend>
                <div class="auth__row">
                    <label for="username">User name</label>
                    <input class="auth__text" type="text" id="username">
                    <i class="auth__error auth__error_hide">Don't contain ({}, $, 0-9, length > 5 characters)</i>
                </div>
                <div class="auth__row">
                    <label for="useremail">User email</label>
                    <input class="auth__text" type="text" id="useremail">
                    <i class="auth__error auth__error_hide">Not valid email (example@gmail.com)</i>
                </div>
                <div class="auth__row">
                    <button type="button" id="regbtn" class="auth__btn">Registration</button>
                </div>
            </fieldset>
        </form>
        <script src="registration.js"></script>