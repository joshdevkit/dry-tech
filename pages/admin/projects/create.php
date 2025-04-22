<?php

use App\Class\PathResolver;

$title = "Admin Projects - Create New Project";
$pagetitle = "Projects - Create New Project";
include(PathResolver::basePath('pages/admin/partials/header.php'));
include(PathResolver::basePath('pages/admin/partials/topbar.php'));

$db = \App\Class\Database::getInstance();
?>

<style>
    #imagePreview {
        border: 2px dashed #6c757d;
        border-radius: 10px;
        padding: 10px;
        min-height: 120px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        justify-content: flex-start;
        position: relative;
        background-color: #f8f9fa;
    }

    #imagePreview img {
        margin: 0;
        transition: 0.2s ease;
        border: 2px solid transparent;
    }

    #imagePreview img:hover {
        transform: scale(1.05);
        border-color: #0d6efd;
    }

    #imagePreview .btn {
        padding: 2px 6px;
        font-size: 0.75rem;
    }

    .image-wrapper {
        position: relative;
        display: inline-block;
        width: 100px;
        height: 100px;
    }

    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    .image-wrapper button {
        position: absolute;
        top: -8px;
        right: -8px;
        transform: translate(0, 0);
        z-index: 2;
    }
</style>



<div class="tab-content" id="projectTabContent">
    <div class="tab-pane fade show active" role="tabpanel">
        <div class="card">
            <div class="card-body">
                <form action="<?= BASE_URL ?>/actions/store.php" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Project Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="col-md-6">
                            <label for="location" class="form-label">Project Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>

                        <div class="col-md-6">
                            <label for="client" class="form-label">Project Client</label>
                            <input type="text" class="form-control" id="client" name="client" required>
                        </div>

                        <div class="col-md-6">
                            <label for="contract_amount" class="form-label">Contract Amount</label>
                            <input type="number" class="form-control" id="contract_amount" name="contract_amount" required>
                        </div>

                        <div class="col-md-6">
                            <label for="contract_package" class="form-label">Package</label>
                            <input type="text" class="form-control" id="contract_package" name="contract_package" required>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Project Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option value="On-Going">On-Going</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="images" class="form-label">Upload Project Images</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" onchange="previewImages()">
                        </div>

                        <div class="col-12">
                            <div id="imagePreview" class="d-flex flex-wrap gap-2"></div>
                        </div>


                        <div class="col-12 text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Save Project
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function previewImages() {
        const previewContainer = document.getElementById('imagePreview');
        const files = document.getElementById('images').files;

        const fileArray = Array.from(files);

        fileArray.forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                if (Array.from(previewContainer.getElementsByTagName('img')).some(img => img.src === URL.createObjectURL(file))) {
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'image-wrapper';
                    wrapper.style.margin = '5px';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'rounded border';
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle';
                    removeBtn.style.transform = 'translate(40%, -40%)';
                    removeBtn.title = 'Remove Image';

                    removeBtn.onclick = () => {
                        wrapper.remove();
                        if (previewContainer.children.length === 0) {
                            document.getElementById('images').value = '';
                        }
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>




<?php include(PathResolver::basePath('pages/admin/partials/footer.php')); ?>