(function () {
  'use strict';

  const doc = document;

  function getMeta(name) {
    return doc.querySelector('meta[name="' + name + '"]');
  }

  function setMeta(name, value) {
    const meta = getMeta(name);
    if (meta) {
      meta.setAttribute('content', value);
    }
  }

  function ensureHiddenField(form, name, value) {
    if (!form || !name) {
      return;
    }
    let input = form.querySelector('input[name="' + name + '"]');
    if (!input) {
      input = doc.createElement('input');
      input.type = 'hidden';
      input.name = name;
      form.appendChild(input);
    }
    input.value = value;
  }

  const cookieMeta = getMeta('csrf-cookie');
  window.__csrf = window.__csrf || {};
  if (cookieMeta && cookieMeta.getAttribute('content')) {
    window.__csrf.cookie = cookieMeta.getAttribute('content');
  }

  function getCsrf() {
    const nameMeta = getMeta('csrf-token-name');
    const tokenMeta = getMeta('csrf-token');
    return {
      name: nameMeta ? nameMeta.getAttribute('content') : '',
      value: tokenMeta ? tokenMeta.getAttribute('content') : '',
    };
  }

  function setCsrf(name, value) {
    if (!name || !value) {
      return;
    }
    setMeta('csrf-token-name', name);
    setMeta('csrf-token', value);
    window.__csrf = window.__csrf || {};
    window.__csrf.name = name;
    window.__csrf.value = value;
    if (!window.__csrf.cookie && cookieMeta && cookieMeta.getAttribute('content')) {
      window.__csrf.cookie = cookieMeta.getAttribute('content');
    }
  }

  function readCookie(name) {
    if (!name) {
      return null;
    }
    const search = name + '=';
    const parts = document.cookie.split(';');
    for (let i = 0; i < parts.length; i += 1) {
      const part = parts[i].trim();
      if (part.indexOf(search) === 0) {
        return decodeURIComponent(part.substring(search.length));
      }
    }
    return null;
  }

  window.getCsrf = getCsrf;
  window.setCsrf = setCsrf;

  window.updateCsrfFromResponse = function updateCsrfFromResponse(payload) {
    if (!payload || !payload.csrf) {
      return;
    }
    const name = payload.csrf.name || payload.csrf.token || payload.csrf.tokenName;
    const value = payload.csrf.value || payload.csrf.hash || payload.csrf.tokenValue;
    if (name && value) {
      setCsrf(name, value);
    }
  };

  window.postForm = async function postForm(url, data = {}) {
    const { name, value } = getCsrf();
    const params = new URLSearchParams();
    Object.keys(data || {}).forEach((key) => {
      if (Object.prototype.hasOwnProperty.call(data, key) && data[key] !== undefined) {
        params.append(key, data[key]);
      }
    });
    if (name && value) {
      params.append(name, value);
    }

    return fetch(url, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': value,
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      credentials: 'same-origin',
      body: params.toString(),
    });
  };

  if (window.axios) {
    window.axios.interceptors.request.use((config) => {
      const { name, value } = getCsrf();
      if (!name || !value) {
        return config;
      }

      config.headers = config.headers || {};
      config.headers['X-CSRF-TOKEN'] = value;

      const method = (config.method || 'get').toLowerCase();
      if (!['post', 'put', 'patch', 'delete'].includes(method)) {
        return config;
      }

      if (config.data instanceof FormData) {
        config.data.append(name, value);
        return config;
      }

      if (config.data && typeof config.data === 'object' && !(config.data instanceof URLSearchParams)) {
        const params = new URLSearchParams();
        Object.keys(config.data).forEach((key) => {
          params.append(key, config.data[key]);
        });
        params.append(name, value);
        config.data = params.toString();
        config.headers['Content-Type'] = 'application/x-www-form-urlencoded';
        return config;
      }

      const params = new URLSearchParams(config.data || {});
      params.append(name, value);
      config.data = params.toString();
      config.headers['Content-Type'] = 'application/x-www-form-urlencoded';
      return config;
    });
  }

  if (window.jQuery) {
    window.jQuery.ajaxSetup({
      beforeSend(xhr, settings) {
        const { name, value } = getCsrf();
        if (!name || !value) {
          return;
        }
        xhr.setRequestHeader('X-CSRF-TOKEN', value);

        const method = (settings.type || 'GET').toUpperCase();
        if (method === 'GET' || method === 'HEAD' || method === 'OPTIONS' || method === 'TRACE') {
          return;
        }

        if (settings.data instanceof FormData) {
          if (!settings.data.has(name)) {
            settings.data.append(name, value);
          }
          return;
        }

        if (typeof settings.data === 'string' && settings.data.length > 0) {
          settings.data += '&' + encodeURIComponent(name) + '=' + encodeURIComponent(value);
          return;
        }

        if (settings.data && typeof settings.data === 'object') {
          if (!Object.prototype.hasOwnProperty.call(settings.data, name)) {
            settings.data[name] = value;
          }
          return;
        }

        settings.data = encodeURIComponent(name) + '=' + encodeURIComponent(value);
      },
      complete(jqXHR) {
        const headerToken = jqXHR.getResponseHeader('X-CSRF-TOKEN');
        if (headerToken) {
        const current = getCsrf();
        setCsrf(current.name || window.__csrf.name || 'csrf_token', headerToken);
        return;
      }
      if (window.__csrf && window.__csrf.cookie) {
        const cookieValue = readCookie(window.__csrf.cookie);
        if (cookieValue) {
          setCsrf(window.__csrf.name || getCsrf().name || 'csrf_token', cookieValue);
        }
      }
    },
  });
  }

  doc.addEventListener('DOMContentLoaded', () => {
    const { name, value } = getCsrf();
    window.__csrf.name = name;
    window.__csrf.value = value;
    if (!window.__csrf.cookie && cookieMeta && cookieMeta.getAttribute('content')) {
      window.__csrf.cookie = cookieMeta.getAttribute('content');
    }

    doc.querySelectorAll('form').forEach((form) => {
      const method = (form.getAttribute('method') || 'GET').toUpperCase();
      if (['POST', 'PUT', 'PATCH', 'DELETE'].includes(method)) {
        ensureHiddenField(form, name, value);
      }
    });
  });
}());
