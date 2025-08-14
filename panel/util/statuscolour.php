<?php
if (!function_exists('getStatusBadge')) {
    function getStatusBadge($status) {
        $status = strtolower(trim($status));
        switch ($status) {
            case 'draft':
                $class = 'badge-secondary';
                break;
            case 'submitted':
                $class = 'badge-warning';
                break;
            case 'under review':
                $class = 'badge-primary';
                break;
            case 'shortlisted':
                $class = 'badge-warning';
                break;
            case 'approved':
                $class = 'badge-success';
                break;
            case 'rejected':
                $class = 'badge-danger';
                break;
            case 'waitlisted':
                $class = 'badge-orange';
                break;
            case 'offer sent':
                $class = 'badge-warning';
                break;
            case 'confirmed':
            case 'ongoing':
            case 'completed':
                $class = 'badge-success';
                break;
            case 'withdrawn':
            case 'terminated':
                $class = 'badge-danger';
                break;
            default:
                $class = 'badge-light';
                break;
        }

        return "<small class='badge $class'>" . htmlspecialchars(ucwords($status)) . "</small>";
    }
}
