<?= $this->extend("layouts/adminLayout") ?>


<?= $this->section('admin_content') ?>

<div class="page_heading d-flex align-items-center justify-content-between my-5">
    <h1>Categories</h1>
    <div class="d-flex justify-content-end">
    <span>
        <i class="bi bi-plus-square" id="showFormBtn"></i>
    </span>
</div>
    <div id="formToggle" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i></div>
</div>

<div class="form-container mt-5 w-50 mx-auto shadow-lg p-5 rounded" id="form">
    <?= form_open_multipart("admin/categories/create", ["id" => "categoryForm", "method" => "post"]) ?>
    <input type="hidden" id="cid" value="">
    <div class="form-group">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="catname" id="catname">
    </div>
    <br>
    <div class="form-group">
        <label for="image">Choose an image:</label><br>
        <input class="form-control" type="file" id="image" name="image">
    </div>
    <br>
    <div class="form-group">
        <input type="submit" value="Add Category" id="addBtn" class="btn btn-outline-success">
        <input type="button" class="btn btn-outline-danger" value="Clear" id="clearBtn">
    </div>

    <br>
    </form>
</div>


<div class="container categories_wrap my-4">

    <table class="table table-info table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Sl</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbody">

        </tbody>
    </table>
    <div id="pagination-links" class="d-flex justify-content-center">

    </div>

    <?= $this->endSection() ?>


    <?= $this->section("script") ?>

    <script>
        $(document).ready(function() {

            // Clear Form

            function clearform() {
            $("#catname").val("");            
            $("#image").val("");
            $("#addBtn").val('Add Category');
            $(".form-container").hide(400);
        }

        //clearBtn
        $("#clearBtn").click(function(){
            clearform();            
        })
        //clearBtn end

            // Show data
            function showCategories(data) {
                let html;
                $.each(data.categories, function(index, category) {
                    html += `<tr>`;
                    html += "<td></td>";
                    html += `<td>${index + 1}</td>`;
                    html += `<td id="cat_name">${category.name}</td>`;
                    html += `<td id="cat_des"><img style="width: 80px" src="${category.image}" /></td>`;
                    html += `<td> <button data-id="${category.id}" id="editBtn" class="btn btn-outline-success">Edit</button> <button data-id="${category.id}" id="deleteBtn"  class="btn btn-outline-danger">Delete</button> </td>`;
                    html += `</tr>`;
                })
                $("#tbody").html(html);
                $('#pagination-links').empty().append(data.pager);
            }
            // Load Data
            function loadData(pageNumber) {
                $.ajax({
                    url: "<?= base_url('admin/categories/data') ?>",
                    type: "GET",
                    data: {
                        page: pageNumber
                    },
                    success: function(data) {
                        if (data.categories) {
                            showCategories(data)
                        }
                    }
                })
            }
            loadData(1);

            // Categories pagination
            $('#pagination-links').on('click', 'a', function(e) {
                e.preventDefault();
                let pageNumber = $(this).attr('href').split('page=')[1];
                loadData(pageNumber);
            });

            // Create Categories
            $("#categoryForm").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "<?=base_url('admin/categories/create')?>",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if(data.status){
                            loadData(1);
                            clearform();
                        }
                    }
                })

            })

            //categories delete

            $('#tbody').on('click','#deleteBtn',function(){
                $id=$(this).data('id');
                $.ajax({
                    url: "<?= base_url('admin/categories/delete')?>",
                    type: "POST",
                    data: {id:$id},
                    success: function(data) {
                        if(data.status){
                            loadData(1);
                            console.log(data);
                            
                        }
                    }
                    
                })
            })

        })
    </script>

    <?= $this->endSection() ?>