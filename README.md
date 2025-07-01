# WP Secure Login Redirect

Redirects `wp-login.php` and `/wp-admin/` pages to HTTPS when accessed over HTTP.

## Plugin URI

https://github.com/humayun-sarfraz/wp-secure-login-redirect

## Author

Humayun Sarfraz  
https://github.com/humayun-sarfraz

## Description

**WP Secure Login Redirect** ensures that any attempt to access your login or admin area over an insecure connection is automatically redirected to its HTTPS equivalent. This lightweight plugin enforces secure logins without installing a full SSL management suite.

## Installation

1. Upload the `wp-secure-login-redirect` folder to `/wp-content/plugins/`.  
2. Activate **WP Secure Login Redirect** via the **Plugins** screen.  

## Usage

- No settings page—just activate.  
- Any HTTP request to `wp-login.php` or `/wp-admin/` will 301-redirect to the same URI over HTTPS.

## Changelog

### 1.0.0
- Initial release: forces HTTPS on login and admin pages.

## License

GPL v2 or later — see [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html).
