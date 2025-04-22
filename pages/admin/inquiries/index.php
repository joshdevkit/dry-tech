<?php

$title = "Admin Inquiries";
$pagetitle = "Inquiries Page";
include(\App\Class\PathResolver::basePath('pages/admin/partials/header.php'));

?>

<?php include(\App\Class\PathResolver::basePath('pages/admin/partials/topbar.php')); ?>


<div class="tab-content">
    <div class="tab-pane fade show active">

        <div class="card shadow-sm border-light mb-4">
            <div class="card-header text-white" style="background-color: #ff6b00;">
                <h4 class="card-title mb-0">Available Inquiries</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Complete Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = \App\Class\Database::getInstance();

                            $stmt = $db->conn()->prepare('SELECT * FROM contact_messages ORDER BY submitted_at ASC ');
                            $stmt->execute();
                            $data = $stmt->fetchAll();

                            if ($stmt->rowCount() > 0) {
                                foreach ($data as $row) {
                            ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-info view-message" data-message="<?php echo htmlspecialchars($row['message']); ?>"><i class="fas fa-eye"></i></button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Message:</strong></h6>
                <p id="messageContent"></p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.view-message', function() {
            var messageContent = $(this).data('message');
            $('#messageContent').text(messageContent);
            $('#messageModal').modal('show');
        });
    });
</script>

<?php include(\App\Class\PathResolver::basePath('pages/admin/partials/footer.php')); ?>