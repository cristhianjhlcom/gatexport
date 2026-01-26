#!/bin/bash

# FTP Deployment Script
# Builds assets locally and uploads to FTP server

set -e

# Change to project root directory
cd "$(dirname "$0")/.."
PROJECT_ROOT=$(pwd)

# Load environment variables from .env file
if [ -f .env ]; then
    export $(grep -E '^(FTP_HOST|FTP_USER|FTP_PASS|FTP_PORT|FTP_REMOTE_PATH)=' .env | xargs)
else
    echo "❌ Error: .env file not found"
    exit 1
fi

# Validate required variables
if [ -z "$FTP_HOST" ] || [ -z "$FTP_USER" ] || [ -z "$FTP_PASS" ]; then
    echo "❌ Error: Missing FTP credentials in .env file"
    echo "   Required: FTP_HOST, FTP_USER, FTP_PASS"
    exit 1
fi

# Set defaults for optional variables
FTP_PORT="${FTP_PORT:-21}"
FTP_REMOTE_PATH="${FTP_REMOTE_PATH:-/public_html}"

echo "🚀 Starting FTP deployment..."

# Step 1: Install Composer dependencies
echo "→ Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

# Step 2: Build frontend assets
echo "→ Building frontend assets..."
pnpm install
pnpm run build

# Step 3: Upload to FTP server
echo "→ Connecting to FTP server..."

# Check if lftp is installed
if ! command -v lftp &> /dev/null; then
    echo "❌ Error: lftp is required but not installed."
    echo "   Install it with: sudo apt install lftp"
    exit 1
fi

# Create exclude file for lftp
EXCLUDE_FILE=$(mktemp)
cat > "$EXCLUDE_FILE" << 'EOF'
.ai/
.claude/
.idea/
.junie/
.vscode/
backups/
.git/
.github/
node_modules/
.env
.env.backup
.env.local
.env.*.local
.env.production
.phpunit.result.cache
storage/logs/*
storage/framework/cache/*
storage/framework/sessions/*
storage/framework/views/*
tests/
.idea/
.vscode/
*.log
.DS_Store
Thumbs.db
AGENTS.md
CLAUDE.md
.mcp.json
EOF

echo "→ Uploading files to server..."

lftp -c "
set ftp:ssl-allow no;
set net:timeout 60;
set net:max-retries 3;
set net:reconnect-interval-base 5;
set cmd:fail-exit no;
open -u ${FTP_USER},${FTP_PASS} -p ${FTP_PORT} ${FTP_HOST};
lcd ${PROJECT_ROOT};
mkdir -p ${FTP_REMOTE_PATH};
cd ${FTP_REMOTE_PATH};
mirror --reverse \
       --delete \
       --verbose \
       --parallel=4 \
       --exclude-glob-from=${EXCLUDE_FILE} \
       . .;
bye;
"

# Clean up temp file
rm -f "$EXCLUDE_FILE"

echo "✅ FTP deployment completed!"
echo ""
echo "⚠️  Remember to run the deploy.sh script on the server:"
echo "   ./bin/deploy.sh"
