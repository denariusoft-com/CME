
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-12 ">
						<form class="companysetValidate" id="companysetformValidate" method="POST"
                                    action="{{ URL::to('settings/companysetting/') }}">
									
								<h3 class="page-title">Company Settings</h3>
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
								@if(session()->has('message'))
									<div class="{{ session()->get('alertClass') }} alert-dismissible fade show" role="alert" id="msg">
										<strong>{{ session()->get('type') }}</strong> {{ session()->get('message') }}
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
								@endif
						
								@csrf
										@php
										if(!empty(CommonHelper::cmpy_setting())){
											$cmpyrec = CommonHelper::cmpy_setting();
										}
										else{
											$cmpyrec="";
										}
										@endphp
								@isset($cmpyrec->id)
								<input type="hidden" name="id" value="@isset($cmpyrec){{$cmpyrec->id}}@endisset">
								@endisset
								</div>
								<div class="row">
									<div class="col-sm-6">									
										<div class="form-group">
											<label>Company Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="company_name" id="company_name" value="@isset($cmpyrec->company_name){{$cmpyrec->company_name}}@endisset">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Contact Person</label>
											<input class="form-control "  type="text" name="contact_person" id="contact_person" value="@isset($cmpyrec->contact_person){{$cmpyrec->contact_person}}@endisset">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Address</label>
											<input class="form-control " type="text" name="address" id="address" value="@isset($cmpyrec->address){{$cmpyrec->address}}@endisset">
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>Country</label>
											<input class="form-control " type="text" name="country" id="country" value="@isset($cmpyrecc->country){{$cmpyrec->country}}@endisset">
											<!--<select class="form-control select">
												<option>USA</option>
												<option>United Kingdom</option>
											</select>-->
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>City</label>
											<input class="form-control" type="text" name="city" id="city" value="@isset($cmpyrec->city){{$cmpyrec->city}}@endisset">
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>State/Province</label>
											<input class="form-control" type="text" name="state" id="state" value="@isset($cmpyrec->state){{$cmpyrec->state}}@endisset">
											<!--<select class="form-control select">
												<option>California</option>
												<option>Alaska</option>
												<option>Alabama</option>
											</select>-->
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-3">
										<div class="form-group">
											<label>Postal Code</label>
											<input class="form-control" type="text" name="postal_code" id="postal_code" value="@isset($cmpyrec->postal_code){{$cmpyrec->postal_code}}@endisset">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Email</label>
											<input class="form-control" type="text" name="email" id="email" value="@isset($cmpyrec->email){{$cmpyrec->email}}@endisset">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Phone Number</label>
											<input class="form-control"  type="text" name="phone_no" id="phone_no" value="@isset($cmpyrec->phone_no){{$cmpyrec->phone_no}}@endisset"> 
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Mobile Number</label>
											<input class="form-control"  type="text" name="mobile_no" id="mobile_no" value="@isset($cmpyrec->mobile_no){{$cmpyrec->mobile_no}}@endisset">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Fax</label>
											<input class="form-control" name="fax" id="fax" value="@isset($cmpyrec->fax){{$cmpyrec->fax}}@endisset">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Website Url</label>
											<input class="form-control"  name="website_url" id="website_url" value="@isset($cmpyrec->website_url){{$cmpyrec->website_url}}@endisset">
										</div>
									</div>
								</div>
								@isset($cmpyrec->status)
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Status</label>
											<select class="form-control select" name="status" id="status">
												<option value=1 @if(($cmpyrec->status)==1) {{ "selected" }} @endif>Active</option>
												<option value=0 @if(($cmpyrec->status)==0) {{ "selected" }} @endif>Inactive</option>
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
				
<script>
	$(document).ready(function () {

	  $('#companysetformValidate').validate({
	    rules: {
			"company_name" : {
				required: true
			},
			"contact_person" : {
				required: true
			},
			"address" : {
				required: true
			},
			"country" : {
				required: true
			},
			"city" : {
				required: true
			},
			"state" : {
				required: true
			},
			"postal_code" : {
				required: true
			},
			"email" : {
				required: true,
				email:true
			},
			"phone_no" : {
				required: true,
				number:true
			},
			"mobile_no" : {
				required: true,
				number:true
			},
			"fax" : {
				required: true
			},
			"website_url" : {
				required: true
			},
			"status" : {
				required: true
			},
	    },
	    messages: {
			"company_name": {
				required: "company name is required"
			},
			"contact_person": {
				required: "contact person name is required"
			},
			"address": {
				required: "address is required"
			},
			"country": {
				required: "country name is required"
			},
			"city": {
				required: "city name is required"
			},
			"state": {
				required: "state name is required"
			},
			"postal_code": {
				required: "postal code is required"
			},
			"email": {
				required: "email name is required",
				email: "enter valid email address"
			},
			"phone_no": {
				required: "contact person name is required",
				number:"enter number only"
			},
			"mobile_no": {
				required: "contact person name is required",
				number:"enter number only"
			},
			"fax": {
				required: "contact person name is required"
			},
			"website_url": {
				required: "contact person name is required"
			},
			"status": {
				required: "contact person name is required"
			}
	    }
	  });

	});
</script>