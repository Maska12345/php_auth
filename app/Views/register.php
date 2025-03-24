<?php $title = 'Register'; ?>

<form action="/register" method="POST">
    <h2 class="text-center mb-4">Register</h2>
    <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="first_name" class="form-label">Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="mobile_phone" class="form-label">Mobile phone</label>
        <input type="text" class="form-control" id="mobile_phone" name="mobile_phone" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Create account</button>
        <a href="/login" class="btn btn-link">Already have an account?</a>
    </div>
</form>
