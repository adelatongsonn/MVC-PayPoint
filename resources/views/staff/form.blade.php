<label>Full Name</label>
<input
    type="text"
    name="full_name"
    value="{{ old('full_name', $staff->full_name ?? '') }}"
    required
>

<br><br>

<label>Username</label>
<input
    type="text"
    name="username"
    value="{{ old('username', $staff->username ?? '') }}"
    required
>

<br><br>

<label>Email</label>
<input
    type="email"
    name="email"
    value="{{ old('email', $staff->email ?? '') }}"
    required
>

<br><br>

<label>Password</label>
<input type="password" name="password">

<br><br>

<label>Confirm Password</label>
<input type="password" name="password_confirmation">

<br><br>

<label>Avatar</label>
<input type="file" name="avatar" accept="image/*">

<br><br>