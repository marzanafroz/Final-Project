<?= $this->extend("layouts/adminLayout") ?>


<?= $this->section('admin_content') ?>
<div class="page_heading d-flex align-items-center justify-content-between my-5">
    <h1>SubCategories</h1>
    <div class="d-flex justify-content-end">
        <span>
            <i class="bi bi-plus-square" id="showFormBtn"></i>
        </span>
    </div>
    <div id="formToggle" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i></div>
</div>

<div class="form-container mt-5 w-50 mx-auto shadow-lg p-5 rounded" id="form">
    <?= form_open_multipart("admin/categories/create", ["id" => "subcategoryForm", "method" => "post"]) ?>
    <input type="hidden" id="subcid" value="">
    <div class="form-group">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="catname" id="subcatname">
    </div>
    <br>
    <div class="form-group">
        <select class="form-select" id="catid" aria-label="Default select example">
            <option value="-1">Select Category</option>
            <?php foreach ($categories as $category) { ?>

                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>

            <?php } ?>


        </select>
    </div>
    <br>
    <div class="form-group">
        <input type="button" value="Add Category" id="addBtn" class="btn btn-outline-success">
        <input type="button" class="btn btn-outline-danger" value="Clear" id="clearBtn">
    </div>

    <br>
    </form>

</div>

<div class="container categories_wrap my-4">

    <table class="table table-info table-striped">
        <thead>
            <tr>
                <th>SL.</th>
                <th>Name</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbody">

        </tbody>
    </table>
    <div id="pagination-links" class="d-flex justify-content-center">

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section("script") ?>


<script>
    $(document).ready(function() {



        // Add Subcategories
        $("#addBtn").click(function() {
            let subcatid = $("#subcid").val();
            let name = $("#subcatname").val();
            let catid = $("#catid").val();


            $.ajax({
                url: "<?= base_url('admin/subcategories/create') ?>",
                type: "POST",
                data: {
                    subcatid: subcatid,
                    name: name,
                    catid: catid
                },
                success: function(res) {
                    loadData(1);
                    clearform();
                }

            });
        });
        // Show Data
        function showSubCategories(data) {
            let html;
            $.each(data.subcategories, function(index, subcategory) {
                html += `<tr>`;
                html += `<td>${index + 1}</td>`;
                html += `<td id="catname">${subcategory.name}</td>`;
                html += `<td id="catname">${subcategory.category_id}</td>`;
                html += `<td> <button data-id="${subcategory.id}" id="editBtn" class="btn btn-outline-success">Edit</button> <button data-id="${subcategory.id}" id="deleteBtn"  class="btn btn-outline-danger">Delete</button> </td>`;
                html += `</tr>`;
            })
            $("#tbody").html(html);
            $('#pagination-links').empty().append(data.pager);
        }

        // Load Data
        function loadData(pageNumber) {
            $.ajax({
                url: "<?= base_url('admin/subcategories/data') ?>",
                type: "GET",
                data: {
                    page: pageNumber
                },
                success: function(data) {
                  
                    if (data.subcategories) {
                        showSubCategories(data)
                    }
                }
            })
        }
        loadData(1);


        //Clear form

        function clearform(){
            $("#subcatname").val("");
            $("#catid").val("-1");            
            $("#addBtn").val('Add Category');
            $(".form-container").hide(400);
        }

        // Clear Btn

        $("#clearBtn").click(function(){
            clearform();

        });

        // Categories pagination
        $('#pagination-links').on('click', 'a', function(e) {
            e.preventDefault();
            let pageNumber = $(this).attr('href').split('page=')[1];
            loadData(pageNumber);
        });

        // Create Categories
        $("#subcategoryForm").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('admin/subcategories/create') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        loadData(1);
                        clearform();
                    }
                }
            })

        })

        //subcategories delete
        
        $('#tbody').on('click', '#deleteBtn', function() {
            $id = $(this).data('id');
            
            $.ajax({
                url: "<?= base_url('admin/subcategories/delete') ?>",
                type: "POST",
                data: {
                    id: $id
                },
                success: function(data) {
                    if (data.status) {
                        loadData(1);
                        console.log(data);

                    }
                }

            })
        })





    })
</script>

<?= $this->endSection() ?>