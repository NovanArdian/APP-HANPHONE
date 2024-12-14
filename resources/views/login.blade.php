@extends('templates.app') <!-- Mengextends template layout utama -->

@section('content-dinamis')
    <form action="{{ route('login.proses')}}" method="POST" class="card d-block mx-auto my-5 p-5 shadow" 
          style="width: 40%; border-radius: 25px; background: rgba(255, 255, 255, 0.1); 
                 backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2);">
        @csrf

        <!-- Logo Section -->
        <div class="text-center mb-4">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBCLoXV0hqWejgGu2zokIT_oLKeOXRnrxiD_Sx-LRrQsqe5hAGO50UwpVZ6HCeprNT1S4&usqp=CAU" alt="Logo" style="width: 80px; height: auto; margin-bottom: 10px;">
            <img src="https://images.vexels.com/content/139556/preview/android-logo-d2b6bf.png" alt="Logo" style="width: 80px; height: auto; margin-bottom: 10px;">
            <h3 style="color: #2c3e50; font-weight: 600;">Selamat datang </h3>
            <p style="color: #7f8c8d;">Masukan kata sandi untuk masuk</p>
        </div>

        <!-- Alert Messages -->
        @if (Session::get('failed'))
            <div class="alert alert-danger text-center">
                {{ Session::get('failed') }}
            </div>   
        @endif
        @if (Session::get('logout'))
            <div class="alert alert-primary text-center">
                {{ Session::get('logout') }}
            </div>
        @endif

        <!-- Email Field -->
        <div class="form-group mb-4">
            <label for="email" class="form-label" style="color: #34495e;">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" 
                   style="background: rgba(255, 255, 255, 0.121); border: none; border-radius: 15px; padding: 12px; transition: all 0.3s ease;">
            @error('email') 
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="form-group mb-4">
            <label for="password" class="form-label" style="color: #34495e;">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" 
                   style="background: rgba(255, 255, 255, 0.2); border: none; border-radius: 15px; padding: 12px; transition: all 0.3s ease;">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Login Button -->
        <button type="submit" class="btn w-100 py-2" style="border-radius: 15px; font-weight: 600; font-size: 1.1rem; 
                background-color: #3498db; color: #fff; border: none; transition: all 0.3s ease;">LOGIN</button>
    </form>

    <style>
        /* Hover effect for input fields */
        input.form-control:hover, input.form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Hover effect for login button */
        button.btn:hover {
            background-color: #2980b9; /* Darker blue on hover */
            transform: scale(1.02);
        }

        /* Styling for the form label */
        .form-label {
            color: #34495e;
            font-weight: 500;
        }
    </style>
@endsection
