<?php $title = 'Login'; ?>

<form action="/login" method="POST">
    <h2 class="text-center mb-4">Login</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Sign in</button>
        <a href="/register" class="btn btn-link">Create new account</a>
    </div>
</form>
