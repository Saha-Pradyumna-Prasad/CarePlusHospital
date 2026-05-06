$(document).ready(function() {
    // Sidebar toggle
    $('#sidebar-toggle').click(function() {
        $('.sidebar').toggleClass('active');
    });
    
    // Initialize DataTables
    $('.datatable').DataTable({
        responsive: true,
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        }
    });
    
    // Delete confirmation with SweetAlert2
    $('.delete-form').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
    
    // Auto dismiss alerts
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Image preview for file upload
    $('input[type="file"]').change(function(e) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $(this).closest('form').find('.image-preview').attr('src', e.target.result).show();
        };
        if (this.files && this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        }
    });
});