<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h4>Profil</h4>
        </div>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <x-input name="name" label="Nama" type="text" value="{{ old('name', $data->name) }}" />
                    </div>
                    <div class="col-12 col-lg-6">
                        <x-input name="email" label="Email" type="email"
                            value="{{ old('email', $data->email) }}" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h6>Update Password</h6>
                        <hr>
                    </div>
                    <div class="col-12">
                        <x-input name="old_password" label="Password Lama" type="password"
                            value="{{ old('old_password') }}" />

                        <x-input name="new_password" label="Password Baru" type="password"
                            value="{{ old('new_password') }}" />

                        <x-input name="new_password_confirmation" label="Konfirmasi Password Baru" type="password"
                            value="{{ old('new_password_confirmation') }}" />
                    </div>
                </div>
            </div>

            <div class="card-footer bg-whitesmoke">
                <x-button-primary>
                    Edit
                </x-button-primary>
            </div>
        </form>
    </div>
</x-app-layout>
