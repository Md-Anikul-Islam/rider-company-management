"use strict";
var KTCreateAccount = (function () {
    var e,
        t,
        i,
        o,
        a,
        r,
        s = [];
    return {
        init: function () {
            (e = document.querySelector("#kt_modal_create_account")) && new bootstrap.Modal(e),
                (t = document.querySelector("#kt_create_account_stepper")) &&
                    ((i = t.querySelector("#kt_create_account_form")),
                    (o = t.querySelector('[data-kt-stepper-action="submit"]')),
                    (a = t.querySelector('[data-kt-stepper-action="next"]')),
                    (r = new KTStepper(t)).on("kt.stepper.changed", function (e) {
                        6 === r.getCurrentStepIndex()
                            ? (o.classList.remove("d-none"), o.classList.add("d-inline-block"), a.classList.add("d-none"))
                            : 7 === r.getCurrentStepIndex()
                            ? (o.classList.add("d-none"), a.classList.add("d-none"))
                            : (o.classList.remove("d-inline-block"), o.classList.remove("d-none"), a.classList.remove("d-none"));
                    }),
                    r.on("kt.stepper.next", function (e) {
                        console.log("stepper.next");
                        var t = s[e.getCurrentStepIndex() - 1];
                        t
                            ? t.validate().then(function (t) {
                                  console.log("validated!"),
                                      "Valid" == t
                                          ? (e.goNext(), KTUtil.scrollTop())
                                          : Swal.fire({
                                                text: "Sorry, looks like there are some errors detected, please try again.",
                                                icon: "error",
                                                buttonsStyling: !1,
                                                confirmButtonText: "Ok, got it!",
                                                customClass: { confirmButton: "btn btn-light" },
                                            }).then(function () {
                                                KTUtil.scrollTop();
                                            });
                              })
                            : (e.goNext(), KTUtil.scrollTop());
                    }),
                    r.on("kt.stepper.previous", function (e) {
                        console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop();
                    }),
                    s.push(
                        FormValidation.formValidation(i, {
                            plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                        })
                    ),
					s.push(
                        FormValidation.formValidation(i, {
                            plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                        })
                    ),
                    s.push(
                        FormValidation.formValidation(i, {
                            plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                        })
                    ),
                    s.push(
                        FormValidation.formValidation(i, {
                            plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                        })
                    ),
                    s.push(
                        FormValidation.formValidation(i, {
                            plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                        })
                    ),
                    o.addEventListener("click", function (e) {
                        s[3].validate().then(function (t) {
                            console.log("validated!"),
                                "Valid" == t
                                    ? (e.preventDefault(),
                                      (o.disabled = !0),
                                      o.setAttribute("data-kt-indicator", "on"),
                                      setTimeout(function () {
                                          o.removeAttribute("data-kt-indicator"), (o.disabled = !1), r.goNext();
                                      }, 2e3))
                                    : Swal.fire({
                                          text: "Sorry, looks like there are some errors detected, please try again.",
                                          icon: "error",
                                          buttonsStyling: !1,
                                          confirmButtonText: "Ok, got it!",
                                          customClass: { confirmButton: "btn btn-light" },
                                      }).then(function () {
                                          KTUtil.scrollTop();
                                      });
                        });
                    }),
                    	
                    $(i.querySelector('[name="business_type"]')).on("change", function () {
                        s[2].revalidateField("business_type");})
					);
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTCreateAccount.init();
});


// Image upload and preview
const inputFile = document.querySelector("#picture__input");
const pictureImage = document.querySelector(".picture__image");
const pictureImageTxt = `
	  <div class="text-center">
		<h3>Upload Your Passport</h3>
		<span>Allow file types: png, jpg, jpeg (Max size 2MB)</span> 
	  </div>
`;
pictureImage.innerHTML = pictureImageTxt;

inputFile.addEventListener("change", function (e) {
  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      const img = document.createElement("img");
      img.src = readerTarget.result;
      img.classList.add("picture__img");

      pictureImage.innerHTML = "";
      pictureImage.appendChild(img);
    });

    reader.readAsDataURL(file);
  } else {
    pictureImage.innerHTML = pictureImageTxt;
  }
});

// Date picker
$("#passport_issue_date, #date_of_birth, #passport_expiry_date").daterangepicker({
	singleDatePicker: true,
	showDropdowns: true,
	minYear: 1901,
	maxYear: parseInt(moment().format("YYYY"),12)
});