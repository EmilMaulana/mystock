<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Profil Saya</h2>

        <!-- Pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Profil Pengguna -->
        <div class="card">
            <div class="card-header">Informasi Profil</div>
            <div class="card-body">
                <!-- Foto Profil -->
                <div class="mb-3">
                    <strong>Foto Profil:</strong><br>
                    @if ($user->profile_photo)
                        <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" alt="Foto Profil" width="150">
                    @else
                        <img src="{{ asset('storage/profile_photos/default.png') }}" alt="Foto Profil Default" width="150">
                    @endif
                </div>

                <p><strong>Nama:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Terverifikasi Email:</strong>
                    {{ $user->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi' }}</p>

                <!-- Tombol Edit Profil -->
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
            </div>
        </div>

        <!-- Form untuk Ubah Password (Collapsed by default) -->
        <div class="collapse" id="changePasswordForm">
            <div class="card mt-3">
                <div class="card-header">Ubah Password</div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('POST')

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Lama</label>
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                required>
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="new_password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan Perubahan Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk collapse (Bootstrap 5) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>