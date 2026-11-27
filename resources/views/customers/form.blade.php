<label>Full Name</label>
<input
    type="text"
    name="full_name"
    value="{{ old('full_name', $customer->full_name ?? '') }}"
    required
>

<br><br>

<label>Email</label>
<input
    type="email"
    name="email"
    value="{{ old('email', $customer->email ?? '') }}"
    required
>

<br><br>

<label>Phone</label>
<input
    type="text"
    name="phone"
    value="{{ old('phone', $customer->phone ?? '') }}"
>

<br><br>