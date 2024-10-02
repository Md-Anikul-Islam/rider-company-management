var currentStep = 1;

function showStep(step) {
	$(".step").hide();
	$("#step-" + step).show();
}

function validateStep(step) {
	var valid = true;

	if (step === 1) {
		var category = $("select[name='category_id']").val();
		var noOfPost = $("input[name='no_of_post']").val();
		var employee_name = $("input[name='employee_name']").val();
		var country_id = $("select[name='country_id']").val();
		var skill_type = $("select[name='skill_type']").val();
		var gender = $("select[name='gender']").val();
		var description_en = $("textarea[name='description_en']").val();
		var description_bn = $("textarea[name='description_bn']").val();

		if (!category) {
			$("#categoryIdError").text("Job category is required");
			valid = false;
		} else {
			$("#categoryIdError").text("");
		}
		if (!noOfPost) {
			$("#no_of_post_error").text("No of the post is required");
			valid = false;
		} else {
			$("#no_of_post_error").text("");
		}
		if (!employee_name) {
			$("#employee_name_error").text("Employer Name is required");
			valid = false;
		} else {
			$("#employee_name_error").text("");
		}
		if (!country_id) {
			$("#country_id_error").text("Job country is required");
			valid = false;
		} else {
			$("#country_id_error").text("");
		}
		if (!skill_type) {
			$("#skill_type_error").text("Skill type is required");
			valid = false;
		} else {
			$("#skill_type_error").text("");
		}
		if (!gender) {
			$("#gender_error").text("Gender type is required");
			valid = false;
		} else {
			$("#gender_error").text("");
		}
		if (!description_en) {
			$("#description_en_error").text("Description is required");
			valid = false;
		} else {
			$("#description_en_error").text("");
		}
		if (!description_bn) {
			$("#description_bn_error").text("Description (Banlga) is required");
			valid = false;
		} else {
			$("#description_bn_error").text("");
		}

	} else if (step === 2) {
		var salary_amount = $("input[name='salary_amount']").val();
		var currency_id = $("select[name='currency_id']").val();
		var salary_per = $("select[name='salary_per']").val();

		if (!salary_amount) {
			$("#salary_amount_error").text("Salary is required");
			valid = false;
		} else {
			$("#salary_amount_error").text("");
		}
		if (!currency_id) {
			$("#currency_id_error").text("Currency type is required");
			valid = false;
		} else {
			$("#currency_id_error").text("");
		}
		if (!salary_per) {
			$("#salary_per_error").text("Salary period is required");
			valid = false;
		} else {
			$("#salary_per_error").text("");
		}
	} else if (step === 3) {
		var employment_permit_file = $("input[name='employment_permit_file']").val();

		if (!employment_permit_file) {
			$("#employment_permit_file_error").text("Employment permit file is required");
			valid = false;
		} else {
			$("#employment_permit_file_error").text("");
		}
	} else if (step === 4) {
		var contract_tenure = $("input[name='contract_tenure']").val();
		var probation_period = $("select[name='probation_period']").val();

		if (!contract_tenure) {
			$("#contract_tenure_error").text("Contract tenure is required");
			valid = false;
		} else {
			$("#contract_tenure_error").text("");
		}

		if (!probation_period) {
			$("#probation_period_error").text("Probation is required");
			valid = false;
		} else {
			$("#probation_period_error").text("");
		}
	}


	if (valid) {
		currentStep++;
		showStep(currentStep);
	}
}

function prevStep(step) {
	if (step > 1) {
		currentStep--;
		showStep(currentStep);
	}
}