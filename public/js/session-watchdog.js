(function (window, $) {
    'use strict';

    if (!$ || !window.Swal) {
        return;
    }

    const STATUS_CODES = [401, 403, 419, 440];
    let alertVisible = false;
    let sessionExpiredNotified = false;

    function notifySessionExpiry(message) {
        if (alertVisible) {
            return;
        }
        alertVisible = true;

        Swal.fire({
            html: ''
                + '<div class="session-expired-modal__icon-wrap">'
                + '  <i class="bi bi-shield-exclamation session-expired-modal__icon" aria-hidden="true"></i>'
                + '</div>'
                + '<h2 class="session-expired-modal__title">Session expired</h2>'
                + '<p class="session-expired-modal__text">' + (message || 'Your session has expired. Please sign in again to continue.') + '</p>',
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            customClass: {
                popup: 'session-expired-modal',
                closeButton: 'session-expired-modal__close',
                htmlContainer: 'session-expired-modal__content'
            }
        }).then(() => {
            alertVisible = false;
        });
    }

    $(document).ajaxError(function (event, jqXHR) {
        if (!jqXHR) {
            return;
        }
        if (STATUS_CODES.includes(jqXHR.status)) {
            if (sessionExpiredNotified) {
                return;
            }
            sessionExpiredNotified = true;
            const resp = jqXHR.responseJSON || {};
            notifySessionExpiry(resp.message);
        }
    });
})(window, window.jQuery);
