<!-- Page Content -->
<div class="content container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">
						<form class="themesetValidate" id="themesetformValidate" method="POST"
                                    action="{{ URL::to('settings/themesettingsave') }}"  enctype="multipart/form-data">
									@csrf
									@php
										if(!empty(CommonHelper::theme_setting())){
											$themerec = CommonHelper::theme_setting();
										}
										else{
											$themerec="";
										}
										@endphp
									@isset($themerec->id)
									<input type="hidden" name="id" value="@isset($themerec){{$themerec->id}}@endisset">
									@endisset
								<h4 class="page-title">Theme Settings</h4>
								<!--<div class="form-group row">
									<label class="col-lg-3 col-form-label">Website Name</label>
									<div class="col-lg-9">
										<input name="website_name" class="form-control" value="Denariusoft" type="text">
									</div>
								</div>-->
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Light Logo</label>
									<div class="col-lg-7">
										<input type="file" class="form-control" name="logo" value="@isset($themerec->logo){{$themerec->logo}}@endisset">
										<span class="form-text text-muted">Recommended image size is 40px x 40px</span>
									</div>
									<div class="col-lg-2">
										<div class="img-thumbnail float-right">										
										@if(!empty($themerec->logo))
										<img src="{{ URL::to('/') }}/storage/app/public/images/{{ $themerec->logo }}" alt="" width="40" height="40">
										@else
										<img src="{{ URL::to('/') }}/public/assets/img/logo.png" alt="" width="40" height="40">
										@endif
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Favicon</label>
									<div class="col-lg-7">
										<input type="file" class="form-control"  name="favicon"  value="@isset($themerec->favicon){{$themerec->favicon}}@endisset">
										<span class="form-text text-muted">Recommended image size is 16px x 16px</span>
									</div>
									<div class="col-lg-2">
										<div class="settings-image img-thumbnail float-right">
										@if(!empty($themerec->favicon))
										<img src="{{ URL::to('/') }}/storage/app/public/images/{{ $themerec->favicon }}" class="img-fluid" width="16" height="16" alt=""></div>
										@else
										<img src="{{ URL::to('/') }}/public/assets/img/logo.png" class="img-fluid" width="16" height="16" alt=""></div>
										@endif
									</div>
								</div>
								@isset($themerec->status)
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Status</label>
											<select class="form-control select" name="status">
												<option value=1 @if(($themerec->status)==1) {{ "selected" }} @endif>Active</option>
												<option value=0 @if(($themerec->status)==0) {{ "selected" }} @endif>Inactive</option>
											</select>
											
										</div>
									</div>
								</div>
								@endisset
								<div class="submit-section">
									<button class="btn btn-primary submit-btn" type="submit">Save</button>
								</div>
							</form>
						</div>
					</div>
                </div>
				<!-- /Page Content -->