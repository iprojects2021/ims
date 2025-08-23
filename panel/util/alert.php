<?php if (isset($showAlert)): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if ($showAlert === 'success'): ?>
            Swal.fire({
                title: 'Success!',
                text: 'User inserted successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php elseif ($showAlert === 'error'): ?>
            Swal.fire({
                title: 'Error!',
                text: 'Failed to insert user.',
                icon: 'error',
                confirmButtonText: 'Retry'
            });
        <?php endif; ?>
    });
</script>
<?php endif; ?>
