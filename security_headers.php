<?php
header("X-Frame-Options: DENY");
header("Content-Security-Policy: default-src 'self'; style-src 'self'; script-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'");
