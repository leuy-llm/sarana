<!-- Bootstrap Registration Modal -->
<style>
    .close {
        color: white !important;
        opacity: 1 !important;
        text-shadow: none !important;
        border: none !important;
        outline: none !important;
        font-bold: 900 !important;
        font-family: "Coda", system-ui;

    }

    .modal-content h3 {
        font-family: "Coda", system-ui;
    }

    .form-control:focus {
        border-color: #a38354;
        box-shadow: none;
    }

    .modal-body .bottom {
        margin-bottom: -0.5rem;
    }
    .btn{
        font-family: "Coda", system-ui;
        }
        .invalid-feedback{
            margin-top: -1rem;
            margin-bottom: 1rem;
        }
        .form-row{
            font-family: "Coda", system-ui;
            display: flex;
            justify-content: space-between
        }
</style>
<div class="modal fade custom-modal @if ($errors->any()) show @endif" id="registerModal"
    tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"
    @if ($errors->any()) style="display: block" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center" style="background:#661f1f; text-align: center">
                <h3 class="modal-title text-white text-center" id="registerModalLabel">Sinaka Registration</h3>
                <button type="button" class=" border-0 close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Registration Form -->
                <form id="guestRegisterForm" method="POST" action="{{ route('guest.register') }}">
                    @csrf
                    <div class="bottom">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" value="{{old('name')}}" class="form-control id="name"
                            name="name" required>
                    </div>
                    <div class="bottom" >
                        <label for="email" class="form-label">Email</label>
                        <input type="email"  class="form-control @error('email') is-invalid @enderror " id="email"
                            name="email" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="bottom" >
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="number"  class="form-control @error('mobile') is-invalid @enderror " id="mobile"
                            name="mobile" required>
                        @error('mobile')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="bottom">
                        <label for="address" style="" class="form-label">Address</label>
                        <input type="text" value="{{old('address')}}" class="form-control @error('address') is-invalid @enderror "
                            id="address" name="address">
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="bottom">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" name="password" required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="bottom">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password"  class="form-control  @error('password_confirmation') is-invalid @enderror " id="password_confirmation"
                            name="password_confirmation" required>
                            @error('password_confirmation')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal" >Do you already have an account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('auth.logins')
<script>
    // JavaScript to trigger modal reopening when there are validation errors
    @if ($errors->any())
        $(document).ready(function() {
            $('#registerModal').modal('show');
        });
    @endif
</script>
