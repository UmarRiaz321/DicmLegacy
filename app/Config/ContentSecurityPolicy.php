<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Stores the default settings for the ContentSecurityPolicy, if you
 * choose to use it. The values here will be read in and set as defaults
 * for the site. If needed, they can be overridden on a page-by-page basis.
 *
 * Suggested reference for explanations:
 *
 * @see https://www.html5rocks.com/en/tutorials/security/content-security-policy/
 */
class ContentSecurityPolicy extends BaseConfig
{
    // -------------------------------------------------------------------------
    // Broadbrush CSP management
    // -------------------------------------------------------------------------

    /**
     * Default CSP report context
     */
    public bool $reportOnly = false;

    /**
     * Specifies a URL where a browser will send reports
     * when a content security policy is violated.
     */
    public ?string $reportURI = null;

    /**
     * Instructs user agents to rewrite URL schemes, changing
     * HTTP to HTTPS. This directive is for websites with
     * large numbers of old URLs that need to be rewritten.
     */
    public bool $upgradeInsecureRequests = true;

    // -------------------------------------------------------------------------
    // Sources allowed
    // NOTE: once you set a policy to 'none', it cannot be further restricted
    // -------------------------------------------------------------------------

    /**
     * Will default to self if not overridden
     *
     * @var string|string[]|null
     */
    public $defaultSrc = ["'self'"];

    /**
     * Lists allowed scripts' URLs.
     *
     * @var string|string[]
     */
    public $scriptSrc = [
        "'self'",
        "'unsafe-inline'",
        "'unsafe-eval'",
        'https://cdn.jsdelivr.net',
        'https://code.jquery.com',
        'https://cdnjs.cloudflare.com',
        'https://cdn.datatables.net',
        'https://unpkg.com',
    ];

    /**
     * Lists allowed stylesheets' URLs.
     *
     * @var string|string[]
     */
    public $styleSrc = [
        "'self'",
        "'unsafe-inline'",
        'https://cdn.jsdelivr.net',
        'https://code.jquery.com',
        'https://fonts.googleapis.com',
        'https://cdn.datatables.net',
        'https://cdnjs.cloudflare.com',
    ];

    /**
     * Defines the origins from which images can be loaded.
     *
     * @var string|string[]
     */
    public $imageSrc = [
        "'self'",
        'data:',
        'https:',
    ];

    /**
     * Restricts the URLs that can appear in a page's `<base>` element.
     *
     * Will default to self if not overridden
     *
     * @var string|string[]|null
     */
    public $baseURI = ["'self'"];

    /**
     * Lists the URLs for workers and embedded frame contents
     *
     * @var string|string[]
     */
    public $childSrc = ["'self'"];

    /**
     * Limits the origins that you can connect to (via XHR,
     * WebSockets, and EventSource).
     *
     * @var string|string[]
     */
    public $connectSrc = [
        "'self'",
        'https://auth-plugginecosystem.co.uk',
        'https://cdn.datatables.net',
        'https://cdn.jsdelivr.net',
        'https://cdnjs.cloudflare.com',
        'https://unpkg.com',
        'https://code.jquery.com',
    ];

    /**
     * Specifies the origins that can serve web fonts.
     *
     * @var string|string[]
     */
    public $fontSrc = [
        "'self'",
        'https://cdn.jsdelivr.net',
        'https://fonts.gstatic.com',
        'data:',
    ];

    /**
     * Lists valid endpoints for submission from `<form>` tags.
     *
     * @var string|string[]
     */
    public $formAction = ["'self'"];

    /**
     * Specifies the sources that can embed the current page.
     * This directive applies to `<frame>`, `<iframe>`, `<embed>`,
     * and `<applet>` tags. This directive can't be used in
     * `<meta>` tags and applies only to non-HTML resources.
     *
     * @var string|string[]|null
     */
    public $frameAncestors = ["'self'"];

    /**
     * The frame-src directive restricts the URLs which may
     * be loaded into nested browsing contexts.
     *
     * @var array|string|null
     */
    public $frameSrc = [
        "'self'",
        'https://www.youtube.com',
        'https://youtube.com',
        'https://www.youtube-nocookie.com',
    ];

    /**
     * Restricts the origins allowed to deliver video and audio.
     *
     * @var string|string[]|null
     */
    public $mediaSrc = [
        "'self'",
        'https:',
    ];

    /**
     * Allows control over Flash and other plugins.
     *
     * @var string|string[]
     */
    public $objectSrc = ["'self'"];

    /**
     * @var string|string[]|null
     */
    public $manifestSrc;

    /**
     * Limits the kinds of plugins a page may invoke.
     *
     * @var string|string[]|null
     */
    public $pluginTypes;

    /**
     * List of actions allowed.
     *
     * @var string|string[]|null
     */
    public $sandbox;

    /**
     * Nonce tag for style
     */
    public string $styleNonceTag = '{csp-style-nonce}';

    /**
     * Nonce tag for script
     */
    public string $scriptNonceTag = '{csp-script-nonce}';

    /**
     * Replace nonce tag automatically
     */
    public bool $autoNonce = true;
}
