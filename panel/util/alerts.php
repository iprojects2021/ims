<!-- alert.php -->

<?php if (isset($showAlert) && $showAlert): ?>
<script>
Swal.fire({
    title: 'Success!',
    text: 'Record inserted successfully.',
    icon: 'success',
    confirmButtonText: 'OK'
});
</script>
<?php elseif (isset($showAlert) && !$showAlert): ?>
<script>
Swal.fire({
    title: 'Error!',
    text: 'Failed to insert record.',
    icon: 'error',
    confirmButtonText: 'Retry'
});
</script>
<?php endif; ?>
