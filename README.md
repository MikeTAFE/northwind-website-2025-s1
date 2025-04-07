# Northwind Website for in-class PHP testing

This is a website used as an in-class demonstration to teach PHP programming techniques as we move through the course content.

## Stealing this code

If you're in the course and are wanting to "gain inspiration" from this code, you can either:

1. Download the entire repo as a ZIP file.
2. View and download individual files of the repo (good to just grab a single change).
3. Clone the entire repo to your computer using `git clone https://github.com/MikeTAFE/northwind-website-2025-s1.git` from the directory where you want to download to.

## Secrets

Make sure you create the `/includes/secrets.php` file that holds API keys and other secrets, which is **not** tracked in this Git repo. You will need to manually create the file yourself and ensure that values are defined as needed.

```php
define("SENDGRID_API_KEY", "xyz");
```

