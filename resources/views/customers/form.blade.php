<div class="prod-field mb-4">
    <label for="customer_code" class="prod-label">
        <i class="bi bi-person-badge me-1" aria-hidden="true"></i> Customer ID
    </label>
    <input
        id="customer_code"
        type="text"
        class="form-control prod-input"
        value="{{ isset($customer) ? $customer->customer_code : 'Assigned automatically when saved' }}"
        aria-describedby="customer_code-hint"
        readonly
    >
    <div id="customer_code-hint" class="prod-hint">Unique to each customer and stays the same when their details change.</div>
</div>
<div class="prod-field mb-4">
    <label for="full_name" class="prod-label">
        <i class="bi bi-person me-1" aria-hidden="true"></i> Full Name
    </label>
    <input
        id="full_name"
        type="text"
        name="full_name"
        class="form-control prod-input @error('full_name') is-invalid @enderror"
        value="{{ old('full_name', $customer->full_name ?? '') }}"
        placeholder="e.g. Juan Dela Cruz"
        maxlength="100"
        autocomplete="name"
        @error('full_name') aria-invalid="true" aria-describedby="full_name-error" @enderror
        required
    >
    @error('full_name')
        <div id="full_name-error" class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="prod-field mb-4">
    <label for="email" class="prod-label">
        <i class="bi bi-envelope me-1" aria-hidden="true"></i> Email
    </label>
    <input
        id="email"
        type="email"
        name="email"
        class="form-control prod-input @error('email') is-invalid @enderror"
        value="{{ old('email', $customer->email ?? '') }}"
        placeholder="e.g. juan@example.com"
        maxlength="100"
        autocomplete="email"
        @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
        required
    >
    @error('email')
        <div id="email-error" class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="prod-field mb-1">
    <label for="phone" class="prod-label">
        <i class="bi bi-telephone me-1" aria-hidden="true"></i> Phone
        <span class="prod-label-optional">optional</span>
    </label>
    <input
        id="phone"
        type="tel"
        name="phone"
        class="form-control prod-input @error('phone') is-invalid @enderror"
        value="{{ old('phone', $customer->phone ?? '') }}"
        placeholder="e.g. 0917 123 4567"
        maxlength="20"
        autocomplete="tel"
        @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror
    >
    @error('phone')
        <div id="phone-error" class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
