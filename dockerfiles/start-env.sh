#!/bin/bash

echo -n "Set ownerships..."
chown -R appuser:appgroup /var/www/html/*

# Execute the command passed to the entrypoint
exec "$@"
