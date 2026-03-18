(function () {
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('userProvisionForm');
        if (!form) {
            return;
        }

        const submitBtn = document.getElementById('userProvisionSubmit');

        const showAlert = function (type, title, text) {
            if (typeof Swal === 'undefined') {
                alert(title + '\n' + text);
                return;
            }
            Swal.fire({ icon: type, title: title, html: text, confirmButtonText: 'Ok' });
        };

        const serializeForm = function (formEl) {
            const formData = new FormData(formEl);
            return new URLSearchParams(formData).toString();
        };

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
            }

            const payload = serializeForm(form);

            fetch(base_url + 'admin/users', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: payload,
                credentials: 'same-origin'
            })
                .then(async (response) => {
                    const data = await response.json().catch(() => ({ message: 'Unexpected response from server.' }));

                    if (!response.ok) {
                        const errors = data.errors ? Object.values(data.errors).join('<br>') : data.message;
                        throw new Error(errors || 'Unable to create user.');
                    }

                    if (data.status === 'warning') {
                        showAlert('warning', 'Action completed with warnings', data.message || 'User created but email notification failed.');
                        return;
                    }

                    if (data.status !== 'success') {
                        const errors = data.errors ? Object.values(data.errors).join('<br>') : data.message;
                        throw new Error(errors || 'Unable to create user.');
                    }

                    form.reset();
                    showAlert('success', 'User Provisioned', data.message || 'The user was created and notified.');
                })
                .catch((error) => {
                    showAlert('error', 'Request Failed', error.message || 'Unable to create user.');
                })
                .finally(() => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="bi bi-person-plus me-1"></i> Create User';
                    }
                });
        });
    });
})();
