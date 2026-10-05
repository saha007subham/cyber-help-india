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

        function closeNav() {
            if (primaryNav.classList.contains('open')) {
                toggleBtn.setAttribute('aria-expanded', 'false');
                toggleBtn.classList.remove('open');
                primaryNav.classList.remove('open');
                document.body.classList.remove('nav-locked');
            }
        }

        function openNav() {
            toggleBtn.setAttribute('aria-expanded', 'true');
            toggleBtn.classList.add('open');
            primaryNav.classList.add('open');
            document.body.classList.add('nav-locked');
        }

        toggleBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (primaryNav.classList.contains('open')) {
                closeNav();
            } else {
                openNav();
            }
        });

        // Close navigation when clicking on any nav link or CTA button inside drawer
        const clickableItems = primaryNav.querySelectorAll('.nav-link, .btn-header-enquiry, .btn-header-call');
        clickableItems.forEach(function (item) {
            item.addEventListener('click', function () {
                closeNav();
            });
        });

        // Close when clicking outside of navbar
        document.addEventListener('click', function (e) {
            if (primaryNav.classList.contains('open') && !primaryNav.contains(e.target) && !toggleBtn.contains(e.target)) {
                closeNav();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeNav();
            }
        });

        // Close drawer if resized beyond mobile breakpoint
        window.addEventListener('resize', function () {
            if (window.innerWidth > 1024 && primaryNav.classList.contains('open')) {
                closeNav();
            }
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
