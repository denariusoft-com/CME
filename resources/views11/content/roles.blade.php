<div class="content container-fluid">
		
		<!-- Page Title -->
		<div class="row">
			<div class="col-sm-8">
				<h4 class="page-title">Roles & Permissions</h4>
			</div>
		</div>
		<!-- /Page Title -->
		
		<div class="row">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-3">
			@can('role-create')			
           <!-- <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>-->
			<a href="#" class="btn btn-primary btn-block" onClick="showAddmodel()" data-toggle="modal" data-target="#add_role"><i class="fa fa-plus"></i> Add Roles</a>
            @endcan
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
			@if ($message = Session::get('success'))
				<div class="alert alert-success fade-out">
					<p>{{ $message }}</p>
				</div>
			@endif

				<div class="roles-menu">
				<table class="table table-bordered">
					<tr>
						<th style="text-align:center;">No</th>
						<th>Name</th>
						<th width="280px" style="text-align:center;">Action</th>
					</tr>
						@foreach ($roles as $key => $role)
						<tr>
							<td style="text-align:center;">{{ ++$i }}</td>
							<td style="text-transform:uppercase">{{ $role->name }}</td>
							<td style="text-align:center;">
								@can('role-edit')
								<a onClick="showEditmodel({{ $role->id }})" href="#"><i class="fa fa-pencil m-r-5"></i></a>
								<!--<a class="btn btn-primary"  href="{{ route('roles.edit',$role->id) }}">Edit</a>-->
								@endcan
								@can('role-delete')
								<a onClick="deleteRole({{ $role->id }})" href="#"><i class="fa fa-trash-o m-r-5"></i></a>
								<!-- Delete Role Modal -->
								<div class="modal custom-modal fade" id="delete_role" role="dialog">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-body">
												<div class="form-header">
													<h3>Delete Role</h3>
													<p>Are you sure want to delete?</p>
													
												</div>
												<div class="modal-btn delete-action">
													<div class="row">
														<div class="col-6">
														{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'width:100%']) !!}
														{!! Form::submit('Delete', ['class' => 'btn btn-primary continue-btn','style' => 'width:100%']) !!}
														{!! Form::close() !!}

													<!--<a href="{{ route('roles.destroy',$role->id) }}" class="btn btn-primary continue-btn">Delete</a>
														--></div>
														<div class="col-6">
															<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								
								@endcan
							</td>
						</tr>
						@endforeach
					</table>				
		</div>
	</div>
<!-- Add Role Modal -->
<div id="add_role" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Role</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form class="roleValidate" id="roleformValidate" method="POST"
                                    action="{{ route('roles.store') }}">
									@csrf
										<input type="hidden" name="id" id="updateroleid">
										<div class="form-group">
										<label>Role Name <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="name" id="role_name">
									</div>
									<div class="form-group">
										<label>Permission Modules<span class="text-danger"></span></label></br>
										@foreach($permission as $value)
										<input class="permission" name="permission[]" type="checkbox" value="{{ $value->id }}" id="permission_checked{{ $value->id }}"><label>
										{{ $value->name }} </label></br>
										@endforeach
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit">Submit</button>
									</div></form>								
							</div>
						</div>
					</div>
				</div>
			
				
				{!! $roles->render() !!}
<script>

function deleteRole(roleid) { 
	$('#delete_role').modal();	
}

function showAddmodel(){
	$(".permission").prop("checked", false);  
	$('#updateroleid').val("");      
	$('#role_name').val("");   
}
function showEditmodel(roleid) {  	
    $(".permission").prop("checked", false);  
 	var url = "{{ url('roles/show') }}" + '?id=' + roleid;
    $.ajax({
        url: url,
        type: "GET",
        success: function(result) {		
		role_result = JSON.parse(result);
		$('#updateroleid').val(role_result.id);      
		$('#role_name').val(role_result.name);   
		data = role_result.permission_detail; 
		$.each(data, function(key, item) {
        $("#permission_checked"+item.id).prop("checked", true);
		});   				
		$('#add_role').modal();
		}
    });
	//$('input:checkbox[name=permission]').val("");
}
</script>