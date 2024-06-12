"use strict";
var KTSigninGeneral = (function () {
    var e, t, i;
    return {
        init: function () {
            (e = document.querySelector("#kt_sign_in_form")),
                (t = document.querySelector("#kt_sign_in_submit")),
                (i = FormValidation.formValidation(e, {
                    fields: {
						organization_name: {
							validators: {
								notEmpty: { message: "The bra organization name field is required." },
							}
						},
						contact_name: {
							validators: {
								notEmpty: { message: "The contact name field is required." },
							}
						},
                        email: { 
							validators: { 
								regexp: { regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 
									message: "The value is not a valid email address" 
								}, 
								notEmpty: { message: "The contact email field is required." } 
							} 
						},
                        mobileNo: { 
							validators: { 
								notEmpty: { message: "The contact mobile field is required." } 
							} 
						},
						trade_license: {
							validators: {
								notEmpty: { message: "The trade license field is required." },
							}
						},
						recruiting_license: {
							validators: {
								notEmpty: { message: "The recruiting license field is required." },
							}
						},
						business_card: {
							validators: {
								notEmpty: { message: "The business card field is required." },
							}
						}
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                })),
                t.addEventListener("click", function (n) {
                    n.preventDefault(),
                        i.validate().then(function (i) {
                            "Valid" == i
                                && (t.setAttribute("data-kt-indicator", "on"),
                                  (t.disabled = !0),
                                  setTimeout(function () {
                                      t.removeAttribute("data-kt-indicator"),
                                          (t.disabled = !1),
                                          Swal.fire({ text: "You have successfully logged in!", icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } }).then(function (t) {
                                              if (t.isConfirmed) {
                                                  (e.querySelector('[name="email"]').value = ""), (e.querySelector('[name="password"]').value = "");
                                                  var i = e.getAttribute("data-kt-redirect-url");
                                                  i && (location.href = i);
                                              }
                                          });
                                  }, 2e3))
                        });
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
