(function ($) {
    'use strict';

    const updateForm = $('#profileUpdateForm');
    let delegateDataTable = null;

    const initDelegatesTable = () => {
        const table = $('#delegateTable');
        if (!table.length || table.data('datatable-initialized')) {
            return;
        }
        $.fn.dataTable.ext.errMode = 'none';
        delegateDataTable = table.DataTable({
            paging: false,
            searching: false,
            ordering: false,
            info: false,
            language: {
                emptyTable: 'No delegates have been created yet.',
                zeroRecords: 'No matching team members found.',
                search: 'Search team:',
                paginate: {
                    previous: 'Prev',
                    next: 'Next'
                }
            }
        });
        table.data('datatable-initialized', true);
    };

    const handleDelegateInvite = () => {
        const form = $('#delegateForm');
        if (!form.length) {
            return;
        }
        const submitBtn = $('#delegateSubmit');
        const formElement = form.get(0);
        const endpoint = form.data('endpoint') || form.attr('action') || `${base_url}profile/delegates`;

        const submitDelegate = () => {
            submitBtn.prop('disabled', true).text('Creating...');

            $.ajax({
                url: endpoint,
                method: 'POST',
                data: form.serialize(),
                dataType: 'json'
            }).done((response) => {
                if (response?.success) {
                    form.trigger('reset');
                    $('#delegateModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Access granted',
                        text: response.message || 'Team member can now log in.',
                        confirmButtonText: 'Close',
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unable to invite',
                        text: response?.message || 'Please try again later.'
                    });
                }
            }).fail((xhr) => {
                const message = extractErrorMessage(xhr) || 'Something went wrong.';
                Swal.fire({
                    icon: 'error',
                    title: 'Unable to invite',
                    text: message
                });
            }).always(() => {
                submitBtn.prop('disabled', false).text('Send Invite');
            });
        };

        submitBtn.on('click', function (e) {
            e.preventDefault();
            if (formElement && !formElement.checkValidity()) {
                formElement.reportValidity();
                return;
            }
            submitDelegate();
        });

        form.on('submit', function (e) {
            e.preventDefault();
            submitBtn.trigger('click');
        });
    };

    const appendDelegateRow = (delegate) => {
        const row = $('<tr/>').attr('data-delegate-id', delegate.delegate_id || '');
        row.append(
            $('<td/>').text(delegate.invite_name || delegate.name || 'New User'),
            $('<td/>').text(delegate.invite_email || delegate.email || '-'),
            $('<td/>').append($('<span/>', {
                class: 'badge bg-light text-dark',
                text: (delegate.invite_status || 'active').charAt(0).toUpperCase() + (delegate.invite_status || 'active').slice(1)
            })),
            $('<td/>', { class: 'text-end' }).append(
                $('<button/>', { class: 'btn btn-link btn-sm text-decoration-none delegate-resend', text: 'Resend' }),
                $('<button/>', { class: 'btn btn-link text-danger btn-sm text-decoration-none delegate-revoke', text: 'Revoke' })
            )
        );

        if (delegateDataTable) {
            delegateDataTable.row.add(row[0]).draw(false);
        } else {
            $('#delegateTableBody').prepend(row);
        }
    };

    const delegateAction = (type, id) => {
        const endpoint = type === 'revoke' ? 'revoke' : 'resend';
        return $.ajax({
            url: `${base_url}profile/delegates/${endpoint}`,
            method: 'POST',
            data: { delegate_id: id },
            dataType: 'json'
        });
    };

    const bindDelegateActions = () => {
        $('#delegateTableBody').on('click', '.delegate-revoke', function () {
            const row = $(this).closest('tr');
            const id = row.data('delegate-id');
            Swal.fire({
                icon: 'warning',
                title: 'Revoke access?',
                text: 'They will no longer be able to log in.',
                showCancelButton: true,
                confirmButtonText: 'Yes, revoke',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (!result.isConfirmed) return;
                delegateAction('revoke', id).done((resp) => {
                    if (resp?.success) {
                        row.find('.delegate-revoke, .delegate-resend').remove();
                        row.find('td:nth-child(3)').html('<span class="badge bg-light text-dark">Revoked</span>');
                        row.find('td:nth-child(4)').html('<span class="text-muted small">Revoked</span>');
                    } else {
                        Swal.fire('Unable to revoke', resp?.message || 'Please try again later.', 'error');
                    }
                }).fail(() => Swal.fire('Unable to revoke', 'Please try again later.', 'error'));
            });
        });

        $('#delegateTableBody').on('click', '.delegate-resend', function () {
            const row = $(this).closest('tr');
            const id = row.data('delegate-id');
            delegateAction('resend', id).done((resp) => {
                if (resp?.success) {
                    Swal.fire('Sent', 'New credentials emailed.', 'success');
                } else {
                    Swal.fire('Unable to resend', resp?.message || 'Please try again later.', 'error');
                }
            }).fail(() => Swal.fire('Unable to resend', 'Please try again later.', 'error'));
        });
    };

    const populateUpdateForm = () => {
        if (!window.profileContext) return;
        const raw = window.profileContext.rawProfile || {};
        const org = window.profileContext.organisation || {};
        $('#organisation_name').val(raw.organisation_name || org.name || '');
        $('#registration_number').val(raw.registration || org.registration || '');
        $('#organisation_address').val(raw.address || org.address || '');
        $('#organisation_website').val(raw.website || '');
        $('#organisation_regions').val(raw.regions || org.regions || '');
        $('#contact_name').val(raw.contact_name || '');
        $('#contact_email').val(raw.contact_email || window.profileContext.parentEmail || '');
        $('#contact_phone').val(raw.contact_phone || '');
        $('#average_income').val(raw.average_income || '');
        $('#update_notes').val('');
    };

    const handleProfileUpdate = () => {
        if (!updateForm.length) return;
        const submit = $('#profileUpdateSubmit');

        updateForm.on('submit', function (e) {
            e.preventDefault();
            submit.prop('disabled', true).text('Submitting...');

            $.ajax({
                url: `${base_url}profile/update-request`,
                method: 'POST',
                data: updateForm.serialize(),
                dataType: 'json'
            }).done((resp) => {
                if (resp?.success) {
                    Swal.fire('Submitted', 'Your update request was sent to the Pluggin team.', 'success');
                    $('#profileUpdateModal').modal('hide');
                } else {
                    Swal.fire('Unable to submit', resp?.message || 'Please try again later.', 'error');
                }
            }).fail((xhr) => {
                const msg = extractErrorMessage(xhr) || 'Please try again later.';
                Swal.fire('Unable to submit', msg, 'error');
            }).always(() => {
                submit.prop('disabled', false).text('Submit Request');
            });
        });

        $('#profileUpdateModal').on('show.bs.modal', populateUpdateForm);
    };

    const extractErrorMessage = (xhr) => {
        if (!xhr) return null;
        const resp = xhr.responseJSON;
        if (resp?.message) return resp.message;
        if (resp?.errors && typeof resp.errors === 'object') {
            const firstKey = Object.keys(resp.errors)[0];
            if (firstKey) {
                const val = resp.errors[firstKey];
                return Array.isArray(val) ? val[0] : val;
            }
        }
        return null;
    };

    $(function () {
        initDelegatesTable();
        handleDelegateInvite();
        bindDelegateActions();
        handleProfileUpdate();
    });
})(jQuery);
