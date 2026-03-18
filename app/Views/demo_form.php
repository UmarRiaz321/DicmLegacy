<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="csrf-token-name" content="<?= esc(csrf_token()) ?>">
<meta name="csrf-token" content="<?= esc(csrf_hash()) ?>">
<meta name="csrf-cookie" content="<?= esc(config('Security')->cookieName) ?>">
    <title>CSRF Demo</title>
</head>
<body>
<h1>Form demo</h1>
<form method="post" action="/demo/submit" id="f1">
    <?= csrf_field() ?>
    <input name="name" placeholder="Your name">
    <button type="submit">Submit (HTML)</button>
</form>

<h2>AJAX demo</h2>
<input id="name2" placeholder="Your name">
<button id="ajaxBtn">Submit (AJAX)</button>

<pre id="out"></pre>

<script src="<?= base_url('public/js/csrf.js') ?>?v=<?= rand() ?>"></script>
<script>
function setCsrf(name, value) {
    if (!name || !value) {
        return;
    }
    document.querySelector('meta[name="csrf-token-name"]').setAttribute('content', name);
    document.querySelector('meta[name="csrf-token"]').setAttribute('content', value);
    if (typeof window.setCsrf === 'function') {
        window.setCsrf(name, value);
    }
}

document.getElementById('ajaxBtn').addEventListener('click', async () => {
    const csrf = (typeof getCsrf === 'function') ? getCsrf() : { name: '', value: '' };
    const body = new URLSearchParams({
        name: document.getElementById('name2').value,
    });
    if (csrf.name && csrf.value) {
        body.append(csrf.name, csrf.value);
    }
    const res = await fetch('/demo/submit', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrf.value,
        },
        credentials: 'same-origin',
        body,
    });
    const json = await res.json();
    if (json.csrf) {
        setCsrf(json.csrf.name, json.csrf.value);
    }
    document.getElementById('out').textContent = JSON.stringify(json, null, 2);
});
</script>
</body>
</html>
