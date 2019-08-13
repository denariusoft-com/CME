<!-- Page Content -->
<div class="content container-fluid">
					<div class="row">
						<div class="col-md-12">
							<form id="themeformValidate" method="POST">
								<h4 class="page-title">Theme Settings</h4>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Website Name</label>
									<div class="col-lg-9">
										<input name="website_name" id="website_name" class="form-control" value="Denariusoft" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Light Logo</label>
									<div class="col-lg-9">
										<input type="file" class="form-control" id="logo" name="logo">
										<span class="form-text text-muted">Recommended image size is 40px x 40px</span>
									</div>
									<!--div class="col-lg-2">
										<div class="img-thumbnail float-right"><img src="assets\img\logo.png" alt="" width="40" height="40"></div>
									</div-->
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Favicon</label>
									<div class="col-lg-9">
										<input type="file" class="form-control" name="favicon" id="favicon">
										<span class="form-text text-muted">Recommended image size is 16px x 16px</span>
									</div>
									<!--div class="col-lg-2">
										<div class="settings-image img-thumbnail float-right"><img src="assets\img\logo.png" class="img-fluid" width="16" height="16" alt=""></div>
									</div-->
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Save</button>
								</div>
							</form>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
<script>
	$(document).ready(function () {

	  $('#themeformValidate').validate({
	    rules: {
			"website_name" : {
				required: true
			},
			"logo" : {
				required: true
			},
			"favicon" : {
				required: true
			},
	    },
	    messages: {
			"website_name": {
				required: "website name is required"
			},
			"logo": {
				required: "logo required"
			},
			"favicon": {
				required: "favicon required"
			}
	    }
	  });

	});
</script>