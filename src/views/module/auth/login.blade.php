<x-starterkit-blank-layout :title="$page_title">
    <div class="auth-screen">
        <div class="container">
            <div class="auth-wrapper">
                <div class="auth-inner">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('admin.post-login')}}" method="post">
                                @csrf
                                <div class="app-logo text-center">
                                    <img src="{{asset(s_config('app_logo'))}}" alt="">
                                </div>
                                @if(session('auth_message'))
                                <div class="alert alert-dismissible fade show alert-login alert-warning" role="alert">
                                    {{session('auth_message')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <h4 class="welcome">Welcome To {{s_config('app_name')}}</h4>
                                <p class="intro">Please sign-in to your account and start the adventure</p>
                                <div class="mb-3 fv-plugins-icon-container mt-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" autofocus="">
                                </div>
                                <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" class="form-control" name="password"
                                            placeholder="············" aria-describedby="password">
                                </div>
                                <div class="mb-3 mt-4">
                                    <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-starterkit-blank-layout>
