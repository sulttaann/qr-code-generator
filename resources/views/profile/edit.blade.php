<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">
            <i class="bi bi-person-gear text-success me-2"></i>Edit Profil
        </h1>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-7">

            <!-- Update Info -->
            <div class="card mb-3">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="card mb-3">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Hapus Akun -->
            <div class="card border-danger">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
