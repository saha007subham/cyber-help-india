/**
 * Cyber Help India — Main Client-Side JavaScript
 * 
 * Lightweight vanilla JavaScript foundation providing:
 * - Mobile navigation menu toggle & accessibility
 * - Alert dismissal
 * - Extensible hooks for AJAX requests & form validation
 */

'use strict';

// Global application namespace
window.CyberApp = (function () {
    /**
     * Initializes mobile navigation toggle.
     */
    function initMobileNav() {
        const toggleBtn = document.getElementById('nav-toggle');
        const primaryNav = document.getElementById('primary-nav');

        if (!toggleBtn || !primaryNav) {
            return;
        }

        toggleBtn.addEventListener('click', function () {
            const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';
            toggleBtn.setAttribute('aria-expanded', String(!isExpanded));
            toggleBtn.classList.toggle('open');
            primaryNav.classList.toggle('open');
            document.body.classList.toggle('nav-locked');
        });

        // Close navigation when clicking on a link (mobile drawer)
        const navLinks = primaryNav.querySelectorAll('.nav-link');
        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                if (primaryNav.classList.contains('open')) {
                    toggleBtn.setAttribute('aria-expanded', 'false');
                    toggleBtn.classList.remove('open');
                    primaryNav.classList.remove('open');
                    document.body.classList.remove('nav-locked');
                }
            });
        });
    }

    /**
     * Reusable JSON fetch wrapper for AJAX requests.
     * 
     * @param {string} url Endpoint URL.
     * @param {object} options Fetch options (method, body, headers).
     * @returns {Promise<any>}
     */
    async function request(url, options = {}) {
        const defaultHeaders = {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        };

        // Attach CSRF token if meta or input exists
        const csrfTokenInput = document.querySelector('input[name="csrf_token"]');
        if (csrfTokenInput) {
            defaultHeaders['X-CSRF-TOKEN'] = csrfTokenInput.value;
        }

        const mergedOptions = {
            ...options,
            headers: {
                ...defaultHeaders,
                ...(options.headers || {})
            }
        };

        const response = await fetch(url, mergedOptions);
        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Network request failed');
        }

        return data;
    }

    /**
     * DOM ready bootstrapping
     */
    document.addEventListener('DOMContentLoaded', function () {
        initMobileNav();
    });

    // Public API
    return {
        request: request,
    };
})();
