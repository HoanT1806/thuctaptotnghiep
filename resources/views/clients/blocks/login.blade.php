<div class="aside aside_right overflow-hidden customer-forms" id="customerForms">
    <div class="customer-forms__wrapper d-flex position-relative">
        <div class="customer__login">
            <div class="aside-header d-flex align-items-center">
                <h3 class="text-uppercase fs-6 mb-0">Login</h3>
                <button class="btn-close-lg js-close-aside ms-auto"></button>
            </div><!-- /.aside-header -->

            <form action="https://uomo-html.flexkitux.com/Demo10/login_register.html"  method="POST"
                class="aside-content aside-form_login">
                @csrf
                <div class="form-floating mb-3">
                    <input name="email" type="email" class="form-control form-control_gray"
                        id="customerNameEmailInput" placeholder="name@example.com">
                    <label for="customerNameEmailInput">Username or email address *</label>
                    <p class="message text-danger"></p>
                </div>

                <div class="pb-3"></div>

                <div class="form-label-fixed mb-3">
                    <label for="customerPasswordInput" class="form-label">Password *</label>
                    <input name="password" id="customerPasswordInput" class="form-control form-control_gray"
                        type="password" placeholder="********">
                    <p class="message text-danger"></p>
                </div>

                <div class="d-flex align-items-center mb-3 pb-2">
                    <div class="form-check mb-0">
                        <input name="remember" class="form-check-input form-check-input_fill" type="checkbox"
                            value="" id="flexCheckDefault">
                        <label class="form-check-label text-secondary" for="flexCheckDefault">Remember me</label>
                    </div>
                    <a href="reset_password.html" class="btn-text ms-auto">Lost password?</a>
                </div>

               <a href=""><button class="btn btn-primary w-100 text-uppercase" type="submit">Log In</button></a> 

                <div class="customer-option mt-4 text-center">
                    <span class="text-secondary">No account yet?</span>
                    <a href="#" class="btn-text js-show-register">Create Account</a>
                </div>
            </form>
        </div><!-- /.customer__login -->

        <div class="customer__register">
         
            <div class="aside-header d-flex align-items-center">
                <h3 class="text-uppercase fs-6 mb-0">Create an account</h3>
                <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
            </div><!-- /.aside-header -->

            <form action="" class="aside-content aside-form_register" method="POST">
                @csrf
                <div class="form-floating mb-4">
                    <input name="ho_ten" type="text" class="form-control form-control_gray"
                        id="registerUserNameInput" placeholder="Username">
                    <label for="registerUserNameInput">Username</label>
                    <p class="text-danger message"></p>
                </div>

                <div class="pb-1"></div>

                <div class="form-floating mb-4">
                    <input name="email" type="email" class="form-control form-control_gray"
                        id="registerUserEmailInput" placeholder="user@company.com">
                    <label for="registerUserEmailInput">Email address *</label>
                    <p class="text-danger message"></p>
                </div>

                <div class="pb-1"></div>

                <div class="form-label-fixed mb-4">
                    <label for="registerPasswordInput" class="form-label">Password *</label>
                    <input name="mat_khau" id="registerPasswordInput" class="form-control form-control_gray"
                        type="password" placeholder="*******">
                        <p class="text-danger message"></p>
                </div>

                <p class="text-secondary mb-4">Your personal data will be used to support your experience throughout
                    this website, to manage access to your account, and for other purposes described in our privacy
                    policy.</p>

                <button class="btn btn-primary w-100 text-uppercase" type="submit">Register</button>

                <div class="customer-option mt-4 text-center">
                    <span class="text-secondary">Already have account?</span>
                    <a href="#" class="btn-text js-show-login">Login</a>
                </div>
            </form>
        </div><!-- /.customer__register -->
    </div><!-- /.customer-forms__wrapper -->
</div><!-- /.aside aside_right -->
<script>
    $(document).ready(function() {
        const formLogin = document.querySelector('.aside-form_login');
        formLogin.onsubmit = function() {
            event.preventDefault();
            const data = {

            }
           
            const inputs = formLogin.querySelectorAll("input");
            inputs.forEach(function(input) {
                data[input.name] = input.value;

            })
            $.ajax({
                url: "{{ route('client.login') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                  if(Object.keys(response)[0] == 'success'){
                    swal({
                        title: response.success,
                        text: "Vui lòng nhấn tiếp tục",
                        icon: "success",
                        button: "Tiếp tục!",
                    })
                    .then(function(res){
                      window.location.reload()
                    });
                  }
                    

                },
                error: function(error) {
                    const errors = error.responseJSON.errors
                    console.log(Object.keys(errors));
                    Object.keys(errors).forEach(function(key) {
                        const p = formLogin.querySelector(`input[name="${key}"]`)
                            .parentElement.querySelector(".message");
                        p.innerText = errors[key];
                    })
                }
            })
        }
        const formRegister = document.querySelector('.aside-form_register');
        formRegister.onsubmit = function() {
            event.preventDefault();
            const data = {

            }
            const inputs = formRegister.querySelectorAll("input");
            inputs.forEach(function(input) {
                data[input.name] = input.value;
    
            });
            console.log(data);
            $.ajax({
                url: "{{ route('client.register') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                  if(Object.keys(response)[0] == 'success'){
                    swal({
                        title: response.success,
                        text: "Vui lòng nhấn tiếp tục",
                        icon: "success",
                        button: "Tiếp tục!",
                    })
                    .then(function(res){
                        const aside_form = document.querySelector('.customer-forms__wrapper');
                        aside_form.style.left = "0";
                    });
                  }
                },
                error: function(error) {
                    const errors = error.responseJSON.errors
                    console.log(Object.keys(errors));
                    Object.keys(errors).forEach(function(key) {
                        const p = formRegister.querySelector(`input[name="${key}"]`)
                            .parentElement.querySelector(".message");

                        p.innerText = errors[key];
                    })
                }
            })
        }
    })
</script>
