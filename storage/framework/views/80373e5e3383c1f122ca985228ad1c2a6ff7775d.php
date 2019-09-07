                <div class="content container-fluid">
				
					<!-- Page Title -->
					<div class="row">
						<div class="col">
							<h4 class="page-title">Rate Master List</h4>
						</div>
						<div class="col-12 text-right m-b-30">
							<a href="<?php echo e(route('ratemasters.create')); ?>" class="btn add-btn" ><i class="fa fa-plus"></i> Add </a>
						</div>
					</div>
					<!-- /Page Title -->
					<div class="row">
						<?php if(session()->has('message')): ?>
							<div class="<?php echo e(session()->get('alertClass')); ?> alert-dismissible fade show" role="alert" id="msg">
								<strong><?php echo e(session()->get('type')); ?></strong> <?php echo e(session()->get('message')); ?>

								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
						<?php endif; ?>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0 datatable" id="ratemaster_datatable_list" style="width:100%">
									<thead>
										<tr>
											<th>Mor.Master Name</th>
											<th>Category Name</th>
											<th>Rate Name</th>
											<th>Timing(Hr)</th>
											<th>Price(RM)</th>
											<th style="text-align:center">Action</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<div id="delete_data" class="modal custom-modal_delete fade"  role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md">
						<form action="" id="deleteForm" method="post" style="width: 100%;">
							<div class="modal-content" style="border-radius: 1rem;padding: 20px;">
								<div class="modal-body">
									<?php echo e(csrf_field()); ?>

									<?php echo e(method_field('DELETE')); ?>

									<div class="form-header">
										<h3>Rate Master Detail</h3>
										<p>Are you sure want to delete?</p>
									</div>
									<div class="modal-btn delete-action">
										<div class="row">
											<div class="col-6">
												<!--a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a-->
												<button type="submit" name="" class="btn btn-danger continue-btn" data-dismiss="modal" onclick="formSubmit()" style="width: 100%;background: #F44336;border: 1px solid #f44336;color: #fff;">Yes, Delete</button>
											</div>
											<div class="col-6">
												<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn" style="background: #ff9b44;color: #fff;">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>


<script type="text/javascript">
// Datatable	
$(document).ready(function() {
	
	
	$('#ratemaster_datatable_list').DataTable({
    
    "columnDefs": [{
      "visible": false,
      "targets": 0
    }],
    "order": [
      [0, 'asc']
    ],
	"lengthMenu": [
		[10, 25, 50, 100],
		[10, 25, 50, 100]
	],
    "drawCallback": function (settings) {
      var api = this.api();
      var rows = api.rows({
        page: 'current'
      }).nodes();
      var last = null;

      api.column(0, {
        page: 'current'
      }).data().each(function (group, i) {
        if (last !== group) {
          $(rows).eq(i).before(
            '<tr style="background:grey;padding:2px !important;color:white;" class="group"><td colspan="5">' + "MM:  <label style='text-transform:uppercase'>"+group + '</label></td></tr>'
          );

          last = group;
        }
      });
    },
	"processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo e(url('/get_ratemaster_list')); ?>",
            "dataType": "json",
            "type": "POST",
            "data": {
                _token: "<?php echo e(csrf_token()); ?>"
            }
        },
        "columns": [ 
			{
					"data": "user_id"
				},
				{
					"data": "cat_id"
				},
				{
					"data": "rate_id"
				},
				{
					"data": "timing"
				},
				{
					"data": "price"
				},
				{
					"data": "options"
				}
        ]
  });


});


function ConfirmDeletion(deleteID) {
	$('.custom-modal_delete').modal();
    var id = deleteID;
	var url = '<?php echo e(route("ratemasters.destroy", ":id")); ?>';
	url = url.replace(':id', id);
	$("#deleteForm").attr('action', url);
	
}
function formSubmit()
 {
	 $("#deleteForm").submit();
 }

function showeditForm(ratemasterID) {
    //$('.edit_hide').hide();
    $('.add_hide').hide();
    $('.edit_hide_btn').show();
    $('.modal').modal();
    var url = "<?php echo e(url('/get_ratemaster_detail')); ?>" + '?id=' + ratemasterID;
    $.ajax({
        url: url,
        type: "GET",
        success: function(result) {
            //console.log(result);
            $('#updateid').val(result.id);
			$('#user_id').val(result.user_id);
            $('#cat_id').val(result.cat_id);
            $('#rate_id').val(result.rate_id);
            $('#price').val(result.price);
        }
    });
}

</script><?php /**PATH D:\php7\htdocs\laravel\CME\resources\views/content/ratemaster_list.blade.php ENDPATH**/ ?>