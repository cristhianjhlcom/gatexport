#!/bin/bash

# Database backup script
# Generates a MySQL backup with format: DDMMYYYY_backup.sql

# Load environment variables from .env file
if [ -f .env ]; then
    export $(grep -E '^(DB_HOST|DB_PORT|DB_DATABASE|DB_USERNAME|DB_PASSWORD)=' .env | xargs)
fi

# Configuration
BACKUP_DIR="${BACKUP_DIR:-./database/backups}"
DATE=$(date +%d%m%Y)
FILENAME="${DATE}_backup.sql"

# Create backup directory if it doesn't exist
mkdir -p "$BACKUP_DIR"

# Generate backup
mysqldump -h "${DB_HOST:-127.0.0.1}" \
          -P "${DB_PORT:-3306}" \
          -u "$DB_USERNAME" \
          -p"$DB_PASSWORD" \
          --single-transaction \
          --routines \
          --triggers \
          "$DB_DATABASE" > "$BACKUP_DIR/$FILENAME"

# Check if backup was successful
if [ $? -eq 0 ]; then
    echo "Backup completed: $BACKUP_DIR/$FILENAME"
else
    echo "Backup failed" >&2
    exit 1
fi
