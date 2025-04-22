<?php

use App\Class\PathResolver;

$title = "Admin Projects";
$pagetitle = "Projects";
include(PathResolver::basePath('pages/admin/partials/header.php'));
include(PathResolver::basePath('pages/admin/partials/topbar.php'));

$db = \App\Class\Database::getInstance();
?>


<div class="row mb-3">
    <div class="col text-right">
        <a class="btn btn-primary float-end" href="projects/create">Add New Project</a>
    </div>
</div>


<ul class="nav nav-tabs mb-3" id="projectTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="ongoing-tab" data-bs-toggle="tab" href="#ongoing" role="tab">On-Going</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab">Completed</a>
    </li>
</ul>


<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Project</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> -->

<div class="tab-content" id="projectTabContent">
    <div class="tab-pane fade show active" id="ongoing" role="tabpanel">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-body">
                    <div class="row g-4">
                        <?php
                        $projects = $db->conn()->query("SELECT * FROM projects WHERE status = 'On-Going'")->fetchAll(PDO::FETCH_ASSOC);
                        if (empty($projects)) {
                            echo '<p class="text-center text-muted">No On-going projects at the moment.</p>';
                        } else {
                            foreach ($projects as $project) {
                                $imagesStmt = $db->conn()->prepare("SELECT image_path FROM project_images WHERE project_id = ?");
                                $imagesStmt->execute([$project['id']]);
                                $images = $imagesStmt->fetchAll(PDO::FETCH_COLUMN);
                                if (empty($images)) continue;
                                $mainImage = array_shift($images);
                                $mainImageId = 'main-img-' . $project['id'];
                                $thumbnailsContainerId = 'thumbnails-' . $project['id'];
                        ?>
                                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                    <div class="card h-100">
                                        <div class="position-relative" style="height: 250px;">
                                            <img id="<?php echo $mainImageId; ?>"
                                                src="<?= asset('assets/image/projects/') ?><?php echo $mainImage; ?>"
                                                class="card-img-top object-fit-cover main-img w-100"
                                                style="height: 100%; object-fit: cover;"
                                                data-original-src="<?= asset('assets/image/projects/') ?><?php echo $mainImage; ?>"
                                                alt="Project Image">

                                            <?php if (!empty($images)) : ?>
                                                <div id="<?php echo $thumbnailsContainerId; ?>" class="position-absolute bottom-0 end-0 p-2 d-flex flex-wrap gap-2" style="z-index: 2;">
                                                    <?php foreach ($images as $img) : ?>
                                                        <img src="<?= asset('assets/image/projects/') ?><?php echo $img; ?>"
                                                            alt="Thumbnail"
                                                            class="img-thumbnail thumb-img"
                                                            style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                                            onclick="swapImages('<?php echo $mainImageId; ?>', this, '<?php echo $thumbnailsContainerId; ?>')">
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="card-body">
                                            <h6 class="card-title"><?php echo htmlspecialchars($project['title']); ?></h6>
                                            <p class="card-text"><strong>Client:</strong> <?php echo htmlspecialchars($project['client']); ?></p>
                                            <p class="card-text"><strong>Location:</strong> <?php echo htmlspecialchars($project['location']); ?></p>
                                            <p class="card-text"><strong>Contract Amount:</strong> ₱<?php echo number_format($project['contract_amount'], 2); ?></p>
                                            <p class="card-text"><strong>Package:</strong> <?php echo htmlspecialchars($project['contract_package']); ?></p>

                                        </div>
                                        <div class="card-footer ">
                                            <button class="btn btn-primary">Mark as Completed</button>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Completed Projects Tab -->
    <div class="tab-pane fade" id="completed" role="tabpanel">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-body">
                    <div class="row g-4">
                        <?php
                        $projects = $db->conn()->query("SELECT * FROM projects WHERE status = 'Completed'")->fetchAll(PDO::FETCH_ASSOC);
                        if (empty($projects)) {
                            echo '<p class="text-center text-muted">No completed projects at the moment.</p>';
                        } else {
                            foreach ($projects as $project) {
                                $imagesStmt = $db->conn()->prepare("SELECT image_path FROM project_images WHERE project_id = ?");
                                $imagesStmt->execute([$project['id']]);
                                $images = $imagesStmt->fetchAll(PDO::FETCH_COLUMN);
                                if (empty($images)) continue;
                                $mainImage = array_shift($images);
                                $mainImageId = 'completed-main-img-' . $project['id'];
                                $thumbnailsContainerId = 'completed-thumbnails-' . $project['id'];
                        ?>
                                <div class="col-md-4 col-lg-3">
                                    <div class="card h-100">
                                        <div class="position-relative" style="height: 250px;">
                                            <img id="<?php echo $mainImageId; ?>"
                                                src="<?= asset('assets/image/projects/') ?><?php echo $mainImage; ?>"
                                                class="card-img-top object-fit-cover main-img w-100"
                                                style="height: 100%; object-fit: cover;"
                                                data-original-src="<?= asset('assets/image/projects/') ?><?php echo $mainImage; ?>"
                                                alt="Project Image">

                                            <?php if (!empty($images)) : ?>
                                                <div id="<?php echo $thumbnailsContainerId; ?>" class="position-absolute bottom-0 end-0 p-2 d-flex flex-wrap gap-2" style="z-index: 2;">
                                                    <?php foreach ($images as $img) : ?>
                                                        <img src="<?= asset('assets/image/projects/') ?><?php echo $img; ?>"
                                                            alt="Thumbnail"
                                                            class="img-thumbnail thumb-img"
                                                            style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                                            onclick="swapCompletedImages('<?php echo $mainImageId; ?>', this, '<?php echo $thumbnailsContainerId; ?>')">
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($project['title']); ?></h5>
                                            <p class="card-text"><strong>Client:</strong> <?php echo htmlspecialchars($project['client']); ?></p>
                                            <p class="card-text"><strong>Location:</strong> <?php echo htmlspecialchars($project['location']); ?></p>
                                            <p class="card-text"><strong>Contract Amount:</strong> ₱<?php echo number_format($project['contract_amount'], 2); ?></p>
                                            <p class="card-text"><strong>Package:</strong> <?php echo htmlspecialchars($project['contract_package']); ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function swapImages(mainImageId, thumbElement, thumbnailsContainerId) {
        const mainImg = document.getElementById(mainImageId);
        const currentMainSrc = mainImg.src;

        mainImg.src = thumbElement.src;

        const newThumb = document.createElement('img');
        newThumb.src = currentMainSrc;
        newThumb.alt = "Thumbnail";
        newThumb.className = "img-thumbnail thumb-img";
        newThumb.style.width = "60px";
        newThumb.style.height = "60px";
        newThumb.style.objectFit = "cover";
        newThumb.style.cursor = "pointer";
        newThumb.onclick = function() {
            swapImages(mainImageId, newThumb, thumbnailsContainerId);
        };

        thumbElement.parentNode.removeChild(thumbElement);

        document.getElementById(thumbnailsContainerId).appendChild(newThumb);
    }

    function swapCompletedImages(mainImageId, thumbElement, thumbnailsContainerId) {
        const mainImg = document.getElementById(mainImageId);
        const currentMainSrc = mainImg.src;

        mainImg.src = thumbElement.src;

        const newThumb = document.createElement('img');
        newThumb.src = currentMainSrc;
        newThumb.alt = "Thumbnail";
        newThumb.className = "img-thumbnail thumb-img";
        newThumb.style.width = "60px";
        newThumb.style.height = "60px";
        newThumb.style.objectFit = "cover";
        newThumb.style.cursor = "pointer";
        newThumb.onclick = function() {
            swapCompletedImages(mainImageId, newThumb, thumbnailsContainerId);
        };

        thumbElement.parentNode.removeChild(thumbElement);

        document.getElementById(thumbnailsContainerId).appendChild(newThumb);
    }
</script>

<?php include(PathResolver::basePath('pages/admin/partials/footer.php')); ?>