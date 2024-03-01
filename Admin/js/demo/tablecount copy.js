
    

    $(document).ready(function() {
    // Function to update pending task count
    function updatePendingCount() {
        $.ajax({
            url: 'get_pending_count.php',
            type: 'GET',
            dataType: 'json', // Specify JSON dataType
            success: function(response) {
                // Parse response as integer
                var count = parseInt(response);
                // Check if count is a valid number
                if (!isNaN(count)) {
                    // Update pending count
                    $('#pending-count').text(count);
                } else {
                    console.error('Invalid count received: ' + response);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Initial call to update pending count on page load
    updatePendingCount();

    // Change status button click event
    $('.btn-change-status').click(function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'update_status.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                // Update pending count after status change
                updatePendingCount();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Delete button click event
    $('.btn-delete').click(function() {
        var id = $(this).data('id');
        $.ajax({
            url: 'delete_status.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                // Update pending count after task deletion
                updatePendingCount();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
