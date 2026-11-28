<div class="prod-field mb-3">
    <label for="full_name" class="prod-label">
        <i class="bi bi-person me-1"></i>
        Full Name
    </label>

    <input
        id="full_name"
        type="text"
        name="full_name"
        class="form-control prod-input @error('full_name') is-invalid @enderror"
        value="{{ old('full_name', $staff->full_name ?? '') }}"
        placeholder="e.g. Juan Dela Cruz"
        maxlength="100"
        autocomplete="name"
        required
    >

    @error('full_name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="prod-field mb-3">
    <label for="username" class="prod-label">
        <i class="bi bi-person-badge me-1"></i>
        Username
    </label>

    <input
        id="username"
        type="text"
        name="username"
        class="form-control prod-input @error('username') is-invalid @enderror"
        value="{{ old('username', $staff->username ?? '') }}"
        placeholder="e.g. juan.staff"
        maxlength="50"
        autocomplete="username"
        required
    >

    @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="prod-field mb-3">
    <label for="email" class="prod-label">
        <i class="bi bi-envelope me-1"></i>
        Email
    </label>

    <input
        id="email"
        type="email"
        name="email"
        class="form-control prod-input @error('email') is-invalid @enderror"
        value="{{ old('email', $staff->email ?? '') }}"
        placeholder="e.g. juan@example.com"
        maxlength="100"
        autocomplete="email"
        required
    >

    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="prod-field mb-3">
    <label for="password" class="prod-label">
        <i class="bi bi-lock me-1"></i>
        Password

        @if (isset($staff))
            <span class="prod-label-optional">optional</span>
        @endif
    </label>

    <input
        id="password"
        type="password"
        name="password"
        class="form-control prod-input @error('password') is-invalid @enderror"
        placeholder="{{ isset($staff) ? 'Leave blank to keep current password' : 'Enter a password' }}"
        autocomplete="new-password"
        @if (!isset($staff)) required @endif
    >

    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="prod-field mb-3">
    <label for="password_confirmation" class="prod-label">
        <i class="bi bi-lock-fill me-1"></i>
        Confirm Password

        @if (isset($staff))
            <span class="prod-label-optional">optional</span>
        @endif
    </label>

    <input
        id="password_confirmation"
        type="password"
        name="password_confirmation"
        class="form-control prod-input"
        placeholder="Re-enter the password"
        autocomplete="new-password"
        @if (!isset($staff)) required @endif
    >
</div>

<div class="prod-field mb-1">
    <label for="avatar" class="prod-label">
        <i class="bi bi-image me-1"></i>
        Avatar
        <span class="prod-label-optional">optional</span>
    </label>

    <input
        id="avatar"
        type="file"
        name="avatar"
        class="form-control prod-input @error('avatar') is-invalid @enderror"
        accept="image/*"
    >

    <div class="prod-hint">
        Optional. Use a JPG, PNG, or other image file up to 2 MB.
    </div>

    @error('avatar')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>