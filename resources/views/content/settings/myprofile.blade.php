<!-- Page Content -->
<div class="content container-fluid">
				
				<!-- Page Title -->
				<div class="row">
					<div class="col-sm-12">
						<h4 class="page-title">My Profile</h4>
					</div>
				</div>
				<!-- /Page Title -->
				
				<div style="padding:60px !important;" class="card-box mb-0">
					<div class="row">
						<div class="col-md-12">
							<div class="profile-view">
								<div  style="height:150px !important;" class="profile-img-wrap">
								
									<div class="profile-img">	
									<a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a>
									@php								
									$id=Auth::user()->id;
									if(!empty(CommonHelper::profile_img($id))){
										$profrec = CommonHelper::profile_img($id);
									}
									else{
										$profrec="";
									}
								@endphp
										@if(!empty($profrec->profile_img))
										<img src="{{ URL::to('/') }}/storage/app/public/images/{{ $profrec->profile_img }}" alt="" width="40" height="40">
										@else
										<img class="inline-block" src="{{ URL::to('/') }}/public/assets\img\profiles\user.jpg" alt="user">
										@endif	
									
									
									</div>
								</div>
								<div class="profile-basic">
									<div class="row">
										<div class="col-md-5">
											<div class="profile-info-left">
												<h3 class="user-name m-t-0 mb-0">{{ Auth::user()->name }}</h3>
												<!--<h6 class="text-muted">UI/UX Design Team</h6>-->
												<small class="text-muted">@php $user = Auth::user()->getRoleNames(); @endphp  @foreach($user as $v)
                                                {{ $v }} @endforeach</small>
												<!--<div class="staff-id">Employee ID : FT-0001</div>
												<div class="small doj text-muted">Date of Join : 1st Jan 2013</div>-->
												<div class="staff-msg"><a class="btn btn-custom" href="#add_edit_modal" data-toggle="modal" >Change Password</a></div>

												<div id="add_edit_modal" class="modal custom-modal fade" role="dialog">
												<div class="modal-dialog modal-dialog-centered modal-md" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Change Password</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
														<form method="POST" id="FormChangePasswordValidate" action="{{ route('settings.changePassword') }}">
															@csrf
															<div class="row">
																	<div class="col-md-6 offset-md-3">
																		
																		<form>
																			<div class="form-group">
																				<label>Old password</label>
																				<input type="password" class="form-control" id="currentpassword" name="currentpassword">
																			</div>
																			<div class="form-group">
																				<label>New password</label>
																				<input type="password" class="form-control" id="password" name="password">
																			</div>
																			<div class="form-group">
																				<label>Confirm password</label>
																				<input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  autocomplete="password">
																			</div>
																			<div class="submit-section">
																				<button class="btn btn-primary submit-btn">Update Password</button>
																			</div>
																		</form>
																	</div>
																</div>
				
													</form>
														</div>
													</div>
												</div>
											</div>		
				
											</div>
										</div>
										<div class="col-md-7">
											<ul class="personal-info">
												<!--<li>
													<div class="title">Phone:</div>
													<div class="text"><a href="">9876543210</a></div>
												</li>-->
												<li>
													<div class="title">Email:</div>
													<div class="text"><a href=""><span class="__cf_email__" data-cfemail="33595c5b5d575c5673564b525e435f561d505c5e">[email&#160;protected]</span></a></div>
												</li>
												<!--<li>
													<div class="title">Birthday:</div>
													<div class="text">24th July</div>
												</li>-->
												@php
												if(!empty(CommonHelper::cmpy_setting())){
													$cmpyrec = CommonHelper::cmpy_setting();
												}
												else{
													$cmpyrec="";
												}
												@endphp
												<li>
													<div class="title">Address:</div>
													<div class="text">@isset($cmpyrec->address){{$cmpyrec->address}}@endisset</div>
												</li>
												<!--<li>
													<div class="title">Gender:</div>
													<div class="text">Male</div>
												</li>
												<li>
													<div class="title">Reports to:</div>
													<div class="text">
													   <div class="avatar-box">
														  <div class="avatar avatar-xs">
															 <img src="assets\img\profiles\avatar-16.jpg" alt="">
														  </div>
													   </div>
													   <a href="profile.html">
															Jeffery Lalor
														</a>
													</div>
												</li>-->
											</ul>
										</div>
									</div>
								</div>
								<!--<div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>-->
							</div>
						</div>
					</div>
				</div>
				
				
				
			</div>
			<!-- /Page Content -->
			<div id="profile_info" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Upload Profile Image</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" action="{{ URL::to('settings/profileimg_save') }}"  enctype="multipart/form-data">
								@csrf
								@php								
									$id=Auth::user()->id;
									if(!empty(CommonHelper::profile_img($id))){
										$profrec = CommonHelper::profile_img($id);
									}
									else{
										$profrec="";
									}
								@endphp
								<input type="hidden" name="id"  value="@isset($profrec->id){{$profrec->id}}@endisset"/>
									<div class="row">
										<div class="col-md-12">
											<div class="profile-img-wrap edit-img">
										@if(!empty($profrec->profile_img))
										<img src="{{ URL::to('/') }}/storage/app/public/images/{{ $profrec->profile_img }}" alt="" width="40" height="40">
										@else
										<img class="inline-block" src="{{ URL::to('/') }}/public/assets\img\profiles\user.jpg" alt="user">
										@endif		
												<div class="fileupload btn">
													<span class="btn-text">edit</span>
													<input class="upload" type="file" name="profile_img">
												</div>
											</div>										
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
			<script>
    $("#FormChangePasswordValidate").validate({
        rules: {
            currentpassword:{
                required: true,
			},
			password:{
                required: true,
			},
			password_confirmation:{
                required: true,
            },
        },
        //For custom messages
        messages: {
            
			currentpassword: {
                required: '{{__("Please enter Current Password") }}', 
			},
			password: {
                required: '{{__("Please enter Password") }}', 
			},
			password_confirmation: {
                required: '{{__("Please enter Password Confirmation") }}', 
            },
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
        var placement = $(element).data('error');
        if (placement) {
            $(placement).append(error)
        } else {
            error.insertAfter(element);
        }
        }
    });
</script>