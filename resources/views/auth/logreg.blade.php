<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In or Register</title>

    <style>
        @import url("https://fonts.googleapis.com/css?family=Fira+Sans");

        html,
        body {
            position: relative;
            min-height: 100vh;
            background-color: #E1E8EE;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Fira Sans", Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .form-structor {
            background-color: #222;
            border-radius: 15px;
            height: 550px;
            width: 350px;
            position: relative;
            overflow: hidden;

            &::after {
                content: '';
                opacity: .8;
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-repeat: no-repeat;
                background-position: left bottom;
                background-size: 500px;
                background-image: url('https://images.unsplash.com/photo-1503602642458-232111445657?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=bf884ad570b50659c5fa2dc2cfb20ecf&auto=format&fit=crop&w=1000&q=100');
            }

            .signup {
                position: absolute;
                top: 50%;
                left: 50%;
                -webkit-transform: translate(-50%, -50%);
                width: 65%;
                z-index: 5;
                -webkit-transition: all .3s ease;


                &.slide-up {
                    top: 5%;
                    -webkit-transform: translate(-50%, 0%);
                    -webkit-transition: all .3s ease;
                }

                &.slide-up .form-holder,
                &.slide-up .submit-btn {
                    opacity: 0;
                    visibility: hidden;
                }

                &.slide-up .form-title {
                    font-size: 1em;
                    cursor: pointer;
                }

                &.slide-up .form-title span {
                    margin-right: 5px;
                    opacity: 1;
                    visibility: visible;
                    -webkit-transition: all .3s ease;
                }

                .form-title {
                    color: #fff;
                    font-size: 1.7em;
                    text-align: center;

                    span {
                        color: rgba(0, 0, 0, 0.4);
                        opacity: 0;
                        visibility: hidden;
                        -webkit-transition: all .3s ease;
                    }
                }

                .form-holder {
                    border-radius: 15px;
                    background-color: #fff;
                    overflow: hidden;
                    margin-top: 50px;
                    opacity: 1;
                    visibility: visible;
                    -webkit-transition: all .3s ease;

                    .input {
                        border: 0;
                        outline: none;
                        box-shadow: none;
                        display: block;
                        height: 30px;
                        line-height: 30px;
                        padding: 8px 15px;
                        border-bottom: 1px solid #eee;
                        width: 100%;
                        font-size: 12px;

                        &:last-child {
                            border-bottom: 0;
                        }

                        &::-webkit-input-placeholder {
                            color: rgba(0, 0, 0, 0.4);
                        }
                    }
                }

                .submit-btn {
                    background-color: rgba(0, 0, 0, 0.4);
                    color: rgba(256, 256, 256, 0.7);
                    border: 0;
                    border-radius: 15px;
                    display: block;
                    margin: 15px auto;
                    padding: 15px 45px;
                    width: 100%;
                    font-size: 13px;
                    font-weight: bold;
                    cursor: pointer;
                    opacity: 1;
                    visibility: visible;
                    -webkit-transition: all .3s ease;

                    &:hover {
                        transition: all .3s ease;
                        background-color: rgba(0, 0, 0, 0.8);
                    }
                }
            }

            .login {
                position: absolute;
                top: 20%;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #fff;
                z-index: 5;
                -webkit-transition: all .3s ease;

                &::before {
                    content: '';
                    position: absolute;
                    left: 50%;
                    top: -20px;
                    -webkit-transform: translate(-50%, 0);
                    background-color: #fff;
                    width: 200%;
                    height: 250px;
                    border-radius: 50%;
                    z-index: 4;
                    -webkit-transition: all .3s ease;
                }

                .center {
                    position: absolute;
                    top: calc(50% - 10%);
                    left: 50%;
                    -webkit-transform: translate(-50%, -50%);
                    width: 65%;
                    z-index: 5;
                    -webkit-transition: all .3s ease;

                    .form-title {
                        color: #000;
                        font-size: 1.7em;
                        text-align: center;

                        span {
                            color: rgba(0, 0, 0, 0.4);
                            opacity: 0;
                            visibility: hidden;
                            -webkit-transition: all .3s ease;
                        }
                    }

                    .form-holder {
                        border-radius: 15px;
                        background-color: #fff;
                        border: 1px solid #eee;
                        overflow: hidden;
                        margin-top: 50px;
                        opacity: 1;
                        visibility: visible;
                        -webkit-transition: all .3s ease;

                        .input {
                            border: 0;
                            outline: none;
                            box-shadow: none;
                            display: block;
                            height: 30px;
                            line-height: 30px;
                            padding: 8px 15px;
                            border-bottom: 1px solid #eee;
                            width: 100%;
                            font-size: 12px;

                            &:last-child {
                                border-bottom: 0;
                            }

                            &::-webkit-input-placeholder {
                                color: rgba(0, 0, 0, 0.4);
                            }
                        }
                    }

                    .submit-btn {
                        background-color: #6B92A4;
                        color: rgba(256, 256, 256, 0.7);
                        border: 0;
                        border-radius: 15px;
                        display: block;
                        margin: 15px auto;
                        padding: 15px 45px;
                        width: 100%;
                        font-size: 13px;
                        font-weight: bold;
                        cursor: pointer;
                        opacity: 1;
                        visibility: visible;
                        -webkit-transition: all .3s ease;

                        &:hover {
                            transition: all .3s ease;
                            background-color: rgba(0, 0, 0, 0.8);
                        }
                    }
                }

                &.slide-up {
                    top: 90%;
                    -webkit-transition: all .3s ease;
                }

                &.slide-up .center {
                    top: 10%;
                    -webkit-transform: translate(-50%, 0%);
                    -webkit-transition: all .3s ease;
                }

                &.slide-up .form-holder,
                &.slide-up .submit-btn {
                    opacity: 0;
                    visibility: hidden;
                    -webkit-transition: all .3s ease;
                }

                &.slide-up .form-title {
                    font-size: 1em;
                    margin: 0;
                    padding: 0;
                    cursor: pointer;
                    -webkit-transition: all .3s ease;
                }

                &.slide-up .form-title span {
                    margin-right: 5px;
                    opacity: 1;
                    visibility: visible;
                    -webkit-transition: all .3s ease;
                }
            }
        }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="form-structor">
        {{-- container for sign up register --}}
        <div class="signup">
            <h2 class="form-title" id="signup"><span>or</span>Sign up</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-holder">
                    <input type="text" name="name" class="input" placeholder="Name" />
                    <input type="email" name="email" class="input" placeholder="Email" />
                    <input type="password" name="password" class="input" placeholder="Password" />
                    <input type="password" name="password_confirmation" class="input" placeholder="Confirm Password" />
                </div>
                <button class="submit-btn">Sign up</button>
            </form>
        </div>

        {{-- container for log in --}}
        <div class="login slide-up">
            <div class="center">
                <h2 class="form-title" id="login"><span>or</span>Log in</h2>
                <div class="form-holder">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="email" name="email" class="input" placeholder="Email" />
                        <input type="password" name="password" class="input" placeholder="Password" />
                </div>
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-black-600 dark:text-black-400 hover:text-red-900 dark:hover:text-red-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
                <button class="submit-btn">Log in</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        console.clear();

        const loginBtn = document.getElementById('login');
        const signupBtn = document.getElementById('signup');

        loginBtn.addEventListener('click', (e) => {
            let parent = e.target.parentNode.parentNode;
            Array.from(e.target.parentNode.parentNode.classList).find((element) => {
                if (element !== "slide-up") {
                    parent.classList.add('slide-up')
                } else {
                    signupBtn.parentNode.classList.add('slide-up')
                    parent.classList.remove('slide-up')
                }
            });
        });

        signupBtn.addEventListener('click', (e) => {
            let parent = e.target.parentNode;
            Array.from(e.target.parentNode.classList).find((element) => {
                if (element !== "slide-up") {
                    parent.classList.add('slide-up')
                } else {
                    loginBtn.parentNode.parentNode.classList.add('slide-up')
                    parent.classList.remove('slide-up')
                }
            });
        });
    </script>
</body>

</html>
