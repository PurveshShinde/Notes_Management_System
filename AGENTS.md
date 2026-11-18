# AI Agent Guidelines & System Conventions

This document establishes operational guardrails, development principles, and prompt conventions for AI coding agents (such as Google Antigravity, Anthropic Claude, GitHub Copilot, and OpenAI models) operating within the **Notes Management System** codebase.

---

## 1. Core Operating Directives

When interacting with or modifying this repository, AI agents must adhere to the following non-negotiable rules:

1. **Preserve PHP 8.2 Compatibility:**  
   The runtime environment is pinned to `php:8.2.35-apache`. Ensure that all PHP code is fully compatible with PHP 8.2+ without producing deprecation notices (e.g., dynamic property creations, deprecated string interpolations, or removed functions).

2. **Strict PDO Parameter Binding:**  
   Never construct SQL queries with direct string concatenation or variable interpolation. Always use PDO prepared statements with explicit parameter binding:
   ```php
   // CORRECT
   $stmt = $dbh->prepare("SELECT * FROM tblnotes WHERE UserID = :uid");
   $stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
   $stmt->execute();

   // FORBIDDEN
   $stmt = $dbh->query("SELECT * FROM tblnotes WHERE UserID = " . $userId);
   ```

3. **Canonical Link Consistency (SEO Protection):**  
   To prevent duplicate indexing and canonical dilution in Google Search Console:
   - Always link to the homepage using `/` rather than `index.php` or `index.html`.
   - Maintain root-relative URLs for major entry points: `/`, `/notes.php`, `/user/signin.php`, `/user/signup.php`.
   - Never reference nonexistent `index.html` files in authentication forms or templates.

4. **Zero-DB Health Check Integrity:**  
   The health check probe at [ping.php](ping.php) must remain decoupled from the database. It exists solely to verify web server responsiveness and must never execute database queries or consume connection pool resources.

5. **Docker Build Determinism:**  
   Do not unpin or modify the base image tag in [Dockerfile](Dockerfile) (`FROM php:8.2.35-apache`). Pinning prevents breaking upstream shifts and guarantees reproducible deployments.

6. **Search Engine De-Indexing Directives:**  
   Search engine indexing is permanently disabled for this application. Ensure all public pages maintain `<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">` and that `robots.txt` disallows all crawlers. Do not reintroduce `sitemap.xml` or verification tags.

---

## 2. Agent Interaction & Task Execution Protocol

### Step 1: Pre-Change Discovery
Before modifying existing components:
* Inspect related includes in [includes/](includes/) or [user/includes/](user/includes/).
* Verify session dependencies (`$_SESSION['ocasuid']`) when editing files in [user/](user/).
* Review existing database columns in [database/notes.sql](database/notes.sql) before writing SQL queries.

### Step 2: Implementation Standards
* **Atomic Edits:** Keep modifications focused on the specific user task. Avoid reformatting unrelated files or sweeping refactors without explicit instruction.
* **Preserve Comments:** Retain existing comments and business logic docstrings unless explicitly asked to modify them.
* **Responsive Verification:** Ensure all HTML modifications preserve Bootstrap 5 grid layout integrity across desktop and mobile screens.

### Step 3: Verification & Validation
* Validate PHP syntax with `php -l <filename>` when a local PHP binary is accessible.
* Check git diff output to verify that no unwanted whitespace changes, broken paths, or missing tags were introduced.

---

## 3. Common Agent Recipes

### Adding a New Note Attribute
When adding a new field to study notes (e.g., academic semester, file size):
1. **Schema:** Add the column definition to `database/notes.sql`.
2. **Creation Form:** Update `user/add-notes.php` to include the form input with appropriate client-side validation.
3. **Storage Handler:** Bind the parameter in the insert PDO statement in `user/add-notes.php`.
4. **Display Views:** Update `notes.php` (public explorer) and `user/manage-notes.php` (dashboard table).
5. **Editing:** Update `user/edit-notes.php` so users can revise the field.

### Updating Meta Tags
When modifying meta descriptions or social sharing cards:
1. Update `<title>` and `<meta name="description">` in the `<head>` of the target page.
2. Ensure `<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">` is preserved.

---

## 4. Environment & Context Reference

* **Lead Maintainer:** Purvesh Shinde
* **Production URL:** `https://notes-management-system-beae.onrender.com/`
* **Local Web Server:** Apache / Docker container exposed on port 80 (or `8080` host mapping)
* **Keep-Alive Daemon:** Decommissioned / Disabled (conserves Render 750h free tier quota)

