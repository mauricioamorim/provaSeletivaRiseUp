<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1 class="h3 mb-2 text-gray-800">List</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3 alert-dark">
        <h6 class="m-0 font-weight-bold text-dark">Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive table-result-search">
            <table class="table table-sm table-bordered table-striped table-hover align-middle" id="dataTable" width="100%" cellspacing="0">
                <?php if(count($result)>0){ ?>
                    <thead class="alert-dark text-dark"> 
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Active</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $item){ ?>
                    <tr>                        
                        <th scope="row" class="align-middle text-dark"><?php echo $item["id"]; ?></th>
                        <td class="align-middle text-dark"><?php echo (isset($item["active"]) == 0)?"No":"Yes"; ?></td>
                        <td class="align-middle text-dark"><?php echo $item["name"]; ?></td>
                        <td class="align-middle text-dark"><?php echo $item["email"]; ?></td>
                        <td class="align-middle text-dark">
                            <a href="<?php echo base_url('user/detail/'.$item["id"]); ?>">
                                <button type="button" class="btn btn-sm btn-success"><i>Detail</i></button>
							</a>
							<a href="<?php echo base_url('user/update/'.$item["id"]); ?>">
                                <button type="button" class="btn btn-sm btn-warning"><i>Edit</i></button>
                            </a>
                            <button value="<?php echo base_url('user/delete/'.$item["id"]); ?>" type="button" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#deleteModal"><i>Delete</i></button>
                        </td>
                    </tr>
                    <?php 
                            }
                        } else {
							echo "No records in data base";
						}
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Attention, if you delete this user you will not be able to recover it.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                <button value="" type="button" class="btn btn-secondary delete-confirm">Yes</button>
            </div>
        </div>
    </div>
</div>
